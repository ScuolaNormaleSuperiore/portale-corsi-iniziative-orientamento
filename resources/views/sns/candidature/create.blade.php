@extends('layouts.app')
@section('content-body')
    @php
        $datiStep = $steps[$step];
    @endphp
    <div class="container-fluid">


        @include('candidature.includes.breadcrumbs')

        <section class="mx-1 px-1 mx-lg-5 px-lg-5 mb-4">

{{--            @dump($req)--}}
            <div class="steppers">
                @include('candidature.includes.steps')

                <form
                      id="candidaturaForm"
                      data-bs-upload-dragdrop
                      method="POST"
                      action="{{route('candidatura.store',['iniziativa' => $iniziativa->getKey()])}}">
                    @csrf
                    <input type="hidden" name="step" value="{{$step}}"/>

                    <div class="steppers-content" aria-live="polite">

                        @include('candidature.includes.step-data')
                        <!-- Esempio END -->
                    </div>
                    @include('candidature.includes.step-buttons')
                </form>
            </div>

        </section>

    </div>
@stop

