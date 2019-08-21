<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Model\User\Avatar;
use App\Model\User\Specific;
use App\Model\User\VerifyEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $r)
    {
        DB::transaction(function () use ($r) {
            $u = User::create([
                'email' => $r->email,
                'password' => Hash::make($r->password)
            ]);
            $a = new Avatar();
            $a->addAvatar($r->sex, $u->id);
            Specific::create([
                'user_id' => $u->id,
                'name' => $r->name,
                'birthday' => $r->birthday,
                'sex' => $r->sex
            ]);
            $v = new VerifyEmail();
            $v->sendVerifyEmail($u->id);
        });
    }

    public function login(LoginRequest $r)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $r->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($r->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user_id' => Auth::id(),
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}
