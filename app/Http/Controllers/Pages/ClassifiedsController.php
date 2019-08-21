<?php

namespace App\Http\Controllers\Pages;

use App\Http\Requests\Pages\Classifieds\CreateRequest;
use App\Http\Requests\Pages\Classifieds\EditRequest;
use App\Http\Resources\Pages\ClassifiedsResource;
use App\Mail\Pages\Classifieds\AddMail;
use App\Model\Page\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClassifiedsController extends Controller
{
    public function index()
    {
        $classifieds = Advertisement::with(['category'])
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return ClassifiedsResource::collection($classifieds);
    }

    public function store(CreateRequest $r)
    {
        $a = Advertisement::create([
            'user_id' => Auth::id(),
            'category_id' => $r->category_id,
            'title' => $r->title,
            'body' => $r->body,
            'location' => $r->location
        ]);
        $data = $a;
        $m = new AddMail($data);
        Mail::to(Auth::user()->email)->send($m);
        return new  ClassifiedsResource($a);
    }

    public function view(Advertisement $a)
    {
        $advertisement = Advertisement::with(['user', 'category'])
            ->find($a);
        return new ClassifiedsResource($advertisement);
    }

    public function update(EditRequest $r, Advertisement $a)
    {
        $a->update($r->only([
            'title' => $r->title,
            'body' => $r->body,
            'location' => $r->location
        ]));
        return new ClassifiedsResource($a);
    }

    public function destroy(Advertisement $a)
    {
        $a->delete();
        return response()->json([
            'error' => false,
            'msg' => 'Advertisement deleted!'
        ], 200);
    }
}
