<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Http\Requests\ReadMessagesRequest;
use App\Http\Resources\MessengerResource;
use App\Models\Messenger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $idChat
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($idChat)
    {
        $messages = Messenger::where('chat_id', '=', $idChat)
            ->orderBy('created_at', 'ASC')->get();
        return MessengerResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MessageRequest $request
     * @param int $idChat
     * @return MessengerResource
     */
    public function store(MessageRequest $request, int $idChat)
    {
        $messageForCreate = new Messenger();
        $messageForCreate->fill($request->validated());
        $user = auth('sanctum')->user();
        $messageForCreate->user_id = $user->id;
        $messageForCreate->chat_id = $idChat;
        $messageForCreate->status = 'sent';
        $messageForCreate->save();
        return new MessengerResource($messageForCreate);
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
        $itemForDelete = Messenger::where('id', '=', $id)->first();
        if (!$itemForDelete) {
            return response(null, Response::HTTP_NOT_FOUND);
        }
        $itemForDelete->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     *
     * @param \App\Http\Requests\ReadMessagesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function readMessages(ReadMessagesRequest $request)
    {
        $findMessages = Messenger::whereIn('id', $request->ids)->get();
        foreach ($findMessages as $mes) {
            $mes->status = 'read';
            $mes->save();
        }
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
