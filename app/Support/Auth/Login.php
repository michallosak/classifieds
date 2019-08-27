<?php


namespace App\Support\Auth;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Login
{
    public function login($r)
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
        $dataLogged = response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user_id' => Auth::id(),
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
        return $dataLogged;
    }
}
