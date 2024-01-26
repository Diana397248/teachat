<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendRequestResource;
use App\Models\Chat;
use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FriendRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        $myRequests = FriendRequest::where("friend_id", "=", $user->id)->get();
        return FriendRequestResource::collection($myRequests);
    }

    /**
     * assept request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function acceptRequest(Request $request): Response
    {
        $userId = auth('sanctum')->user()->id;
        if ($request->has('friend_id')) {
            $friendId = $request->input('friend_id');

            $findRequest = FriendRequest::where("friend_id", "=", $userId)
                ->where("user_id", "=", $friendId)->first();
            if (!$findRequest) {
                return response(null, Response::HTTP_NOT_FOUND);
            }
            $findRequest->delete();
            Friend::createFriend($userId, $friendId);
            Chat::createUserChat($userId, $friendId);
            return response(null, Response::HTTP_NO_CONTENT);
        }

        return response(null, Response::HTTP_NOT_FOUND);

    }

    /**
     * assept request.
     *
     * @param int $friendRequestId
     * @return \Illuminate\Http\Response
     */
    public function cancelRequest($friendRequestId): Response
    {
        $reqToCancel = FriendRequest::find($friendRequestId);
        $reqToCancel->delete();
        return response(null, Response::HTTP_OK);
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
        //
    }
}
