<?php

namespace App;

use App\Http\Requests\User\Auth\RegisterRequest;
use App\Model\Page\Advertisement;
use App\Model\User\Avatar;
use App\Model\User\Specific;
use App\Model\User\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function avatar(){
        return $this->hasOne(Avatar::class);
    }

    public function s(){
        return $this->hasOne(Specific::class);
    }

    public function verifyEmail(){
        return $this->hasOne(VerifyEmail::class);
    }

    public function classifieds(){
        return $this->hasMany(Advertisement::class);
    }

    public function fullname(){
        $name = Specific::where('user_id', Auth::id())->value('name');
        $lastName = Specific::where('user_id', Auth::id())->value('last_name');
        $fullName = $name . ' ' . $lastName;
        return $fullName;
    }
}
