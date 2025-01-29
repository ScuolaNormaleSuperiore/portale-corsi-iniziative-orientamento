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
                La ringraziamo per aver effettuato la procedura di registrazione per le attività di orientamento della Scuola Normale Superiore.
            </p>
            <p class="mt-2">
                Le confermiamo l’abilitazione dell’indirizzo email da lei inserito, che dovrà utilizzare come username per accedere al sistema.
            </p>
            <p class="mt-2">
                Potrà quindi procedere con l’inserimento delle candidature utilizzando come username l’indirizzo istituzionale della sua scuola e come password quella da voi impostata
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
