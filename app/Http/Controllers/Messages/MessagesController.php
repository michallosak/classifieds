<?php

namespace App\Http\Controllers\Messages;

use App\Http\Requests\Messages\SendMessageRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Messages\MessagesResource;
use App\Model\Message\Message;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function store(SendMessageRequest $r){
        $send = Message::create([
            'user_id' => Auth::id(),
            'seller_id' => $r->seller_id,
            'ad_id' => $r->ad_id,
            'message' => $r->message
        ]);
        return new MessagesResource($send);
    }
}
