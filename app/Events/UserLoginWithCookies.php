<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoginWithCookies
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public string|null $cookieGuestToken;

    public function __construct(
        User $user,
        string|null $cookieGuestToken
    ) {
        $this->user = $user;
        $this->cookieGuestToken = $cookieGuestToken;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
