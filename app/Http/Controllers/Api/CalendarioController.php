<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetalleCalendario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function calendario()
    {
        $now = Carbon::now()->format('Y-m-d');
        $detalle = DetalleCalendario::where("estado", true)
            ->selectRaw("fecha")
            ->selectRaw("(fecha <= '$now') as estado")
            ->selectRaw('(SUM("cupoMaximo") - SUM("cupoOcupado")) as cupoRestante')
            ->groupBy("fecha")->orderBy("fecha")->get();
        return response()->json(["data" => $detalle]);
    }
}
