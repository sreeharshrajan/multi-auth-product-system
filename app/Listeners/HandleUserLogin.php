<?php

namespace App\Listeners;

use App\Events\UserOnline;
use App\Services\PresenceService;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserLogin
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
    public function handle(Login $event): void
    {
        $user = $event->user;
        $type = $user instanceof \App\Models\Admin ? 'admin' : 'customer';

        PresenceService::markOnline($user->id, $type);
        broadcast(new UserOnline($user->id, $type));
    }
}
