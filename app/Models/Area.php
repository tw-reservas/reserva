<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'areas';
    protected $primaryKey = 'cod_serv';

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nombre', 'cod_serv'
    ];

    public function laboratorios()
    {
        return $this->hasMany(Laboratorio::class, 'area_cod', "cod_serv");
    }
}
