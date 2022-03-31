<?php

namespace App\Traits;

use App\Models\Cupo;
use App\Models\DetalleCalendario;
use App\Models\DiaFestivo;
use App\Models\Grupo;
use Carbon\Carbon;

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

    private function isSundaySaturdayHoliday($date)
    {
        $stringDate = $date->format('Y-m-d');
        $feriados = DiaFestivo::all()->pluck('fecha')->contains($stringDate);
        if ($date->dayOfWeek == Carbon::SATURDAY  || $date->dayOfWeek == Carbon::SUNDAY || $feriados) {
            return true;
        }
        return false;
    }


    private function getListDates($fechaInicio, $fechaFin, $calendario_id)
    {
        $start = Carbon::createFromFormat('Y-m-d', $fechaInicio);
        $end = Carbon::createFromFormat('Y-m-d', $fechaFin);
        $grupos = Grupo::where("estado", true)->get();
        $cupo = Cupo::where("estado", true)->first();
        $diaGrupo = [];
        for ($i = $start; $i <= $end; $i->addDay()) {
            //if ($i->dayOfWeek == Carbon::SUNDAY || $i->dayOfWeek == Carbon::SATURDAY) {
            if ($this->isSundaySaturdayHoliday($i)) {
            } else {
                foreach ($grupos as $grupo => $value) {
                    $diaGrupo[] = [
                        "cupoMaximo" => $value->porcentaje,
                        "cupoOcupado" => 0,
                        "fecha" => $i->format('Y-m-d'),
                        "estado" => true,
                        "cupo_id" => $cupo->id,
                        "grupo_id" => $value->id,
                        "calendario_id" => $calendario_id,
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ];
                }
            }
        }
        return $diaGrupo;
    }


    private function startDate($start)
    {
        while (true) {
            //if ($start->dayOfWeek == Carbon::SUNDAY || $start->dayOfWeek == Carbon::SATURDAY) {
            if ($this->isSundaySaturdayHoliday($start)) {
                $start = $start->addDay();
            } else {
                break;
            }
        }
    }

    private function lastDate($start, $amount)
    {
        $a = 0;
        while ($a < $amount) {
            //if ($start->dayOfWeek == Carbon::SUNDAY || $start->dayOfWeek == Carbon::SATURDAY) {
            if ($this->isSundaySaturdayHoliday($start)) {
                $start = $start->addDay();
            } else {
                $a += 1;
                if ($a < $amount) {
                    $start = $start->addDay();
                }
            }
        }
        return $start;
    }
}
