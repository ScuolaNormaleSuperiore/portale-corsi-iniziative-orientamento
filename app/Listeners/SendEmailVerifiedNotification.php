<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendEmailVerifiedNotification
{
    /**
     * Handle the event.
     *
     * @param \Illuminate\Auth\Events\Registered $event
     * @return void
     */
    public function handle(Verified $event)
    {

        $event->user->sendRegistrazioneStudenteNotification();
    }
}
