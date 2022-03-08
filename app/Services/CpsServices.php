<?php

namespace App\Services;

interface CpsServices
{
    public function getUser($matricula);
    public function getOrdenLaboratorio($ordenLaboratorio, $matricula);
    public function checkMatricula($matricula);
}
