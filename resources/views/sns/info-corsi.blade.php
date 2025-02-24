@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')
        <div class="container">


            <section class="pb-4">
                <div class="row">

                    <div class="col-12 col-lg-4">
{{--                        @if(count($iniziative) > 0)--}}
{{--                                @include('sections.navleft-pagine-info-corsi-attivi',--}}
{{--                                    ['iniziative' => $iniziative])--}}
{{--                        @endif--}}

                        @if($pagina)
                            @include('sections.navleft',['navTitle' => $pagina->titolo_it])
                        @endif
                        @include('sections.navleft-pagine-info')
                    </div>
                    <div class="col-12 col-lg-8">
                        <section class="pb-4">
                            {!! $descrizione->testo_it !!}
                        </section>
                        @if($pagina)
                            <hr/>
                            <section class="pt-4">
                                <h2 class="h2">{{$pagina->titolo_it}}</h2>
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
                                        <h3 class="h3">{{$section->nome_it}}</h3>
                                        <p>{!! $section->contenuto_it !!}</p>
                                    </div>
                                @endforeach
                            </section>
                        @endif
                    </div>

                </div>

            </section>
        </div>

    </div>
@stop

