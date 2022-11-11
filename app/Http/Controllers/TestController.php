<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    // this method will help to check project working or not
    public function test(){
        return "Clinic API is working";
    }
   
    // this method will help to find patients with all relations ships : (DEV PURPOSE ONLY)
    public function devTest(){
        return Patient::whereHas('invoices')->whereHas('receipts')->whereHas('appointments')->pluck('external_patient_id');
    }

    // this method will help to check authentication is valid or not
    public function testAuth(){
        return new UserResource(Auth::user());
    }
}
