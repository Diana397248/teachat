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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();
        //todo
        $user = User::find(1);
        if (!$user) {
            return PostResource::collection(Post::all());
        }

        $userCategoriesIds = $user->likeCategories()->get()
        ->map(function ($elem){
            return $elem->category_id;
    });
        $postsWithUserLikesCategories = Post::whereIn('category_id', $userCategoriesIds)->get();
        return PostResource::collection($postsWithUserLikesCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return PostResource
     */
    public function store(PostRequest $request)
    {
        $postForCreate = new Post(); // Post
        $postForCreate->fill($request->validated());
        //todo Set user from token
        $u = User::find(1);
        $postForCreate->user_id = $u->id;
        $postForCreate->content_src = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0A4spPaKrdGH0OOQ54vS3H8dPobB3ManNNphiO8t1ipjxqmDCHdRndTAcOUmW5GXJriU&usqp=CAU';
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
