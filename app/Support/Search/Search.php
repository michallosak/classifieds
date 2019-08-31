<?php


namespace App\Support\Search;

use App\Model\Page\Advertisement;

class Search
{
    public function search($r)
    {
        $classifieds = Advertisement::with(['price', 'photos', 'follow'])
            ->where('title', 'like', '%' . $r->title . '%')
            ->orWhere(['category_id' => $r->category_id])
            ->orWhere(['location' => $r->location])
            ->paginate(20);
        return $classifieds;
    }
}
