<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'patient_id'=>$this->external_patient_id,
            'first_appointment_id'=> $this->appointments->count() > 0 ? intval($this->appointments->first()->appointment_id) : null,
            'invoice'=>$this->invoices->pluck('invoice_no')->toArray(),
            'total_receipts'=>$this->receipts->sum('amount'),
            'receipts'=>$this->receipts->pluck('receipt_id')->toArray(),
            'first_receipt_date'=>$this->receipts->first()->receipt_date ?? null,
            'first_invoice_date'=>$this->invoices->first()->date ?? null,
            'first_appointment_date'=>$this->appointments->count() > 0 ? date('Y-m-d',strtotime($this->appointments->first()->appointment_date)) : null,
            'patient_created_date'=>date('Y-m-d',strtotime($this->date_of_enquiry)),
        ];
    }
}
