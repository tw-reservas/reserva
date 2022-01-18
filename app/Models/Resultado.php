<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    protected $table = 'resultados';
    protected $primaryKey = 'id';

    protected $fillable = [
        'direccion_url', 'fecha', 'matricula_id',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function getNombreAttribute($nombre)
    {
        return ucfirst($nombre);
    }
}
