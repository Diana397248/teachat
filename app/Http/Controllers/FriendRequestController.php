<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendRequestResource;
use App\Models\FriendRequest;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return FriendRequestResource::collection(FriendRequest::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $userFriendId
     * @return FriendRequestResource
     */
    public function store(Request $request, $userFriendId)
    {
        $friendRequestForCreate = new FriendRequest();
        $u = FriendRequest::find(1);
        $friendRequestForCreate->user_id = $u->id;
        $friendRequestForCreate->friend_id = $userFriendId;
        $friendRequestForCreate->save();
        return new FriendRequestResource($friendRequestForCreate);
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
