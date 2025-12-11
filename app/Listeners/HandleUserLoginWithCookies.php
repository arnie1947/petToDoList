<?php

namespace App\Listeners;

use App\Events\UserLoginWithCookies;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserLoginWithCookies
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
    public function handle(UserLoginWithCookies $event): void
    {
        if ($event->cookieGuestToken !== null) {
            Task::where('guest_token', $event->cookieGuestToken)->update([
                'user_id' => $event->user->id,
                'guest_token' => null
            ]);
        }
    }
}
