<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\HandleUserLogin;
use Illuminate\Auth\Events\Logout;

use App\Listeners\HandleUserLogout;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            HandleUserLogin::class,
        ],

        Logout::class => [
            HandleUserLogout::class,
        ],
    ];


    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Broadcast::routes([
            'middleware' => ['web', 'auth'],
        ]);

        require base_path('routes/channels.php');
    }

    public function shouldDiscoverEvents(): bool
    {
        return  true;
    }
}
