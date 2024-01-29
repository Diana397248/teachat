<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Http\Utils\FileUtils;
use App\Models\User;
use App\Models\UserLikeCategories;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserProfileResource
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        return new UserProfileResource($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
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
     * @param UserProfileRequest $request
     * @param User $user
     * @return UserProfileResource
     */
    public function update(UserProfileRequest $request, User $user)
    {
        $user = auth('sanctum')->user();
        $userId = $user->id;
        $editProfile = User::find($userId);
        $editProfile->fill($request->validated());
        $srcContent = FileUtils::saveToLocalFromRequest($request, "avatar");
        $editProfile->avatar_src = $srcContent;

        if (count($editProfile->likeCategories) > 0) {
            foreach ($editProfile->likeCategories as $c) {
                $c->delete();
            }
        }
        if ($request->like_categories_ids && count($request->like_categories_ids) > 0) {
            foreach ($request->like_categories_ids as $id) {
                $newLikeCategory = new UserLikeCategories();
                $newLikeCategory->user_id = $userId;
                $newLikeCategory->category_id = $id;
                $newLikeCategory->save();
            }
        }
        $editProfile->save();
        return new UserProfileResource($editProfile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
