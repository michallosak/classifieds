<?php


namespace App\Support\Pages\Classifieds;


use App\Model\Page\Advertisement;
use App\Model\Price\Price;
use Illuminate\Support\Facades\Auth;

class AdvertisementPrivate
{

    public function store($r){
        $a = Advertisement::create([
            'user_id' => Auth::id(),
            'category_id' => $r->category_id,
            'title' => $r->title,
            'body' => $r->body,
            'location' => $r->location,
            'type' => $r->type
        ]);
        Price::create([
            'ad_id' => $a->id,
            'price' => $r->price,
            'currency' => $r->currency,
            'type' => 'AD'
        ]);

        return $a;
    }

    public function update($r, $advertisement){
        $advertisement->update($r->only([
            'title' => $r->title,
            'body' => $r->body,
            'location' => $r->location
        ]));
        return $advertisement;
    }

    public function destroy($advertisement){
        $advertisement->delete();
    }

}
