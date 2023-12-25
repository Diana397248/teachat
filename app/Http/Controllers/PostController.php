<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return PostResource
     */
    public function store(PostRequest $request)
    {
        $postForCreate = new Post(); // Post
        $postForCreate->fill($request->validated());
        //todo Set user from token
        $u = User::find(1);
        $postForCreate->user_id = $u->id;
        $postForCreate->content_src = '';
        $postForCreate->save();
        return new PostResource($postForCreate);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemForDelete = Post::where('id', '=', $id)->first();
        if (!$itemForDelete) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
        $itemForDelete->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
