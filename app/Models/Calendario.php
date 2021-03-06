<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendario extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'calendarios';
    protected $fillable = ['cantidad', 'fechaInicio', 'fechaFin', 'estado'];

    protected $casts = [
        'estado' => 'boolean',
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at', 'cupo_id'
    ];

    public function detalleCalendario()
    {
        return $this->hasMany(DetalleCalendario::class);
    }
}
