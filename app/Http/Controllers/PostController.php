<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Http\Utils\FileUtils;
use App\Models\Post;
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
        if ($user) {
            $userCategoriesIds = $user->likeCategories()->get()
                ->map(function ($elem) {
                    return $elem->category_id;
                });
            if ($userCategoriesIds->count() > 0) {
                $postsWithUserLikesCategories = Post::whereIn('category_id', $userCategoriesIds)->get();
                return PostResource::collection($postsWithUserLikesCategories);
            }
        }
        return PostResource::collection(Post::all());
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
        $user = auth('sanctum')->user();
        $postForCreate->user_id = $user->id;
        $srcContent = FileUtils::saveToLocalFromRequest($request, "content_data");
        $postForCreate->content_src = $srcContent;
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
