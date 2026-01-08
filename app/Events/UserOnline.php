<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class UserOnline implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function broadcastConnection(): string
    {
        return 'reverb';
    }

    /**
     * Create a new event instance.
     */
    public function __construct(
        public int $userId,
        public string $userType
    ) {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return [
            new PresenceChannel('admins'),
        ];
    }

    public function broadcastAs()
    {
        return 'user.online';
    }

    public function broadcastWith(): array
    {
        return [
            'userId' => $this->userId,
            'userType' => $this->userType,
        ];
    }
}
