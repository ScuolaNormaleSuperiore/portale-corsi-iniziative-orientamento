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
            <p class="mt-3">
                La ringraziamo per aver effettuato la procedura di registrazione per le attività di orientamento della Scuola Normale Superiore. Il suo indirizzo è in fase di verifica da parte dei gestori del sistema. Una volta abilitato, riceverà su questo stesso account la conferma dell’avvenuta registrazione.
            </p>
            <p class="mt-2">
                A seguire riceverà una comunicazione per poter procedere con l’inserimento delle candidature.
            </p>
            <p class="mt-2">
                Un cordiale saluto
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
