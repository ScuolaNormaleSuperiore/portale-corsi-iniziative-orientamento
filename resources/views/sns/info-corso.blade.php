@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')
        <div class="container">


            <section class="pb-4">
                <div class="row">

                    <div class="col-12 col-lg-4">

                            @include('sections.navleft',['navTitle' => null])
{{--                            @include('sections.navleft-pagine-info')--}}
                        {{-- @include('sections.navleft-pagine-info-corsi-attivi',
                            ['corsi' => $corsi]) --}}
                    </div>
                    <div class="col-12 col-lg-8">
{{--                        <section class="pb-4">--}}
{{--                            {!! $descrizione->testo_it !!}--}}
{{--                        </section>--}}
{{--                            <hr/>--}}
                            <section class="pt-4">
                                <h2 class="h2">{{$corso->titolo}}</h2>
                                @if($corso->picture)
                                    <div class="img-responsive-wrapper">
                                        <div class="img-responsive img-responsive-panoramic">
                                            <figure class="img-wrapper">
                                                <img src="{{$corso->picture}}"
                                                     title="{{$corso->picture_alt}}"
                                                     alt="{{$corso->picture_alt}}">
                                            </figure>
                                        </div>
                                    </div>
                                @endif

                                <div class="d-xl-flex gap-3 pt-4">

                                    <div class="">

                                        @if($corso->data_inizio)
                                            @php
                                                $date = \Carbon\Carbon::createFromFormat("Y-m-d",$corso->data_inizio)->locale('it_IT');
                                            @endphp
                                            <div class="chip chip-lg alert chip-primary">
                                                <svg class="icon icon-xs icon-primary">
                                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-calendar"></use>
                                                </svg>
                                                <span class="chip-label">
                                        Dal {{$date->day}} {{$date->monthName}} {{$date->year}}
                                                    @if($corso->data_fine)
                                                        @php
                                                            $date = \Carbon\Carbon::createFromFormat("Y-m-d",$corso->data_fine)->locale('it_IT');
                                                        @endphp
                                                        al {{$date->day}} {{$date->monthName}} {{$date->year}}
                                                    @endif
                                    </span>
                                            </div>
                                        @endif
                                    </div>
                                    @if($corso->luogo || $corso->indirizzo || $corso->provincia_id)
                                        <div class="pb-4">
                                            <div class="chip chip-lg chip-success alert">
                                                <svg class="icon icon-xs icon-success">
                                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-map-marker-circle"></use>
                                                </svg>
                                                <span class="chip-label">
                                                    @if($corso->indirizzo)
                                                        {{$corso->indirizzo}},
                                                    @endif
                                                        @if($corso->luogo)
                                                            {{$corso->luogo}}
                                                        @endif
                                                        @if($corso->provincia_id)
                                                            ({{$corso->provincia->sigla}})
                                                        @endif

                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                    <div class="pt-4">
                                        <p>{!! $corso->descrizione !!}</p>
                                    </div>
                            </section>
                    </div>

                </div>

            </section>
        </div>

    </div>
@stop

