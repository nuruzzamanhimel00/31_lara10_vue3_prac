<?php

namespace App\Providers;

use App\Events\ChatEvent;
use App\Events\UserChatEvent;
use App\Listeners\ChatListener;
use App\Events\SendMessageEvent;
use App\Events\UserMessageEvent;
use App\Listeners\UserChatListaner;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendMessageListener;
use App\Listeners\UserMessageListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ChatEvent::class =>[
            ChatListener::class
        ],
        UserChatEvent::class =>[
            UserChatListaner::class
        ],
        UserMessageEvent::class =>[
            UserMessageListener::class
        ],
        SendMessageEvent::class =>[
            SendMessageListener::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
