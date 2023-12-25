<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendResource;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return FriendResource::collection(Friend::all());
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
     * @param int $userId
     * @return \Illuminate\Http\Response
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
