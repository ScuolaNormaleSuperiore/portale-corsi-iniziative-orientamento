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
                Ti ringraziamo per l’invio della tua candidatura.
            </p>
            <p class="mt-2">
                Gli esiti delle selezioni saranno pubblicati su questo sito entro il mese di maggio.
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
