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

    public function addAvatar($s, $i){
        /*
         * | 1 | woman
         * | 2 | man
         */
        if ($s != 1){
            // man
            $src = '';
        }
        else{
            // woman
            $src = '';
        }
        Avatar::create([
            'user_id' => $i,
            'src' => $src
        ]);
        return true;
    }
}
