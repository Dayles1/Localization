<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts=Post::query();
        if($request->has('search')){
            $posts->where('name','like','%'.$request->search.'%');
        }
        if($request->has('sort_by')){
            $posts->orderBy($request->sort_by,$request->sort_type);
        }
        return $this->responsePagination($posts->paginate(10),'Posts retrieved successfully',200);
    }
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
    public function destroy($id)
    {
        $post=Post::findOrFail($id);
        $post->delete();
        return $this->success([],'Post deleted successfully',200);
    }
}
 