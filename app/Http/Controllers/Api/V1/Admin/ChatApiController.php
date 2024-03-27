<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Http\Resources\Admin\ChatResource;
use App\Models\Chat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ChatApiController extends Controller
{
    public function index()
    {

        $user_id = Auth::id();

        abort_if(!Auth::check(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChatResource(Chat::with(['user'])->where('user_id', $user_id)->get());
    }

    public function store(StoreChatRequest $request)
    {

        abort_if(!Auth::check(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chat = Chat::create($request->all());

        return (new ChatResource($chat))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Chat $chat)
    {
        abort_if(Gate::denies('chat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChatResource($chat->load(['user']));
    }

    public function update(UpdateChatRequest $request, Chat $chat)
    {
        $chat->update($request->all());

        return (new ChatResource($chat))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Chat $chat)
    {
        abort_if(Gate::denies('chat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chat->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
