<?php

namespace App\Repositories\Patient;

interface PatientInterface
{
    public function show(int $externalId) : ?object;
}
