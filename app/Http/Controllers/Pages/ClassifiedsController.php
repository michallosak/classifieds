<?php

namespace App\Http\Controllers\Pages;

use App\Http\Requests\Pages\Classifieds\CreateRequest;
use App\Http\Requests\Pages\Classifieds\EditRequest;
use App\Http\Resources\Pages\ClassifiedsResource;
use App\Model\Page\Advertisement;
use App\Http\Controllers\Controller;
use App\Support\Pages\Classifieds\AdvertisementPrivate;
use App\Support\Pages\Classifieds\AdvertisementPublic;

class ClassifiedsController extends Controller
{
    protected $adPOST;
    protected $adGET;

    public function __construct()
    {
        $this->adPOST = new AdvertisementPrivate();
        $this->adGET = new AdvertisementPublic();
    }

    public function index()
    {
        $classifieds = $this->adGET->index();
        return ClassifiedsResource::collection($classifieds);
    }

    public function indexPro(){
        $classifieds = $this->adGET->indexPro();
        return ClassifiedsResource::collection($classifieds);
    }

    public function store(CreateRequest $r)
    {
        $a = $this->adPOST->store($r);
        return new ClassifiedsResource($a);
    }

    public function view($id)
    {
        $advertisement = $this->adGET->show($id);
        return new ClassifiedsResource($advertisement);
    }

    public function update(EditRequest $r, Advertisement $advertisement)
    {
        $advertisement = $this->adPOST->update($r, $advertisement);
        return new ClassifiedsResource($advertisement);
    }

    public function destroy(Advertisement $advertisement)
    {
        $this->adPOST->destroy($advertisement);
    }

    public function classifiedsInCity($city)
    {
        $classifieds = $this->adGET->indexCity($city);
        return ClassifiedsResource::collection($classifieds);
    }

    public function moveToArchive($id){
        Advertisement::where('id', $id)
            ->update(['status' => 2]);
        return response()->json([
            'error' => false,
            'msg' => 'Updated advertisement'
        ], 200);
    }

    public function removeFromArchive($id){
        Advertisement::where('id', $id)
            ->update(['status' => 1]);
        return response()->json([
            'error' => false,
            'msg' => 'Updated advertisement'
        ], 200);
    }
}
