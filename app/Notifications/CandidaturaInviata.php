<?php

namespace App\Notifications;

use App\Models\Candidato;
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

class CandidaturaInviata extends Notification
{


    protected $candidato;
    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    public function __construct(Candidato $candidato)
    {
        $this->candidato = $candidato;
    }


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

        if ($this->candidato->tipo == 'scuola') {
            $view = 'emails.notifications.candidatura-inviata-scuola';
            $subject = 'Canidatura inviata';
        } elseif ($this->candidato->tipo == 'studente') {
            $view = 'emails.notifications.candidatura-inviata-studente';
            $subject = 'Canidatura inviata';
        }
        return (new MailMessage)
            ->subject(Lang::get($subject))
            ->view($view,
                [
                    'url' => config('app.url'),
//                    'minuti' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire'),
//                    'data_iscrizione' => $dataIscrizione,
//                    'tipo_iscrizione' => Arr::get($this->attachData,'tipo','normale'),
                ]);
    }
}
