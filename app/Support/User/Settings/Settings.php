<?php


namespace App\Support\User\Settings;
use App\Model\User\Company;
use App\Model\User\Contact;
use App\Model\User\Specific;
use Illuminate\Support\Facades\Auth;

class Settings
{

    public function basicData($r)
    {
        $this->editSpecificData($r);
        $companyCheck = Company::where('user_id', Auth::id())->first();
        if ($r->type_account != 1) {
            if ($companyCheck) {
                $this->editCompany($r);
            } else {
                $this->createCompany($r);
            }
        } else {
            if ($companyCheck) {
                $this->deleteCompany();
            }
        }
    }

    protected function editSpecificData($r)
    {
        Specific::where('user_id', Auth::id())
            ->update([
                'name' => $r->name,
                'last_name' => $r->last_name,
                'username' => $r->username,
                'sex' => $r->sex,
                'type_account' => $r->type_account
            ]);
    }

    protected function deleteCompany()
    {
        Company::where('user_id', Auth::id())->delete();
    }

    protected function editCompany($r)
    {
        Company::where('user_id', Auth::id())
            ->update([
                'name' => $r->name_company,
                'nip' => $r->nip_company,
                'country' => $r->country_company,
                'address' => $r->address_company,
                'post_code' => $r->post_code_company,
                'city' => $r->city_company
            ]);
    }

    protected function createCompany($r)
    {
        Company::create([
            'user_id' => Auth::id(),
            'name' => $r->name_company,
            'nip' => $r->nip_company,
            'country' => $r->country_company,
            'address' => $r->address_company,
            'post_code' => $r->post_code_company,
            'city' => $r->city_company
        ]);
    }

    public function updateContact($r)
    {
        Contact::where('user_id', Auth::id())
            ->update([
                'email' => $r->email,
                'email_two' => $r->email_two,
                'phone_priv' => $r->phone_priv,
                'phone_company' => $r->phone_company,
                'city' => $r->city,
                'post_code' => $r->post_code,
                'country' => $r->country,
                'street' => $r->street,
                'number_local' => $r->numer_local,
                'number_home' => $r->number_home
            ]);
    }


    public function updateContactCompany($r)
    {
        Company::where('user_id', Auth::id())
            ->update([
                'country' => $r->country_company,
                'address' => $r->address_company,
                'post_code' => $r->post_code_company,
                'city' => $r->city_company
            ]);
    }

}
