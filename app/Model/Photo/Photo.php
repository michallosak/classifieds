<?php

namespace App\Model\Photo;

use App\Model\Page\Advertisement;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'user_id',
        'photo_id',
        'href',
        'type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
    }
}
