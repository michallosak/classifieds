<?php

namespace App\Model\Message;

use App\Model\Page\Advertisement;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'seller_id',
        'ad_id',
        'message'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
    }
}
