@if (app('request')->input('preview') == 1)


    ------------------

    URL
    @dump($link)

    ------------------

    @dd("Fine")

@endif

@extends('emails.notifications.layouts.generic')
@section('content')
    <tr>
        <td style="font-size:15px; padding:20px;">
            <p>
                <strong>Gentilissimo Referente, gentilissima Referente,<br/></strong>
            </p>
            <p>
                La ringraziamo per aver effettuato la procedura di registrazione per le attività di orientamento della Scuola Normale Superiore.
            </p>

            <p>
                Per attivare l'utenza è necessario verificare l'indirizzo email fornito, cliccando sul pulsante sottostante
            </p>
            <p class="pl-5 mt-3 mb-3">

                <a class="btn btn-primary" href="{!! $link !!}">
                    Verifica indirizzo e-mail
                </a>
            </p>
            <p>
                Potrà quindi procedere con l’inserimento delle candidature utilizzando come username l’indirizzo istituzionale della sua scuola e come password quella da voi impostata.
            </p>


            <p class="mt-5">
                <strong>
                    Lo Staff Orientamento<br/>
                    Scuola Normale Superiore
                </strong>
            </p>
        </td>
    </tr>
@endsection
