<?php

namespace App\Http\Controllers\Archives;

use App\Http\Resources\Pages\ClassifiedsResource;
use App\Model\Page\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassifiedsController extends Controller
{
    public function index(){
        $classifieds = Advertisement::with(['price', 'photos'])
            ->where(['user_id' => Auth::id(), 'status' => 2])
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return ClassifiedsResource::collection($classifieds);
    }

    public function moveArchive(Request $r){
        Advertisement::where(['id' => $r->id, 'user_id' => Auth::id()])
            ->update([
                'status' => 2
            ]);
        return response()->json(['error' => false, 'msg' => 'Updated!'], 200);
    }
}
