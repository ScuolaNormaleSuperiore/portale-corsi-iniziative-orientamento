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
                <strong>Gentile staff,<br/></strong>
            </p>
            <p class="mt-3">
                è stata trasmessa da parte dell’Istituto {{$candidato->scuola?->denominazione}} la seguente candidatura studente:
            </p>
            <p class="mt-2">
                @include('emails.notifications.candidatura-dati-admin')
            </p>
            <p class="pl-5 mt-3 mb-3">

                <a class="btn btn-primary" href="{!! $url !!}">
                    Vai al portale
                </a>
            </p>
{{--            <p class="mt-2">--}}
{{--                Un cordiale saluto--}}
{{--            </p>--}}


{{--            <p class="mt-5">--}}
{{--                <strong>--}}
{{--                    Lo Staff Orientamento<br/>--}}
{{--                    Scuola Normale Superiore--}}
{{--                </strong>--}}
{{--            </p>--}}
        </td>
    </tr>
@endsection
