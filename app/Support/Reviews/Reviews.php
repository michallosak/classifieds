<?php


namespace App\Support\Reviews;


use App\Model\Rating\Rating;
use Illuminate\Support\Facades\Auth;

class Reviews
{

    public function rate($r, $type)
    {
        if ($this->check($r, $type)) {
            $this->remove($r, $type);
            $reviews = $this->set($r, $type);
            return $reviews;
        }
        $reviews = $this->set($r, $type);
        return $reviews;
    }

    protected function check($r, $type)
    {
        $ratingCheck = Rating::where(['user_id' => Auth::id(), 'type' => $type, 'rating_id' => $r->rating_id])
            ->first();
        return $ratingCheck;
    }

    protected function remove($r, $type)
    {
        Rating::where(['user_id' => Auth::id(), 'type' => $type, 'rating_id' => $r->rating_id])
            ->delete();
    }

    protected function set($r, $type)
    {
        $rating = Rating::create([
            'user_id' => Auth::id(),
            'rating_id' => $r->rating_id,
            'rating' => $r->rating,
            'opinion' => $r->opinion,
            'type' => $type
        ]);
        return $rating;
    }

}
