<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'grupos';
    protected $fillable = [
        'nombre', 'porcentaje', 'horaInicio', 'horaFin', 'estado'
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function habilitar()
    {
        $this->estado = !$this->estado;
        $this->save();
    }

    public function getNombreAttribute($nombre)
    {
        return strtoupper($nombre);
    }

    public function detalleCalendario()
    {
        return $this->hasMany(DetalleCalendario::class);
    }
}
