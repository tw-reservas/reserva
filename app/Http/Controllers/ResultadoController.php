<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadoController extends Controller
{

    public function index()
    {
        //$res = Resultado::all();
        $user = auth()->guard('paciente')->user();
        $res = $user->resultados;
        //dd($resultados);

        return view('resultado.index')->with('resultadosc', $res);
    }
}
