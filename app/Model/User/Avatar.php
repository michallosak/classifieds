<?php

namespace App\Model\User;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = [
        'user_id', 'src'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
