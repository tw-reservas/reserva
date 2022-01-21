<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasoDeUso extends Model
{
    use HasFactory;

    protected $table = "caso_de_usos";
    protected $fillable = ["id", "nombre", "icon", "url", "paquete_id"];
    //protected $hidden = ["paquete_id"];

    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'paquete_id', 'id');
    }

    public function rol()
    {
        return $this->belongsToMany(Rol::class, "menus", "casos_de_uso_id", "rol_id");
    }
}
