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
    
    public function index(array $filters): object
    {
        $query =  Patient::query();
        if (isset($filters['external_id']) && $filters['external_id'] != null) {
            $query->where('external_patient_id',$filters['external_id']);
        }
        if (isset($filters['start']) && $filters['start'] != null) {
            $query->whereDate('date_of_enquiry', '>=', $filters['start']);
        }
        if (isset($filters['end']) && $filters['end'] != null) {
            $query->whereDate('date_of_enquiry', '<=', $filters['end']);
        }
        return $query->with('appointments', 'invoices', 'receipts')->get();
    }
    
}
