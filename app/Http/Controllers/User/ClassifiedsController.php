<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\Pages\ClassifiedsResource;
use App\Http\Controllers\Controller;
use App\Support\User\Pages\Classifieds;

class ClassifiedsController extends Controller
{
    protected $classifieds;
    public function __construct()
    {
        $this->classifieds = new Classifieds();
    }

    public function index(){
        $classifieds = $this->classifieds->index();
        return ClassifiedsResource::collection($classifieds);
    }
}
