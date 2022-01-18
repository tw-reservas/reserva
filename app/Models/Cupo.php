<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cupo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cupos';
    protected $fillable = ['total', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    protected $primaryKey = 'id';

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at',
    ];

    public function habilitar()
    {
        return $this->estadoUpdate();
    }

    private function estadoUpdate()
    {
        $this->estado = !$this->estado;
        $this->save();
    }

    public function deshabilitar()
    {
        return $this->estadoUpdate();
    }


    public function detallesReserva()
    {
        return $this->hasMany(DetalleReserva::class);
    }
}
