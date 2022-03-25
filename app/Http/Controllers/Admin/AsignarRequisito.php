<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratorio;
use Illuminate\Http\Request;

class AsignarRequisito extends Controller
{
    public function index()
    {
        $laboratorios = Laboratorio::with('area:cod_serv,nombre')->get();

        return view('admin.assign-requisitos.index', compact('laboratorios'));
    }
}
