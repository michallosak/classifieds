<?php

namespace App\Http\Controllers\Supports;

use App\Http\Requests\Supports\ContactRequest;
use App\Http\Resources\Supports\ContactResource;
use App\Model\Suppert\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function send(ContactRequest $r){
        $contact = Contact::create([
            'name' => $r->name,
            'email' => $r->email,
            'message' => $r->message
        ]);
        return new ContactResource($contact);
    }
}
