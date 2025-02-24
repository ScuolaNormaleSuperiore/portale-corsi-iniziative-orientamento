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
                    @if($pagina->picture)
                    <div class="img-responsive-wrapper">
                        <div class="img-responsive img-responsive-panoramic">
                            <figure class="img-wrapper">
                                <img src="{{$pagina->picture}}"
                                     title="{{$pagina->picture_alt}}"
                                     alt="{{$pagina->picture_alt}}">
                            </figure>
                        </div>
                    </div>
                    @endif
                        @foreach ($pagina->sezioni as $section)
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

