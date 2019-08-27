<?php

namespace App\Model\Price;

use App\Model\Page\Advertisement;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'ad_id',
        'price',
        'currency',
        'type'
    ];

    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
    }
}
