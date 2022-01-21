<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;
    protected $table = "paquetes";
    protected $fillable = ["id", "nombre", "icon"];

    public function casosDeUsos()
    {
        return $this->hasMany(CasoDeUso::class);
    }
}
