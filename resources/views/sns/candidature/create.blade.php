@extends('layouts.app')
@section('content-body')
    @php
        $datiStep = $steps[$step];
    @endphp
    <div class="container-fluid">


        @include('candidature.includes.breadcrumbs')

        <section class="mx-1 px-1 mx-lg-5 px-lg-5 mb-4">

            <div class="steppers">
                @include('candidature.includes.steps')

                <form method="POST" action="{{route('candidatura.store',['iniziativa' => $iniziativa->getKey()])}}">
                    @csrf
                    <input type="hidden" name="step" value="{{$step}}"/>

                    <div class="steppers-content" aria-live="polite">
                        <!-- Esempio START -->
                        <div class="row">

                            @if (count($datiStep['sections']) > 1)
                                <div class="col-12 col-lg-4">
                                    @include('candidature.includes.navleft',['sezioni' => $datiStep['sections']])
                                </div>
                                <div class="col-12 col-lg-8">
                                    <p>I campi contraddistinti dal simbolo asterisco (*) sono obbligatori</p>

                                    @foreach ($datiStep['sections'] as $sezioneForm)
                                        <div class="" id="sezione_{{$sezioneForm['code']}}">
                                            <div class="card no-after rounded mb-4" style="background-color:#EFF8FA;">
                                                <div class="card-body">
                                                    <h3 class="card-title h3">{{$sezioneForm['title']}}</h3>
                                                    @if(\Illuminate\Support\Arr::get($sezioneForm,'subtitle'))
                                                        <p class="card-text text-secondary">
                                                            {{$sezioneForm['subtitle']}}
                                                        </p>
                                                    @endif
                                                    <div class="card rounded bg-white">
                                                        <div class="card-body">
                                                            @include('candidature.sezioni.'.$sezioneForm['code'],['datiStep' => $datiStep,'sectionData' => $sezioneForm])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="col-12">
                                    <p>I campi contraddistinti dal simbolo asterisco (*) sono obbligatori</p>
                                    @foreach ($datiStep['sections'] as $sezioneForm)
                                        @include('candidature.sezioni.'.$sezioneForm['code'],['datiStep' => $datiStep])
                                    @endforeach
                                </div>
                            @endif

                        </div>
                        <!-- Esempio END -->
                    </div>
                    <nav class="steppers-nav">
                        <div>
                            @if($step > 1)
                                <button type="button" class="btn btn-outline-primary btn-sm steppers-btn-prev">
                                    <svg class="icon icon-primary">
                                        <use href="{{Theme::url('svg/sprites.svg')}}#it-chevron-left"></use>
                                    </svg>
                                    Indietro
                                </button>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end gap-lg-3 gap-5">

                            <button type="submit" class="btn btn-primary btn-sm steppers-btn-save d-lg-block">
                                Salva
                            </button>
                            <button type="submit" class="btn btn-outline-primary btn-sm steppers-btn-next">Avanti
                                <svg class="icon icon-primary">
                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-chevron-right"></use>
                                </svg>
                            </button>


                        </div>
                    </nav>
                </form>
            </div>

        </section>

    </div>
@stop

