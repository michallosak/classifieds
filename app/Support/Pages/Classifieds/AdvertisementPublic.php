<?php


namespace App\Support\Pages\Classifieds;


use App\Model\Page\Advertisement;

class AdvertisementPublic
{
    public function index(){
        $classifieds = Advertisement::with(['price', 'photos', 'follow'])
            ->where('status', 1)
            ->orWhere('status', 7) //PRO
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return $classifieds;
    }

    public function indexPro(){
        $classifieds = Advertisement::with(['price', 'photos'])
            ->where('status', 7)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return $classifieds;
    }

    public function show($id){
        $advertisement = Advertisement::with(['user', 'category', 'price', 'photos', 'follow'])
            ->where('status', 1)
            ->orWhere('status', 7)
            ->find($id);
        return $advertisement;
    }

    public function indexCity($city){
        $classifieds = Advertisement::with(['price', 'photos', 'follow'])
            ->where(['status' => 1, 'location' => $city])
            ->orWhere(['status' => 7, 'location' => $city]) //PRO
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return $classifieds;
    }
}
