<?php

namespace App\Http\Controllers;

use App\Classes\ApiCatchErrors;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\Common\ErrorResponse;
use App\Http\Resources\LoginResource;
use App\Http\Resources\LogoutResource;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            if(!Auth::attempt(['email'=>$validated['email'],'password'=>$validated['password']])){
                return (new ErrorResponse(['message' => 'Email or password invalid']))->response()->setStatusCode(422);
            }
            $user = Auth::user();
            $token = $user->createToken('clinic_token')->accessToken;
            DB::commit();
            return new LoginResource(['token'=>$token,'user'=>$user]);
        } catch (Exception $e) {
            ApiCatchErrors::rollback($e);
        }
    }
    
    public function logout(){
        DB::beginTransaction();
        try {
            $toeken = Auth::user()->token();
            $toeken->revoke();
            DB::commit();
            return new LogoutResource(['message'=>'Logged out successfully']);
        } catch (Exception $e) {
            ApiCatchErrors::rollback($e);
        }
    }
}
