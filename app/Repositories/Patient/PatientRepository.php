<?php

namespace App\Repositories\Patient;

use App\Models\Patient;

/**
 * Class FuelRepository.
 */
class PatientRepository implements PatientInterface
{
    public function show(int $externalId): ?object
    {
        return Patient::with('appointments', 'invoices', 'receipts')->where('external_patient_id', $externalId)->first();
    }
    
}
