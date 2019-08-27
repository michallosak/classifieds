<?php


namespace App\Support\User\Pages;
use App\Model\Page\Advertisement;
use Illuminate\Support\Facades\Auth;

class Classifieds
{
    public function index(){
        $classifieds = Advertisement::with(['price', 'photos'])
            ->where(['user_id' => Auth::id(), 'status' => 1])
            ->orWhere(['user_id' => Auth::id(), 'status' => 7])
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return $classifieds;
    }
}
