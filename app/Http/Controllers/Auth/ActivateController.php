<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\User\Auth\ActivateAccountRequest;
use App\Http\Controllers\Controller;
use App\Model\User\VerifyEmail;

class ActivateController extends Controller
{
    public function activate(ActivateAccountRequest $r){
        $v = new VerifyEmail();
        $v->verifyKey($r->key);
        return true;
    }
}
