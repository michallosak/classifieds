<?php

namespace App\Model\Page;

use App\Model\Category\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'location'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->hasOne(Category::class);
    }
}
