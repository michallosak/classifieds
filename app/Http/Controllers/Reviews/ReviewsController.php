<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Requests\Ratings\RatingRequest;
use App\Http\Resources\Rewievs\ReviewsResource;
use App\Support\Reviews\Reviews;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{
    protected $rating;
    public function __construct()
    {
        $this->rating = new Reviews();
    }

    public function setRatingAd(RatingRequest $r){
        $type = 'AD';
        $reviews = $this->rating->rate($r, $type);
        return new ReviewsResource($reviews);
    }

    public function setRatingUser(RatingRequest $r){
        $type = 'USER';
        $reviews = $this->rating->rate($r, $type);
        return new ReviewsResource($reviews);
    }
}
