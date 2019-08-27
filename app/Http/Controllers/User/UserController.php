<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\User\UserResource;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user(){
        $user = User::with(['s', 'avatar', 'contact', 'company'])
            ->find(Auth::id());
        return new UserResource($user);
    }
}
