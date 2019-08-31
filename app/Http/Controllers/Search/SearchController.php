<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pages\ClassifiedsResource;
use App\Support\Search\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $r)
    {
        $search = new Search();
        $classifieds = $search->search($r);
        return ClassifiedsResource::collection($classifieds);
    }
}
