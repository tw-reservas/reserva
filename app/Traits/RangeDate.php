<?php

namespace App\Traits;

use App\Models\DetalleCalendario;
use App\Models\Ordenlab;
use App\Models\Paciente;
use App\Services\CpsServices;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

trait RangeDate
{
    //cantidad de días para que la orden sea obsoleta;
    protected $days = 30;

    /*diferencia de dias entre ahora y $date */
    private function diffDateOrdenLab($date)
    {
        $dateTime1 = strtotime($date);
        $dateTime2 = strtotime(Carbon::now());
        $days = (int)(($dateTime2 - $dateTime1) / 86400);
        return $days;
    }
    /*fechas de detalle calendario */
    private function getDateOfDetalleCalendario()
    {
        $now = Carbon::now()->format('Y-m-d');
        $detalle = DetalleCalendario::where("estado", true)
            ->selectRaw("fecha")
            ->selectRaw("(fecha <= '$now') as estado")
            ->selectRaw('(SUM("cupoMaximo") - SUM("cupoOcupado")) as cupoRestante')
            ->groupBy("fecha")->orderBy("fecha")->get();
        return $detalle;
    }
}
