<?php

namespace App\Contracts;

interface CpsServices
{
    public function getUser($matricula);
    public function getOrdenLaboratorio($ordenLaboratorio, $matricula);
}
