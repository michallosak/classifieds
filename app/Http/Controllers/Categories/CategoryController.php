<?php

namespace App\Http\Controllers\Categories;

use App\Http\Requests\Categories\Category\CreateRequest;
use App\Http\Requests\Categories\Category\EditRequest;
use App\Http\Resources\Categories\CategoriesResource;
use App\Model\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();
        return CategoriesResource::collection($categories);
    }

    public function store(CreateRequest $r){
        $c = Category::create([
            'user_id' => Auth::id(),
            'name' => $r->name,
            'parent_id' => $r->parent_id
        ]);
        return new CategoriesResource($c);
    }
    public function update(EditRequest $r, Category $c){
        $c->update($r->only([
            'name' => $r->name,
            'parent_id' => $r->parent_id
        ]));
        return new CategoriesResource($c);
    }

    public function destroy(Category $c){
        $c->delete();
        return response()->json([
            'error' => false,
            'msg' => 'Category deleted!'
        ], 200);
    }
}
