<?php

namespace App\Http\Controllers;

use App\Classes\ApiCatchErrors;
use App\Http\Requests\PatientListRequest;
use App\Http\Requests\PatientShowRequest;
use App\Http\Resources\PatientResource;
use App\Repositories\Invoice\InvoiceInterface;
use App\Repositories\Patient\PatientInterface;
use App\Repositories\Receipt\ReceiptInterface;
use Exception;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patientInterface,$invoiceInterface,$receiptInterface;

    public function __construct(PatientInterface $patientInterface,InvoiceInterface $invoiceInterface,ReceiptInterface $receiptInterface)
    {
        $this->invoiceInterface = $invoiceInterface;
        $this->patientInterface = $patientInterface;
        $this->receiptInterface = $receiptInterface;
    }

    public function index(PatientListRequest $request)
    {
        try {
            $validated = $request->validated();
            $patients = $this->patientInterface->index($validated);
            return PatientResource::collection($patients);
        } catch (Exception $e) {
            ApiCatchErrors::rollback($e);
        }
    }
    
    public function show($externalId)
    {
        try {
            $patient = $this->patientInterface->show($externalId);
            return new PatientResource($patient);
        } catch (Exception $e) {
            ApiCatchErrors::rollback($e);
        }
    }
}
