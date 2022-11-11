<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public function appointments(){
        return $this->hasMany(Appointment::class,'patient_id','external_patient_id');
    }
    
    public function receipts(){
        return $this->hasMany(Receipt::class,'patient_id','external_patient_id');
    }
    
    public function invoices(){
        return $this->hasMany(Invoice::class,'patient_id','external_patient_id');
    }
}
