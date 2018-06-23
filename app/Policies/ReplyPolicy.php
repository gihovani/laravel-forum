<?php

namespace App\Policies;

use App\Reply;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function isAdmin(User $user, Reply $reply)
    {
        return $user->role == 'admin';
    }
    public function isOpen(User $user, Reply $reply)
    {
        return !$reply->thread->closed;
    }
}
