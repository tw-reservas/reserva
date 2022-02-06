<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;

class Reserva extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "reservas";
    protected $fillable = [
        'fecha', 'estado', "ordenlab_id", "paciente_id", "detallecalendario_id",
    ];

    protected $casts = [
        "estado" => "boolean",
    ];

    public function ordenLab()
    {
        return $this->belongsTo(Ordenlab::class, 'ordenlab_id', 'id');
    }
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function detalleCalendario()
    {
        return $this->belongsTo(DetalleCalendario::class, "detallecalendario_id", "id");
    }
}
