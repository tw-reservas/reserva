<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;

    protected $table = "requisitos";
    protected $fillable = ['descripcion'];

    protected $hidden = [
        "created_at", "updated_at", "deleted_at", "pivot"
    ];

    public function laboratorios()
    {
        return $this->belongsToMany(Laboratorio::class, "laboratorio_requisitos")->using(LaboratorioRequisitos::class)->withTimestamps();
    }
}
