<?php


namespace App\Support\Follow;
use Illuminate\Support\Facades\Auth;

class Follow
{
    public function follow($r, $type)
    {
        if ($this->check($r, $type)) {
            $this->remove($r, $type);
            return true;
        }
        $this->set($r, $type);
    }

    protected function set($r, $type)
    {
        \App\Model\Follow\Follow::create([
            'user_id' => Auth::id(),
            'follow_id' => $r->follow_id,
            'follow_type' => $type
        ]);
    }

    protected function remove($r, $type)
    {
        \App\Model\Follow\Follow::where([
            'user_id' => Auth::id(),
            'follow_id' => $r->follow_id,
            'follow_type' => $type
        ])->delete();
    }

    protected function check($r, $type)
    {
        $followCheck = \App\Model\Follow\Follow::where([
            'user_id' => Auth::id(),
            'follow_id' => $r->follow_id,
            'follow_type' => $type
        ])->first();
        return $followCheck;
    }
}
