@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')
        <div class="container">

            <h2 class="visually-hidden">Futuro universitario</h2>

            <section class="pt-5">
                <div class="container">

                    <div class="row pb-5">

                        @foreach ($studenti as $studente)
                            <div class="col-12 col-lg-4 pt-5">
                                <!--start card-->
                                <div class="card-wrapper">
                                    <div class="card card-bg  card-img no-after">
                                        <div class="img-responsive-wrapper">
                                            <div class="img-responsive">
                                                <figure class="img-wrapper">
                                                    <img src="{{$studente->picture}}"
                                                         title="{{$studente->picture_alt}}"
                                                         alt="{{$studente->picture_alt}}">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title h3 ">{{$studente->nome}} {{$studente->cognome}}</h3>

                                            <div>
                                                <span class="badge bg-secondary">{{$studente->materia->nome_it}}</span>
                                            </div>
                                            <p class="card-text font-serif">
                                                {!! $studente->descrizione_it !!}
                                            </p>

                                            @if(!empty($studente->link))
                                                <p class="pt-5 d-flex justify-content-end">

                                                <a class="read-more" target="_blank" href="{{$studente->link}}">
                                                    <span class="text">
                                                        <button type="button" class="btn btn-outline-primary">
                                                        Per parlare con me
                                                        <svg class="icon icon-primary">
                                                            <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                                                        </svg>
                                                        </button>
                                                    </span>
                                                    <span class="visually-hidden">Per parlare con me</span>
                                                </a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                            </div>
                        @endforeach

                    </div>

                </div>
            </section>


        </div>

    </div>
@stop

