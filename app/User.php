<?php

namespace App;

use App\Http\Requests\User\Auth\RegisterRequest;
use App\Model\Follow\Follow;
use App\Model\Message\Message;
use App\Model\Page\Advertisement;
use App\Model\Photo\Photo;
use App\Model\User\Avatar;
use App\Model\User\Company;
use App\Model\User\Contact;
use App\Model\User\Specific;
use App\Model\User\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
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
        return $this->hasMany(Advertisement::class)
            ->with(['price', 'photos']);
    }

    public function fullname(){
        $name = Specific::where('user_id', Auth::id())->value('name');
        $lastName = Specific::where('user_id', Auth::id())->value('last_name');
        $fullName = $name . ' ' . $lastName;
        return $fullName;
    }

    public function follows(){
        return $this->hasMany(Follow::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function contact(){
        return $this->hasOne(Contact::class);
    }

    public function company(){
        return $this->hasOne(Company::class, 'user_id', 'id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

}
