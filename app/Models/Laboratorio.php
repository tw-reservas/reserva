<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratorio extends Model
{
    use HasFactory;


    protected $table = 'laboratorios';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'cod_arancel', 'nombre', 'estado', 'area_cod',
    ];

    protected $casts  = [
        'estado' => 'boolean',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_cod', 'cod_serv');
    }

    public function requisitos()
    {
        return $this->belongsToMany(Requisito::class, "laboratorio_requisitos", 'laboratorio_id', 'requisito_id')->using(LaboratorioRequisitos::class)->withTimestamps();
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
