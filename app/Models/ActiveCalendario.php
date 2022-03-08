<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveCalendario extends Model
{
    protected $table = "active_calendarios";
    protected $fillable = [
        "id", "current_id", "previous_id", "previous_date", "amount"
    ];
    protected $hidden = [
        "deleted_at", "created_at", "updated_at",
    ];
}
