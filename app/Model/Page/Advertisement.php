<?php

namespace App\Model\Page;

use App\Model\Category\Category;
use App\Model\Follow\Follow;
use App\Model\Message\Message;
use App\Model\Photo\Photo;
use App\Model\Price\Price;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Advertisement extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'location',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)
            ->with(['avatar', 's', 'company', 'contact']);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function price()
    {
        return $this->hasOne(Price::class, 'ad_id', 'id')
            ->where('type', 'AD')
            ->select(['ad_id', 'price', 'currency', 'type']);
    }

    public function follow()
    {
        return $this->hasMany(Follow::class, 'follow_id', 'id');
    }

    public function photos(){
        return $this->hasMany(Photo::class, 'photo_id', 'id')
            ->where('type', 'AD');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
