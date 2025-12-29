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
                La ringraziamo per l’invio della candidatura da parte del Suo Istituto scolastico.
            </p>
            <p class="mt-2">
            Gli esiti delle selezioni saranno pubblicati su questo sito entro due settimane dal termine per la presentazione delle domande.
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
