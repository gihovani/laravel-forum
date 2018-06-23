<?php

namespace App\Http\Controllers;

use App\Events\NewThread;
use App\Http\Requests\ThreadRequest;
use App\Http\Resources\ThreadResource;
use App\Thread;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::orderBy('fixed', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return ThreadResource::collection($threads);
    }

    public function store(ThreadRequest $request)
    {
        $thread = $this->saveThread($request, new Thread());
        broadcast(new NewThread($thread));
        return response()->json(['created' => 'success', 'data' => new ThreadResource($thread)], 201);
    }

    public function show(Thread $thread)
    {
        return view('threads.show', ['thread' => new ThreadResource($thread)]);
    }

    public function update(ThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);
        $thread = $this->saveThread($request, $thread);
        return redirect()->route('threads.show', $thread->id);
    }

    private function saveThread(ThreadRequest $request, Thread $thread)
    {
        $thread->title = $request->input('title');
        $thread->body = $request->input('body');
        $thread->user_id = \Auth::user()->id;
        $thread->save();
        return $thread;
    }

    public function edit(Thread $thread)
    {
        return view('threads.edit', compact('thread'));
    }

    public function pin(Thread $thread)
    {
        $this->authorize('isAdmin', $thread);

        Thread::where('fixed', true)->update(['fixed' => false]);
        $thread->fixed = true;
        $thread->save();
        return redirect()->route('home');

    }
    public function close(Thread $thread)
    {
        $this->authorize('isAdmin', $thread);

        $thread->closed = true;
        $thread->save();
        return redirect()->route('home');
    }

    public function destroy(Thread $thread)
    {
        //
    }
}
