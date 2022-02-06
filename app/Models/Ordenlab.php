<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenlab extends Model
{
    use HasFactory;
    protected $table = 'ordenlabs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'codigo', 'fecha', 'paciente_id'
    ];
    protected $hidden = [
        'paciente_id', 'deleted_at', 'created_at', 'updated_at',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function reserva()
    {
        return $this->hasOne(Reserva::class);
    }
    public function laboratorios()
    {
        return $this->belongsToMany(Laboratorio::class, 'detalle_orden_labs', 'ordenlab_id', 'laboratorio_id')->using(DetalleOrdenLab::class)->withTimestamps();
    }

    public function usuario()
    {
        return $this->belongsTo(Paciente::class);
    }
}
