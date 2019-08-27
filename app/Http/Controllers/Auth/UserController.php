<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Support\Auth\Login;
use App\Support\Auth\Register;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(RegisterRequest $r)
    {
        $register = new Register();
        $register->register($r);
    }

    public function login(LoginRequest $r)
    {
        $login = new Login();
        return $dataLogged = $login->login($r);
    }

    public function logout(Request $r){
        $r->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
