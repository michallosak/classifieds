<?php

namespace App\Model\User;

use App\Mail\Auth\VerifyMail;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyEmail extends Model
{
    protected $fillable = [
        'user_id',
        '_key'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sendVerifyEmail($ID)
    {
        $this->saveKeyDB($ID);
    }

    private function getDataUser($ID)
    {
        $data = [
            'name' => Specific::where('user_id', $ID)->value('name'),
            'email' => User::where('id', $ID)->value('email')
        ];
        return $data;
    }

    public function sendEmail($userID)
    {
        $d = $this->getDataUser($userID);
        $data = [
            'name' => $d['name'],
            'email' => $d['email'],
            'key' => VerifyEmail::where('user_id', $userID)->value('_key')
        ];
        $e = new VerifyMail($data);
        Mail::to($data['email'])->send($e);
    }

    private function generateKey()
    {
        $key = substr(md5(time() . date('H:i:s Y-m-d')), 15, 15);
        return $key;
    }

    private function saveKeyDB($userID)
    {
        $key = $this->generateKey();
        VerifyEmail::create([
            'user_id' => $userID,
            '_key' => $key
        ]);
        $this->sendEmail($userID);
    }

    private function deleteKeyDB()
    {
        VerifyEmail::where('user_id', Auth::id())
            ->delete();
    }

    public function verifyKey($key)
    {
        $keyDB = $this->getKeyDB();
        if ($key != $keyDB) {
            return response()->json([
                'error' => true,
                'msg' => 'Invalid key!'
            ], 403);
        }
        $this->keyOK();
    }

    private function getKeyDB()
    {
        $key = VerifyEmail::where('user_id', Auth::id())->value('_key');
        return $key;
    }


    private function keyOK()
    {
        User::where('user_id', Auth::id())
            ->update([
                'activated' => 1
            ]);
        $this->deleteKeyDB();
        $this->successEmail();
        return true;
    }

    private function successEmail()
    {

    }
}
