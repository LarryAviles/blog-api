<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['author'])->paginate();
        return new PostCollection($posts);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'like', "%$query%")->paginate();
        if (count($posts) == 0) {
            return Response::json(['message' => 'No se encontro ningún post']);
        } else {
            return new PostCollection($posts);
        }
    }

    public function show($id)
    {
        $post = Post::with(['author', 'comments'])->where('id', $id)->first();
        return new PostResource($post);
    }

    public function store(PostStoreRequest $request)
    {
        return new PostResource(Post::create($request->all()));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        return new PostResource(Post::where('id', $id)->update($request->all()));
    }

    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return response()->json(['message' => 'Post eliminado']);
    }

}
