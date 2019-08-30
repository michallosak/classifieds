<?php

namespace App\Model\Suppert;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message'
    ];
}
