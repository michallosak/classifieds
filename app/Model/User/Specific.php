<?php

namespace App\Model\User;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Specific extends Model
{
    protected $fillable = [
        'user_id',
        'name', 'birthday',
        'sex'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
