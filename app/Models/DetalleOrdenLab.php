<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DetalleOrdenLab extends Pivot
{
    use HasFactory;
    protected $table = "detalle_orden_labs";
    public $incrementing  = true;

    protected $fillable = [
        'id', 'laboratorio_id', 'ordenlab_id',
    ];
}
