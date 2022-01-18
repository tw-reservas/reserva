<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Paciente extends Persona
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $guard = "pacientes";
    protected $casts  = [
        'estado' => 'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'matricula', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'telefono', 'correo', 'estado'
    ];
    protected $primaryKey = "id";

    protected $table = 'pacientes';

    public static function findMatricula($matricula)
    {
        return Paciente::where('matricula', $matricula)->first();
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function ordenLab()
    {
        return $this->hasMany(Ordenlab::class);
    }

    public function getRolAttribute()
    {
        return "P";
    }
    public function resultados()
    {
        return $this->hasMany(Resultado::class);
    }

    public $appends = ["rol"];
}
