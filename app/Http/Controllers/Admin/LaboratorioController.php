<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $lab = Laboratorio::all()->sortBy('id');

        return view('admin.laboratorios.saludos')->with('laboratoriosDatos', $lab);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.laboratorios.create");
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
            $id = $request->id;
            $codigo_arancel = $request->cod_arancel;
            $nombre = $request->nombre;
            $estado = $request->estado;
            $requisito = $request->requisito_id;
            $area_codigo = $request->area_cod;

            $req = new Laboratorio();
            $req->id = $id;
            $req->cod_arancel = $codigo_arancel;
            $req->nombre = $nombre;
            $req->estado = $estado;
            $req->requisito_id = $requisito;
            $req->area_cod = $area_codigo;
            $req->save();
            return redirect("admin/laboratorios");
        }
        catch(\Throwable $th){
            return redirect()->back();
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
        return view("admin.laboratorios.edit")->with("laboratorio",$laboratorio);
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
            $id = $request->id;
            $codigo_arancel = $request->cod_arancel;
            $nombre = $request->nombre;
            $estado = $request->estado;
            $requisito = $request->requisito_id;
            $area_codigo = $request->area_cod;

            $laboratorio->id = $id;
            $laboratorio->cod_arancel = $codigo_arancel;
            $laboratorio->nombre = $nombre;
            $laboratorio->estado = $estado;
            $laboratorio->requisito_id = $requisito;
            $laboratorio->area_cod = $area_codigo;
            $laboratorio->update();
            return redirect("admin/laboratorios");
        }
        catch(\Throwable $th){
            dd($th);
            return redirect()->back();
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
        return back();
    }
}
