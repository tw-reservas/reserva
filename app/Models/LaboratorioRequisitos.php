<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LaboratorioRequisitos extends Pivot
{
    use HasFactory;
    protected $table = "laboratorio_requisitos";

    public $increments = true;

    protected $fillable = ['id', 'laboratorio_id', 'requisito_id'];
}
