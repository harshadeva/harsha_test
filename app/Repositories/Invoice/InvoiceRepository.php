<?php

namespace App\Repositories\Invoice;

use App\Models\Invoice;
use App\Models\Patient;

/**
 * Class FuelRepository.
 */
class InvoiceRepository implements InvoiceInterface
{
    public function filter(array $filters): object
    {
        $query = Invoice::query();
        if (isset($filters['start']) && $filters['start'] != null) {
            $query->whereDate('date', '>=', $filters['start']);
        }
        if (isset($filters['end']) && $filters['end'] != null) {
            $query->whereDate('date', '<=', $filters['end']);
        }
        return $query->where('patient_id', $filters['external_id'])->get();
    }
    
}
