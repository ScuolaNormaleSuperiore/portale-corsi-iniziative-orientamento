<?php

namespace App\Notifications;

use App\Models\Esame;

use App\Models\ScuolaRichiesta;
use App\Models\Studente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class RegistrazioneStudente extends Notification
{


    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;


    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $view = 'emails.notifications.registrazione-studente';
        return (new MailMessage)
            ->subject(Lang::get('Registrazione effettuata'))
            ->view($view,
                [
                    'url' => config('app.url'),
//                    'minuti' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire'),
//                    'data_iscrizione' => $dataIscrizione,
//                    'tipo_iscrizione' => Arr::get($this->attachData,'tipo','normale'),
                ]);
    }
}
