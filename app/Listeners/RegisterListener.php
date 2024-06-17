<?php

namespace App\Listeners;

use App\Events\LogoutEvent;
use App\Events\RegisterEvent;
use App\Notifications\LogoutNotification;
use App\Notifications\NotificationRegisterdUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Events\Dispatcher;

class RegisterListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }


    //if you listen on multiple events
    public function handleUserRegister(RegisterEvent $event): void
    {
        $user = $event->user;
        $user->notify(new NotificationRegisterdUser());
        Log::channel('daily')->info($user);
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout(LogoutEvent $event): void
    {
        $user = $event->user;
        $user->notify(new LogoutNotification());
        Log::channel('daily')->info($user);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            RegisterEvent::class => 'handleUserRegister',
            LogoutEvent::class => 'handleUserLogout',
        ];
    }

    /**
     * Handle the event.
     */

    //if you listen on one event
    // public function handle(RegisterEvent $event): void
    // {
    // $user = $event->user;
    // $user->notify(new NotificationRegisterdUser());
    // Log::channel('daily')->info($user);
    // }
}
