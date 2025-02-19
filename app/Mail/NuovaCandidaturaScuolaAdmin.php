<?php

namespace App\Mail;

use App\Models\Candidato;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class NuovaCandidaturaScuolaAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $candidato;
    /**
     * Create a new message instance.
     */
    public function __construct(Candidato $candidato)
    {
        $this->candidato = $candidato;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: Lang::get('Notifica candidatura Scuola'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notifications.nuova-candidatura-scuola-admin',
            with: ['url' => config('app.url') . '/login'],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
