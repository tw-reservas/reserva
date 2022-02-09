<?php

namespace App\Adapters;

use App\Contracts\CpsServices;
use App\Models\Laboratorio;
use App\Models\Ordenlab;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Throwable;

class RestCpsAdapter implements CpsServices
{
    private $endPoint;

    public function __construct()
    {
        $this->endPoint = config('services.restcps.endpoint');
    }

    public function getUser($matricula)
    {
        $response = Http::acceptJson()->post("{$this->endPoint}paciente", [
            "matricula" => $matricula
        ]);
        $response = $response->json();
        $data = $response["data"];
        if (!is_null($data)) {
            $paciente = new Paciente();
            $paciente->matricula = $data["matricula"];
            $paciente->nombre = $data["nombre"];
            $paciente->apellidoPaterno = $data["apellidoPaterno"];
            $paciente->apellidoMaterno = $data["apellidoMaterno"] ?? "";
            $paciente->telefono = $data["telefono"] ?? "";
            $paciente->correo = $data["correo"] ?? "";
            $paciente->estado = true;
            $paciente->save();
            return $paciente;
        }
        return $data;
    }

    public function getOrdenLaboratorio($ordenLaboratorio, $matricula)
    {
        $response = Http::post("{$this->endPoint}orden-lab", [
            'orden_lab' => $ordenLaboratorio,
            'matricula' => $matricula
        ]);
        $response = $response->json();
        $data = $response["data"];
        if (!is_null($data)) {
            DB::beginTransaction();
            try {
                $user = Paciente::where("matricula", $matricula)->first();
                $ordenLab = new Ordenlab();
                $ordenLab->fecha = $data["fecha"];
                $ordenLab->codigo = $data["codigo"];
                $ordenLab->paciente_id = $user->id;
                $ordenLab->save();
                $idLaboratorios = [];
                foreach ($data["laboratorios"] as $laboratorio) {
                    $lab = Laboratorio::getWithAreaCodigo($laboratorio["area_cod"], $laboratorio["cod_arancel"]);
                    $idLaboratorios[] = $lab->id;
                }
                $ordenLab->laboratorios()->attach($idLaboratorios);
                DB::commit();
                return $ordenLab;
            } catch (Throwable  $e) {
                DB::rollBack();
            }
        }
        return $data;
    }
}
