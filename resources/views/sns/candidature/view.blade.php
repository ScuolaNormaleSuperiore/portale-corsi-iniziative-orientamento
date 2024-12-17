@extends('layouts.app')
@section('content-body')
    @php
        $datiStep = $steps[$step];
    @endphp
    <div class="container-fluid">


        @include('candidature.includes.breadcrumbs')

        <section class="mx-1 px-1 mx-lg-5 px-lg-5 mb-4">

            <section class="my-2 px-2 bg-white d-flex flex-column gap-2">
                @php
                    $timestamp = $candidatura->getLastTimestamp();
                @endphp
                <div class="alert alert-success mb-0" role="alert">
                    Candidatura {{$candidatura->status}} il
                    {!! $timestamp ? \App\Services\FormatValues::formatDateIta($timestamp->toDateString()) : " --- "!!}
                    alle {!! $timestamp ? $timestamp->format('H:i:s') : " --- "!!}.
                </div>
            </section>

            {{--            @dump($req)--}}
            {{-- NON E' RIEPILOGO--}}

            @include('candidature.includes.step-data-riepilogo')
            <!-- Esempio END -->
            {{--                        @include('candidature.includes.step-buttons')--}}

        </section>


    </div>
@stop

