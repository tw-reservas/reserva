<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCalendario extends Model
{
    use HasFactory;
    protected $table = "detalles_calendarios";
    protected $fillable = [
        'cupoMaximo', 'cupoOcupado', 'fecha', 'estado'
    ];

    protected $hidden = [
        'calendario_id', 'cupo_id', 'grupo_id', 'deleted_at', 'created_at', 'updated_at',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class)->withTrashed();
    }

    public function calendario()
    {
        return $this->belongsTo(Calendario::class)->withTrashed();
    }


    public function cupo()
    {
        return $this->belongsTo(Cupo::class)->withTrashed();
    }

    public function reserva()
    {
        return $this->hasMany(Reserva::class);
    }
}
