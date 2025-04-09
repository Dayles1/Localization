<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{
    public function index()
    {   
        $paginatedPosts = Post::paginate(10);
        return $this->responsePagination(
            paginator: $paginatedPosts,
            data: $paginatedPosts->items(),
            message: __('message.posts.retrieved'),
            status: 200
        );
    }
    public function store(PostStoreRequest $request){
     $post=Post::create([
        'price'=>$request->price,
        'user_id'=>auth()->user()->id
     ]);
     $translations = $this->prepareTranslations($request->translations, ['name', 'description']);
     $post->fill($translations);
    $post->save();
     return $this->success($post->load('translations'),__('message.posts.created'),201,);
    }
    public function update(PostUpdateRequest $request, $id)
    {

        $post=Post::findOrFail($id);

        if($post->user_id !== auth()->user()->id){
            return $this->error(__('message.posts.forbidden'),403);
        }
        $post->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
        ]);
        return $this->success($post,__('message.posts.updated'),200);
    }
    public function destroy($id)
    {
        $post=Post::findOrFail($id);

        if($post->user_id != auth()->user()->id){
            return $this->error(__('message.posts.forbidden'),403);
        }

        $post->delete();
        return $this->success([],__('message.posts.deleted'),200);
    }
}
 