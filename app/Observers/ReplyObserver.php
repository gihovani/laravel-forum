<?php

namespace App\Observers;

use App\Reply;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $thread = $reply->thread;
        $thread->replies_count += 1;
        $thread->save();
    }
}
