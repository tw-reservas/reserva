<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requisito;
use Illuminate\Http\Request;

class RequisitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recom = Requisito::all()->sortBy('id');

        return view('admin.requisitos.requisitos')->with('requisitosDatos', $recom);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.requisitos.create");
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
            $descripcion = $request->descripcion;
            $req = new Requisito();
            $req->descripcion = $descripcion;
            $req->save();
            return redirect("admin/requisitos")->with('success','El requisito se guardo éxitosamente');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','No se pudo guardar el Requisito');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function show(Requisito $requisito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisito $requisito)
    {
        return view("admin.requisitos.edit")->with("requisitos",$requisito);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisito $requisito)
    {
        try{
            $descripcion = $request->descripcion;
            $requisito->descripcion = $descripcion;
            $requisito->update();
            return redirect("admin/requisitos")->with('success','Se actualizó correctamente');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Ocurrio un error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisito $requisito)
    {
        $requisito->delete();
        return redirect()->back()->with('success','Se elimino con éxito');
    }
}
