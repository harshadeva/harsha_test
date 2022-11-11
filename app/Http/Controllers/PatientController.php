<?php

namespace App\Http\Controllers;

use App\Classes\ApiCatchErrors;
use App\Http\Requests\PatientShowRequest;
use App\Http\Resources\PatientResource;
use App\Repositories\Invoice\InvoiceInterface;
use App\Repositories\Patient\PatientInterface;
use App\Repositories\Receipt\ReceiptInterface;
use Exception;

class PatientController extends Controller
{
    protected $patientInterface,$invoiceInterface,$receiptInterface;

    public function __construct(PatientInterface $patientInterface,InvoiceInterface $invoiceInterface,ReceiptInterface $receiptInterface)
    {
        $this->invoiceInterface = $invoiceInterface;
        $this->patientInterface = $patientInterface;
        $this->receiptInterface = $receiptInterface;
    }

    public function show(PatientShowRequest $request)
    {
        try {
            $validated = $request->validated();
            $patient = $this->patientInterface->show($validated['external_id']);
            $invoices = $this->invoiceInterface->filter($validated);
            $receipts = $this->receiptInterface->filter($validated);

            return new PatientResource((object) ['patient' => $patient, 'invoices' => $invoices, 'receipts' => $receipts]);
        } catch (Exception $e) {
            ApiCatchErrors::rollback($e);
        }
    }
}
