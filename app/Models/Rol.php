<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "rols";
    protected $fillable = [
        "nombre", "abreviado"
    ];

    public function casosDeUsos()
    {
        return $this->belongsToMany(CasoDeUso::class, "menus", "rol_id", "caso_de_uso_id");
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
