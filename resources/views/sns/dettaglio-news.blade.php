@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0 mb-5">

        @include('sections.breadcrumbs-standard')
        <div class="container">

            <div class="row">

                @php
                $sezioni = \Illuminate\Support\Arr::get($navleft,'sezioni',[]);
                $allegati = \Illuminate\Support\Arr::get($navleft, 'allegati', []);
                $sidebar = (count($sezioni) + count($allegati)) > 0;
                @endphp

                @if($sidebar)
                <div class="col-12 col-lg-4">
                    @include('sections.navleft')
                </div>
                @endif

                <div class="col-12 {{$sidebar ? 'col-lg-8' : ''}}">
                    @if($notizia->picture)
                        <div class="img-responsive-wrapper">
                            <div class="img-responsive img-responsive-panoramic">
                                <figure class="img-wrapper">
                                    <img src="{{$notizia->picture}}">
                                </figure>
                            </div>
                        </div>


                        <div class="d-xl-flex gap-3 pt-4">

                            <div class="">

                                @if($notizia->data)
                                    @php
                                        $date = \Carbon\Carbon::createFromFormat("Y-m-d",$notizia->data)->locale('it_IT');
                                    @endphp
                                    <div class="chip chip-lg alert chip-primary">
                                        <svg class="icon icon-xs icon-primary">
                                            <use href="{{Theme::url('svg/sprites.svg')}}#it-calendar"></use>
                                        </svg>
                                        <span class="chip-label">
                                        Notizia del {{$date->day}} {{$date->monthName}} {{$date->year}}
                                    </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @endif
                    @foreach ($notizia->sezioni as $section)
                        <div class="pt-4" id="sezione_{{$loop->index}}">
                            <h2 class="h3">{{$section->nome_it}}</h2>
                            <p>{!! $section->contenuto_it !!}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
@stop

