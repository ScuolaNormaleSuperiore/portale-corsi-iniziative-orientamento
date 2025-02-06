<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class VerifyEmail extends \Illuminate\Auth\Notifications\VerifyEmail
{


    public $role;

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
//                    'minuti' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire'),
//                    'data_iscrizione' => $dataIscrizione,
//                    'tipo_iscrizione' => Arr::get($this->attachData,'tipo','normale'),
                ]);
    }
}
