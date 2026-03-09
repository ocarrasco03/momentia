<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Event $event): bool
    {
        return $user->isAdmin()
            || $event->users()
                ->where('user_id', $user->id)
                ->exists();
    }

    public function update(User $user, Event $event)
    {
        return $event->users()
            ->where('user_id', $user->id)
            ->whereIn('role', ['owner', 'coordinator'])
            ->exists();
    }
}
