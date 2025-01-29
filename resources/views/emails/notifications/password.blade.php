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
                <strong>Ciao,</strong>
                <br/>
            </p>
            <p class="mt-3">
                Per reimpostare la password del tuo account per le attività di orientamento della Scuola Normale Superiore di Pisa devi cliccare su questo link
            </p>
            <p class="pl-5 mt-3 mb-3">
                <a class="btn btn-primary" href="{!! $link !!}">
                    Reimposta password
                </a>
            </p>
            <p>
                Il link per reimpostare la password sarà valido per {{$minuti}} minuti.
            </p>


            <p class="mt-5">
{{--                Se non sei stato te a richiedere di reimpostare la password, puoi ignorare questo messaggio.--}}
{{--                <br/>--}}
                <strong>
                    Lo Staff Orientamento<br/>
                    Scuola Normale Superiore
                </strong>
            </p>
        </td>
    </tr>
@endsection
