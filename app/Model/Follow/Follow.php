<?php

namespace App\Model\Follow;

use App\Model\Page\Advertisement;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Follow extends Model
{
    protected $fillable = [
        'user_id',
        'follow_id',
        'follow_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ad()
    {
        return $this->belongsTo(Advertisement::class, 'follow_id', 'id')
            ->with(['photos', 'price']);
    }


    public function users(){
        return $this->belongsTo(User::class, 'follow_id', 'id')
            ->with('avatar', 's');
    }

    public function followed(){
        return (bool) Follow::where('user_id', Auth::id())
            ->where('follow_id', $this->id)
            ->first();
    }

}
