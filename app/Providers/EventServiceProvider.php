<?php

namespace App\Providers;

use App\Events\RichiestaScuola;
use App\Listeners\SendEmailVerifiedNotification;
use Gecche\Cupparis\App\Listeners\UserEventSubscriber;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Verified::class => [
            SendEmailVerifiedNotification::class,
        ],
        \Slides\Saml2\Events\SignedIn::class => [
            \App\Listeners\SamlSignedInListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }


    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventSubscriber::class,
    ];
}
