<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GrupoRequest;
use App\Models\Cupo;
use App\Models\Grupo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GrupoController extends Controller
{

    public function index()
    {
        $grupos = Grupo::orderBy('horaInicio')->get();
        return view('admin.grupo.index')->with('grupos', $grupos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cupo = Cupo::where("estado", true)->first();
        return view('admin.grupo.create')->with("cupo", $cupo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function porDefinir($horaInicio,$horaFin){
        $grupos = Grupo::orderBy('horaInicio')->get();
        //dd($grupos);
        if(empty($grupos) ){
            return true;
        }
        if($horaInicio > $horaFin){
            return false;
        }
        if(count($grupos)==1){
            $grupo= $grupos->first();
            if($horaFin <= $grupo->horaInicio || $horaInicio >= $grupo->horaFin){
                return true;
            }
            return false;
        }
        for ($index=0; $index < count($grupos); $index++) {
            if($index == 0){
                if($horaFin <= $grupos[$index]->horaInicio){
                    return true;
                }
                $index++;
            }

            if($horaFin <= $grupos[$index]->horaInicio && $horaInicio >= $grupos[$index-1]->horaFin){
                return true;
            }
            if($index == count($grupos) - 1){
                if($horaInicio >= $grupos[$index]->horaFin){
                    return true;
                }
            }
        }
        return false;
    }

    public function store(GrupoRequest $request)
    {



        $result =  $this->porDefinir($request->horaInicio,$request->horaFin);
        if(!$this->porDefinir($request->horaInicio,$request->horaFin)){
            return back()->with('error', "Horario no valido, verifique por favor ");
        }
        $grupo = new Grupo();
        $grupo->nombre = strtolower("GRUPO ") . strtolower($request->nombre);
        $grupo->horaInicio = $request->horaInicio;
        $grupo->horaFin = $request->horaFin;
        $grupo->porcentaje = 0;
        $grupo->estado = false;
        $grupo->save();
        return redirect('admin/grupo')->with('success', "Grupo Agregado con éxito");
    }

    public function porcentajeView()
    {
        $cupo = Cupo::where("estado", true)->first();
        $grupos = Grupo::where("estado", true)->get();
        return view('admin.grupo.conf-porcentaje')->with('cupo', $cupo)->with('grupos', $grupos);
    }

    public function storePorcentaje(Request $request)
    {
        $cupo = $request->cupo;
        $bodyForm = $request->except(['_token', 'cupo']);
        foreach ($bodyForm as $key => $value) {
            $grupo = Grupo::find($key);
            $grupo->porcentaje = $value;
            $grupo->update();
        }
        return redirect('admin/grupo')->with('success', "porcentaje Actualizado con éxito");
    }

    public function activar(Grupo $grupo)
    {

        $estado = $grupo->estado;
        $grupo->estado = !$grupo->estado;
        $grupo->update();
        return redirect()->back()->with(
            ($estado) ? "desactivado" : "activado",
            ($estado) ? "El grupo fue desactivado con éxito" : "El grupo fue activado con éxito"
        );
    }

    public function destroy(Grupo $grupo)
    {
        if (!$grupo->estado) {
            $grupo->delete();
            return redirect()->back()->with('success',"Grupo eliminado con éxito");

        }
        return back()->with("error", "No se puede ELIMINAR un grupo activo");
    }
}
