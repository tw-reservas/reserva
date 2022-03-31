<?php

namespace App\Console\Commands;

use App\Models\ActiveCalendario;
use App\Models\Calendario;
use App\Models\Cupo;
use App\Models\DetalleCalendario;
use App\Models\Grupo;
use App\Traits\RangeDate;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DistributeCalendario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    use RangeDate;
    protected $signature = 'distribute:calendario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'verifica los cupos y fecha de calendario (activo) para repartir la siguiente ronda';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function distributeRegisteredCalendar(Calendario $calendario)
    {
        Log::info("recuperando calendario " . $calendario->id);
        $listDate = $this->getListDates($calendario->fechaInicio, $calendario->fechaFin, $calendario->id);
        try {
            $calendario->estado =   !$calendario->estado;
            $calendario->activado = true;
            $calendario->update();
            DetalleCalendario::insert($listDate);
            DB::commit();
            Log::info("calendario repartido con exito. calendario:id " . $calendario->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info("Ocurrió un error al repartir los cupos verifique por favor" . $th);
        }
    }

    private function distributeUnregisteredCalendar()
    {
        $activeCalendario = ActiveCalendario::first();
        //creamos una instancia de la ultima fecha
        $start = new Carbon($activeCalendario->previous_date);
        $this->startDate($start->addDay()); //actualiza si la fecha +1 dia es sábado domingo o feriado

        $startCopy = new Carbon($start->format("Y-m-d"));
        $last = $this->lastDate($startCopy, $activeCalendario->amount);

        DB::beginTransaction();
        try {
            $calendario = new Calendario();
            $calendario->fechaInicio = $start->format("Y-m-d");
            $calendario->fechaFin = $last->format("Y-m-d");
            $calendario->cantidad = $activeCalendario->amount;
            $calendario->estado = false;
            $calendario->save();

            Log::info("Calendario insertado con éxito. calendario:id " . $calendario->id);

            $listDate = $this->getListDates($calendario->fechaInicio, $calendario->fechaFin, $calendario->id);

            DetalleCalendario::insert($listDate);

            $calendario->estado =   !$calendario->estado;
            $calendario->activado = true;
            $calendario->update();

            DB::commit();
            Log::info("calendario repartido con éxito. calendario:id " . $calendario->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info("Ocurrió un error al repartir los cupos verifique por favor " . $th);
        }
    }

    private function isValidate($activeCalendario)
    {
        if (is_null($activeCalendario)) {
            return false;
        }
        $now = Carbon::now();
        $lastDate = new Carbon($activeCalendario->previous_date);
        /*si la diferencia de fecha entre now y el ultimo activado es mayor a 1 no es valido*/
        /*si el calendario ya fue repartido no es valido*/
        $calendario = Calendario::withCount("detalleCalendario")->find($activeCalendario->current_id);
        if ($lastDate->diff($now)->days > 1 && $calendario->detalle_calendario_count > 0) {
            return false;
        }
        return true;
    }


    public function handle()
    {
        $activeCalendario = ActiveCalendario::first();
        if ($this->isValidate($activeCalendario)) {
            $calendarios = Calendario::where("estado", false)->where("activado", false)->orderBy("fechaInicio")->get();
            if (count($calendarios) > 0) {
                $this->distributeRegisteredCalendar($calendarios->first());
            } else {
                $this->distributeUnregisteredCalendar();
            }
        } else {
            Log::info("No hay calendarios a repartir");
        }
    }
}
