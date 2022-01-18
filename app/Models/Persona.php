<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

abstract class Persona  extends Authenticatable
{



    public static function existsMatricula($matricula)
    {
        return Paciente::findMatricula($matricula) != null || User::findMatricula($matricula) != null;
    }
}
