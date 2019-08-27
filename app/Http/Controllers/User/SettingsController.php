<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\Settings\BasicDataRequest;
use App\Http\Requests\User\Settings\ContactCompanyRequest;
use App\Http\Requests\User\Settings\ContactUserRequest;
use App\Http\Controllers\Controller;
use App\Support\User\Settings\Settings;

class SettingsController extends Controller
{
    protected $settings;
    public function __construct()
    {
        $this->settings = new Settings();
    }

    public function updateBasicData(BasicDataRequest $r)
    {
        $this->settings->basicData($r);
    }

    public function updateContactUser(ContactUserRequest $r)
    {
        $this->settings->updateContact($r);
        return response()->json(['error' => false, 'msg' => 'Updated data'], 200);
    }

    public function updateContactCompany(ContactCompanyRequest $r)
    {
        $this->settings->updateContactCompany($r);
        return response()->json(['error' => false, 'msg' => 'Updated data'], 200);
    }
}
