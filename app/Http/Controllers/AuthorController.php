<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::with(['posts','comments'])->paginate();
        return new UserCollection($authors);
    }

    public function show($id)
    {
        $author = User::with(['posts', 'comments'])->where('id', $id)->first();
        return new UserResource($author);
    }

    public function store(ProfileStoreRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }

    public function update(ProfileUpdateRequest $request, $id)
    {
        return new UserResource(User::where('id', $id)->update($request->all()));
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json(['message' => 'Autor eliminado']);
    }
}
