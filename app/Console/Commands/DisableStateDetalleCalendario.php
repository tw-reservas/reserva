<?php

namespace App\Console\Commands;

use App\Models\DetalleCalendario;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DisableStateDetalleCalendario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disable:detalle-calendario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'actualiza la columna estado de la tabla detalle calendario ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $detalleCalendario = DetalleCalendario::whereDate("fecha", "<=", Carbon::now()->format("Y-m-d"))->where("estado", true);
        $detalleCalendario->update(array("estado" => false));
        Log::info("deshabilitando fechas <= " . Carbon::now()->format("Y-m-d"));
    }
}
