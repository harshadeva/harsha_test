<?php

namespace App\Repositories\Receipt;

use App\Models\Receipt;

/**
 * Class FuelRepository.
 */
class ReceiptRepository implements ReceiptInterface
{
    public function filter(array $filters): object
    {
        $query = Receipt::query();
        if (isset($filters['start']) && $filters['start'] != null) {
            $query->whereDate('receipt_date', '>=', $filters['start']);
        }
        if (isset($filters['end']) && $filters['end'] != null) {
            $query->whereDate('receipt_date', '<=', $filters['end']);
        }
        return $query->where('patient_id', $filters['external_id'])->get();
    }
    
}
