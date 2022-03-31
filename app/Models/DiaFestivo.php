<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaFestivo extends Model
{
    use HasFactory;
    protected $table = "dia_festivos";
    protected $fillable = [
        "id", "titulo", "fecha",
    ];

    protected $hidden = [
        "created_at", "updated_at", "deleted_at",
    ];

    public function getTituloAttribute($titulo)
    {
        return ucfirst($titulo);
    }

    //devolverá un carbon
    public function getFechaAttribute($fecha)
    {
        $date = Carbon::parse($fecha)->year(now()->format('Y'));
        return $date->format('Y-m-d');
    }
}
