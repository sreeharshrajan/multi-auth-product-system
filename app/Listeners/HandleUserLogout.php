<?php

namespace App\Listeners;

use App\Events\UserOffline;
use App\Services\PresenceService;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        if (!$event->user) return;

        $user = $event->user;
        $type = $user instanceof \App\Models\Admin ? 'admin' : 'customer';

        PresenceService::markOffline($user->id, $type);
        broadcast(new UserOffline($user->id, $type));
    }
}
