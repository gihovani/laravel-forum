<?php

namespace App\Http\Controllers;

use App\Events\NewReply;
use App\Http\Requests\ReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Reply;
use App\Thread;

class ReplyController extends Controller
{
    public function store(ReplyRequest $request, Thread $thread)
    {
        $reply = new Reply();
        $reply->body= $request->input('body');
        $reply->user_id = \Auth::user()->id;
        $reply->thread_id = $thread->id;
        $this->authorize('isOpen', $reply);

        $reply->save();
        broadcast(new NewReply($reply));
        return response()->json(['created' => 'success', 'data' => new ReplyResource($reply)], 201);
    }
    public function highlight(Reply $reply)
    {
        $this->authorize('isAdmin', $reply);
        Reply::where('thread_id', $reply->thread_id)->update(['highlighted' => false]);
        $reply->highlighted = true;
        $reply->save();
        return redirect()->route('threads.show', $reply->thread_id);
    }
    public function show(Thread $thread)
    {
        return ReplyResource::collection($thread->replies);
    }
}
