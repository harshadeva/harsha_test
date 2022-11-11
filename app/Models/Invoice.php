<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','external_patient_id');
    }
}
