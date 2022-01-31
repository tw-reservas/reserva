<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;

    protected $table = 'laboratorios';
    protected $primaryKey = 'cod_arancel';

    protected $fillable = [
        'nombre', 'estado', 'area_cod', 'requisito_id',
    ];

    protected $casts  = [
        'estado' => 'boolean',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function requisito()
    {
        return $this->belongsTo(Requisito::class);
    }

    public function ordenlab()
    {
        return $this->belongsToMany(Ordenlab::class, 'detalle_orden_labs', 'laboratorio_id', 'ordenlab_id')->using(DetalleOrdenLab::class)->withTimestamps();
    }

    public static function getWithAreaCodigo($cod_area, $cod_lab)
    {
        return Laboratorio::where("cod_arancel", $cod_lab)->where("area_cod", $cod_area)->first();
    }
}
