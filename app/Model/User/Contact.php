<?php

namespace App\Model\User;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'email'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
