<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendResource;
use App\Http\Resources\UserResource;
use App\Models\Chat;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;


class FriendController extends Controller
{

    /**
     * Display a listing of the resource but without already added friends  .
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function listUserForAddFriend(Request $request): AnonymousResourceCollection
    {
        $user = auth('sanctum')->user();
        $alreadyAddedUserIds = Friend::where('user_id', "=", $user->id)
            ->get()
            ->map(function ($e) {
                return $e->friend_user_id;
            });

        $alreadyRequestsUserIds = FriendRequest::where('user_id', "=", $user->id)
            ->get()
            ->map(function ($e) {
                return $e->friend_id;
            });
        $userQuery = User::whereNotIn("id", $alreadyAddedUserIds)
            ->whereNotIn("id", $alreadyRequestsUserIds);


        if ($request->has('username')) {
            $username = $request->input('username');
            $userQuery = $userQuery->where('name', 'like', '%' . $username . '%');
        }

        return UserResource::collection($userQuery->get()->except($user->id));
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();
        $myFriends = Friend::where("user_id", "=", $user->id)->get();
        return FriendResource::collection($myFriends);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $userId = auth('sanctum')->user()->id;

        if ($request->has('friend_id')) {
            $friendId = $request->input('friend_id');
            if ($friendId == $userId) {
                return response(null, Response::HTTP_BAD_REQUEST);
            }


            $findRequest = FriendRequest::where("friend_id", "=", $userId)
                ->where("user_id", "=", $friendId)->first();
            if (!$findRequest) {
                $findMyRequest = FriendRequest::where("friend_id", "=", $friendId)
                    ->where("user_id", "=", $userId)->first();
                if ($findMyRequest) {
                    return response(null, Response::HTTP_OK);
                }
                $friendRequest = new FriendRequest();
                $friendRequest->user_id = $userId;
                $friendRequest->friend_id = $friendId;
                $friendRequest->save();
                return response(null, Response::HTTP_OK);
            }
            $findRequest->delete();
            Friend::createFriend($userId, $friendId);
            Chat::createUserChat($userId, $friendId);
            return response(null, Response::HTTP_NO_CONTENT);
        }

        return response(null, Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $userId
     * @return Response
     */
    public function destroy($userId)
    {
        //todo Set user from token
        $u = User::find(1);
        $itemForDelete = Friend::where('friend_user_id', '=', $userId)
            ->where('user_id', '=', $u->id)
            ->first();
        if (!$itemForDelete) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
        $itemForDelete->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
