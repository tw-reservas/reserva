<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Laboratorio;
use App\Models\Requisito;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Laboratorio::with('area')->get()->sortBy('area.cod_serv',SORT_REGULAR,false);
        return view('admin.laboratorios.index')->with('laboratorios', $labs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all()->sortBy('id');
        return view("admin.laboratorios.create",compact("areas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $codigo_arancel = $request->cod_arancel;
            $nombre = $request->nombre;

            $area_codigo = $request->input('area');

            $req = new Laboratorio();
            $req->cod_arancel = $codigo_arancel;
            $req->nombre = $nombre;
            $req->area_cod = $area_codigo;
            $req->save();
            return redirect("admin/laboratorios")->with('success',"Laboratorio creado con éxito");
        }
        catch(\Throwable $th){

            return redirect()->back()->with('error',"No se pudo guardar el laboratorio");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratorio $laboratorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Laboratorio $laboratorio)
    {
        $areas = Area::all()->sortBy('id');
        return view("admin.laboratorios.edit",compact('laboratorio'))->with("areas",$areas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratorio $laboratorio)
    {
        try{

            $codigo_arancel = $request->cod_arancel;
            $nombre = $request->nombre;
            $area_codigo =$request->input('area');


            $laboratorio->cod_arancel = $codigo_arancel;
            $laboratorio->nombre = $nombre;
            $laboratorio->area_cod = $area_codigo;
            $laboratorio->update();
            return redirect("admin/laboratorios")->with('success',"Laboratorio actualizado con éxito");
        }
        catch(\Throwable $th){
            dd($th);
            return redirect()->back()->with('error',"No se pudo actualizar el laboratorio");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratorio $laboratorio)
    {
        $laboratorio->delete();
        return back()->with('success', "Laboratorio eliminado con éxito");
    }
}
