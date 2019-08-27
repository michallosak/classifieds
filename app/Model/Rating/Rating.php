<?php

namespace App\Model\Rating;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'rating_id',
        'rating',
        'type',
        'opinion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)
            ->with(['s', 'avatar']);
    }
}
