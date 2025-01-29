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
                <strong>Carissima, carissimo,<br/></strong>
            </p>
            <p class="mt-3">
                ti ringraziamo per aver effettuato la procedura di registrazione per le attività di orientamento della Scuola Normale Superiore.
            </p>
            <p class="mt-2">
                Potrai quindi procedere con l’inserimento della tua candidatura utilizzando come username il tuo indirizzo email di registrazione e come password quella da te impostata.
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
