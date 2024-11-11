@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')
        <div class="container">

            <section class="pb-4">
                {!! $descrizione->testo_it !!}
            </section>

            <section class="pb-4">
                <div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
                    <!--start card-->
                    @foreach($classi as $classe)
                        <div class="card card-bg  card-teaser" style="border-radius: 4px;border-top: 3px solid #005A74;">
                            <div class="card-body">
                                <h5 class="card-title h5 text-primary">{{$classe->nome_it}}</h5>
                                <p class="card-text font-serif">
                                    <a href="/sportello-studenti/{{$classe->id}}">
                                        Scopri di più
                                        <svg class="icon icon-primary">
                                            <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                                        </svg>
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
        </div>

    </div>
@stop

