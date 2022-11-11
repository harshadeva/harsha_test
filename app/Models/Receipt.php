<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $table = 'receipt';

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','external_patient_id');
    }
}
