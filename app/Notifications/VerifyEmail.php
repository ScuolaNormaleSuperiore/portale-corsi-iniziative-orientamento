<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends \Illuminate\Auth\Notifications\VerifyEmail
{


    public $role;

    public $timestamp;


    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }


        $view = $this->role == 'Scuola'
            ? 'emails.notifications.verify-email'
            : 'emails.notifications.verify-email-studente';
        $verificationUrl = $this->verificationUrl($notifiable);
        return (new MailMessage)
            ->subject(Lang::get('Verifica il tuo indirizzo email'))
            ->view($view,
                [
                    'url' => config('app.url'),
                    'link' => $verificationUrl,
                    'timestamp' => $this->timestamp,
//                    'minuti' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire'),
//                    'data_iscrizione' => $dataIscrizione,
//                    'tipo_iscrizione' => Arr::get($this->attachData,'tipo','normale'),
                ]);
    }

    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        $this->timestamp = Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60));

        return URL::temporarySignedRoute(
            'verification.verify',
            $this->timestamp,
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
