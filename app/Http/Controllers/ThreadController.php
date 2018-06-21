<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadRequest;
use App\Thread;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::orderBy('updated_at', 'desc')->paginate();
        return response()->json($threads);
    }
    public function store(ThreadRequest $request)
    {
        $thread = $this->saveThread($request, new Thread());
        return response()->json(['created' => 'success', 'data' => $thread], 201);
    }
    public function show(Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }
    public function update(ThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);
        $thread = $this->saveThread($request, $thread);
        return redirect('/threads/' . $thread->id);
    }
    private function saveThread(ThreadRequest $request, Thread $thread)
    {
        $thread->title = $request->input('title');
        $thread->body= $request->input('body');
        $thread->user_id = \Auth::user()->id;
        $thread->save();
        return $thread;
    }
    public function edit(Thread $thread)
    {
        return view('threads.edit', compact('thread'));
    }
    public function destroy(Thread $thread)
    {
        //
    }
}
