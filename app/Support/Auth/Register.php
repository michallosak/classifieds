<?php


namespace App\Support\Auth;

use App\Model\User\Avatar;
use App\Model\User\Company;
use App\Model\User\Contact;
use App\Model\User\Specific;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Register
{
    public function register($r)
    {
        DB::transaction(function () use ($r) {
            $u = $this->createUserModules($r);
            $this->setAvatar($r, $u);
            $this->isCompany($r, $u);
        });
    }

    protected function createUserModules($r){
        $u = User::create([
            'email' => $r->email,
            'password' => Hash::make($r->password)
        ]);
        Specific::create([
            'user_id' => $u->id,
            'name' => $r->name,
            'birthday' => $r->birthday,
            'sex' => $r->sex,
            'type_account' => $r->type_account
        ]);
        Contact::create([
            'user_id' => $u->id,
            'email' => $u->email
        ]);
        return $u;
    }

    protected function isCompany($r, $u){
        if ($r->type_account != 1) {
            Company::create([
                'user_id' => $u->id,
                'name' => $r->name_company,
                'nip' => $r->nip_company,
                'country' => $r->country_company,
                'address' => $r->address_company,
                'post_code' => $r->post_code_company,
                'city' => $r->city_company
            ]);
        }
    }

    protected function setAvatar($r, $u){
        if ($r->sex != 1){
            // man
            $avatar = 'http://intercastor.pl/wp-content/uploads/2017/01/default_user_icon.jpg';
        }else{
            // woman
            $avatar = 'http://babyathome.pl/wp-content/uploads/2014/07/avatar-woman.png';
        }
        Avatar::create([
            'user_id' => $u->id,
            'src' => $avatar
        ]);
    }

}
