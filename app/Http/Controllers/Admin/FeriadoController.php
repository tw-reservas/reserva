<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiaFestivo;
use Illuminate\Http\Request;

class FeriadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feriados = DiaFestivo::orderBy('fecha', 'ASC')->get();
        return view('admin.feriado.index', compact('feriados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feriado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "titulo" => 'required',
            "fecha" => 'required|date',
        ]);

        DiaFestivo::create([
            "titulo" => $request->titulo,
            "fecha" => $request->fecha,
        ]);
        return redirect('admin/feriados')->with('success', 'Feriado creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiaFestivo  $diaFestivo
     * @return \Illuminate\Http\Response
     */
    public function show(DiaFestivo $feriado)
    {
        return view('admin.feriado.edit', compact('feriado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiaFestivo  $diaFestivo
     * @return \Illuminate\Http\Response
     */
    public function edit(DiaFestivo $feriado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiaFestivo  $diaFestivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiaFestivo $feriado)
    {
        $request->validate([
            "titulo" => 'required',
            "fecha" => 'required|date',
        ]);
        $feriado->titulo = $request->titulo;
        $feriado->fecha = $request->fecha;
        $feriado->update();
        return redirect('admin/feriados')->with('success', 'Feriado actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiaFestivo  $diaFestivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiaFestivo $feriado)
    {
        $feriado->delete();
        return redirect('admin/feriados')->with('success', 'Feriado eliminado exitosamente');
    }
}
