<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;

    protected $table = "requisitos";
    protected $fillable = ['descripcion'];

    public function laboratorios()
    {
        return $this->hasMany(Laboratorio::class);
    }
}
