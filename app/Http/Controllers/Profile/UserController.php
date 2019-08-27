<?php

namespace App\Http\Controllers\Profile;

use App\Http\Resources\Rewievs\ReviewsResource;
use App\Http\Resources\User\UserResource;
use App\Model\Rating\Rating;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function user($id){
        $user = User::with(['avatar', 's', 'classifieds'])
            ->find($id);
        return new UserResource($user);
    }

    public function reviewsUser($id){
        $reviews = Rating::with(['user'])
            ->where(['rating_id' => $id, 'type' => 'USER'])
            ->paginate(20);
        return ReviewsResource::collection($reviews);
    }
}
