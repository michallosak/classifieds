<?php

namespace App\Model\User;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'country',
        'address',
        'post_code',
        'city'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
