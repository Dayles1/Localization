<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{
    public function store(PostStoreRequest $request){
     $post=Post::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'price'=>$request->price,
        'user_id'=>auth()->user()->id
     ]);
     return $this->success($post,'Post created successfully',201,);
    }
    public function update(PostUpdateRequest $request, $id)
    {
        $post=Post::findOrFail($id);
        $post->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
        ]);
        return $this->success($post,'Post updated successfully',200);
    }
}
 