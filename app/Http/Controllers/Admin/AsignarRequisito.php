<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use App\Models\Requisito;
use Illuminate\Http\Request;

class AsignarRequisito extends Controller
{
    public function index()
    {
        $laboratorios = Laboratorio::with('area:cod_serv,nombre')->get();

        return view('admin.assign-requisitos.index', compact('laboratorios'));
    }

    public function addRequisitoShowPage(Laboratorio $laboratorio)
    {
        $labRequisitos = $laboratorio->requisitos;
        //$requisitos = Requisito::all()->except($labRequisitos, ["id"])->sortBy('id');
        $requisitos = Requisito::whereNotIn('id', $labRequisitos->pluck('id')->toArray())->get();
        return view('admin.assign-requisitos.modify-requisitos', compact('laboratorio', 'labRequisitos', 'requisitos'));
    }

    public function addRequisito(Laboratorio $laboratorio, Request $request)
    {
        $laboratorio->requisitos()->syncWithoutDetaching($request->duallist_requisitos);
        return redirect()->back()->with('success', "Los requisitos se han guardado con éxito");
    }

    public function deleteRequisitoShowPage(Laboratorio $laboratorio)
    {
        $laboratorio->requisitos;
        return view('admin.assign-requisitos.modify-requisitos', ['delete'=> 'delete','laboratorio'=>$laboratorio]);
    }

    public function deleteRequisito(Laboratorio $laboratorio, Request $request)
    {
        /*$request->validate([
            "requisito_id" => 'required|numeric',
        ]);*/
        $laboratorio->requisitos()->detach($request->duallist_requisitos);
        return back()->with("success", "Los requisitos del laboratorio fueron eliminados con éxito");
    }
}
