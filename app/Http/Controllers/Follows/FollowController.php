<?php

namespace App\Http\Controllers\Follows;

use App\Http\Requests\Follows\FollowRequest;
use App\Http\Resources\Pages\ClassifiedsResource;
use App\Http\Resources\User\UserResource;

use App\Support\Follow\Follow;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    protected $follow;

    public function __construct()
    {
        $this->follow = new Follow();
    }

    public function setFollowAd(FollowRequest $r)
    {
        $type = 'AD';
        $this->follow->follow($r, $type);
    }

    public function setFollowUser(FollowRequest $r)
    {
        $type = 'USER';
        $this->follow->follow($r, $type);
    }

    public function classifieds()
    {
        $classifieds = \App\Model\Follow\Follow::with(['ad'])
            ->where(['user_id' => Auth::id(), 'follow_type' => 'AD'])
            ->paginate(20);
        return ClassifiedsResource::collection($classifieds);
    }

    public function users()
    {
        $users = \App\Model\Follow\Follow::with(['users'])
            ->where(['user_id' => Auth::id(), 'follow_type' => 'USER'])
            ->paginate(20);
        return UserResource::collection($users);
    }
}
