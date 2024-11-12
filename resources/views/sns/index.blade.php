@extends('layouts.app')
@section('content-body')
    <div class="container-fluid px-0">

        <section class="it-hero-wrapper it-dark">
            <!-- - img-->
            <div class="img-responsive-wrapper">
                <div class="img-responsive">
                    <div class="img-wrapper"><img src="{{Theme::url('/assets/bg-hero-index.png')}}"
                                                  title="titolo immagine" alt="descrizione immagine"></div>
                </div>
            </div>
            <!-- - texts-->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-hero-text-wrapper bg-dark">
                            {{--							<span class="it-Categoria">Categoria</span>--}}
                            <h3 class="fw-bold">Scopri il tuo futuro, costruisci l'eccellenza: entra alla Normale.</h3>
                            {{--							<p class="d-none d-lg-block">Candidati per i corsi di orientamento</p>--}}
                            <div class="it-btn-container"><a class="btn btn-sm btn-secondary" href="#">Candidati per i
                                    corsi di orientamento</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="evidence-section">
            <div class=""
                 {{--                 style="background: linear-gradient(to bottom, #B8D9E2 50%, #FFFFFF 50%);"--}}
                 style="background-color: #B8D9E2;margin-bottom:-120px;min-height:260px;padding-top:40px;"
            >
                <div class="container" style="">
                    <div class="row">
                        <h2 class="text-center text-primary">Per saperne di più</h2>
                    </div>
                </div>
            </div>
            <div class="container" style="background-color: transparent">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card-wrapper px-0">
                            <div class="card card-img">
                                <div class="card-body" style="height:120px;">
                                    <h3 class="card-title h5 text-primary">Parla con noi</h3>
                                    <p class="card-text font-serif">chiedi al nostro chatbot o consulta le nostre
                                        FAQ</p>
                                </div>
                                <div class="img-responsive-wrapper">
                                    <div class="img-responsive img-responsive-panoramic">
                                        <figure class="img-wrapper">
                                            <img src="{!! Theme::url('/assets/img1.png') !!}"
                                                 title="titolo immagine" alt="descrizione immagine">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card-wrapper px-0">
                            <div class="card card-img">
                                <div class="card-body" style="height:120px;">
                                    <h3 class="card-title h5 text-primary">Sportello da Studente a Studente</h3>
                                    <p class="card-text font-serif">incontra online i nostri studenti Tutor</p>
                                </div>
                                <div class="img-responsive-wrapper">
                                    <div class="img-responsive img-responsive-panoramic">
                                        <figure class="img-wrapper">
                                            <img src="{!! Theme::url('/assets/img2.png') !!}"
                                                 title="titolo immagine" alt="descrizione immagine">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{--        Pagine orientamento--}}

        <section style="background-color:#F4FAFB" class="pt-5">

            <div class="container">
                <h2>Partecipa alle nostre attività di orientamento</h2>
                <p class="" style="color:#2F475E;">Scopri le opportunità offerte per partecipare ad eventi di
                    orientamento, visitare i luoghi della Normale e vivere esperienze educative uniche.</p>
                <div class="row pb-5">
                    <div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
                        <!--start card-->
                        @foreach($pagine as $pagina)
                            <div class="card card-bg rounded card-teaser bg-white card-orientamento"
                                 style="border-top: 3px solid #005A74;">
                                <div class="card-body">
                                    <h5 class="card-title h5 text-primary">{{$pagina->titolo_it}}</h5>
                                    <p class="card-text font-serif">
                                        <a href="/pagina-orientamento/{{$pagina->id}}">
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
                </div>

                <div class="d-flex justify-content-end pb-5">
                    <button type="button" class="btn btn-outline-primary">
                        Scopri l'orientamento
                        <svg class="icon icon-primary">
                            <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        {{--        News--}}

        <section class="pt-5">
            <div class="container">
                <h2 class="pb-5">In evidenza</h2>


                <div class="row">

                    @if($newsAlta)
                        <div class="col-12 pb-5">
                            <!--start card-->
                            <div class="card-wrapper">
                                <div class="card card-bg card-img no-after">
                                    <div class="card-body d-flex p-0">
                                        <div class="img-responsive-wrapper w-50">
                                            <div class="img-responsive img-responsive-panoramic">
                                                <figure class="img-wrapper">
                                                    <img src="{{$newsAlta->picture}}"
                                                         title="{{$newsAlta->titolo_it}}"
                                                         alt="{{$newsAlta->titolo_it}}">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center w-50 align-items-center">
                                            <h3 class="card-title h5 ">{{$newsAlta->titolo_it}}</h3>
                                            <p class="card-text font-serif">{{$newsAlta->sottotitolo_it}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                    @endif
                </div>
                <div class="row pb-5">

                    @foreach ($newsBasse as $newsBassa)
                        <div class="col-12 col-lg-4">
                            <!--start card-->
                            <div class="card-wrapper">
                                <div class="card card-bg  card-img no-after">
                                    <div class="img-responsive-wrapper">
                                        <div class="img-responsive img-responsive-panoramic">
                                            <figure class="img-wrapper">
                                                <img src="{{$newsBassa->picture}}"
                                                     title="{{$newsBassa->titolo_it}}" alt="{{$newsBassa->titolo_it}}">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title h5 ">{{$newsBassa->titolo_it}}</h3>
                                        {{--                                        <p class="card-text font-serif"></p>--}}
                                        {{--                                        <a class="read-more" href="#">--}}
                                        {{--                                            <span class="text">Leggi di più</span>--}}
                                        {{--                                            <span class="visually-hidden">su Lorem ipsum dolor sit amet, consectetur adipiscing elit…</span>--}}
                                        {{--                                            <svg class="icon">--}}
                                        {{--                                                <use href="/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>--}}
                                        {{--                                            </svg>--}}
                                        {{--                                        </a>--}}
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                    @endforeach

                </div>

                <div class="d-flex justify-content-end pb-5">
                    <a href="/archivio-news">
                        <button type="button" class="btn btn-outline-primary">
                            Tutte le notizie
                            <svg class="icon icon-primary">
                                <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
        </section>


        {{-- Newsletter --}}

        <section class="pt-5" style="background: #B8D9E2;">
            <div class="container text-center">
                <h2 class="">Vuoi rimanere aggiornato sulle nostre attività?</h2>
                <p>Iscriviti per ricevere la nostra newsletter</p>

                <div class="row pt-4">
                    <div class="col-12 col-lg-6 m-auto">
                        <div class="form-group">
                            <label class="active" for="exampleInputTime">Email</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       placeholder="Inserisci la tua email"
                                       aria-label="Inserisci la tua email" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="button-3">Iscriviti</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        {{--        Eventi--}}

        <section class="pt-5" style="background-color:#F4FAFB">
            <div class="container">
                <h2 class="pb-5">Eventi</h2>


                <div class="row pb-5">

                    @foreach ($eventi as $evento)
                        <div class="col-12 col-lg-4">
                            <!--start card-->
                            <div class="card-wrapper">
                                <div class="card card-bg  card-img no-after">
                                    <div class="img-responsive-wrapper">
                                        <div class="img-responsive img-responsive">
                                            <figure class="img-wrapper">
                                                <img src="{{$evento->picture}}"
                                                     title="{{$evento->titolo_it}}" alt="{{$evento->titolo_it}}">
                                            </figure>
                                            @if ($evento->data)
                                                @php
                                                    $date = \Carbon\Carbon::createFromFormat("Y-m-d",$evento->data)->locale('it_IT');
                                                @endphp
                                                <div class="card-calendar d-flex flex-column justify-content-center">
                                                    <span class="card-date">{{$date->day}}</span>
                                                    <span class="card-day">{{$date->monthName}}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title h5 ">{{$evento->titolo_it}}</h3>
                                        {{--                                        <p class="card-text font-serif"></p>--}}
                                        {{--                                        <a class="read-more" href="#">--}}
                                        {{--                                            <span class="text">Leggi di più</span>--}}
                                        {{--                                            <span class="visually-hidden">su Lorem ipsum dolor sit amet, consectetur adipiscing elit…</span>--}}
                                        {{--                                            <svg class="icon">--}}
                                        {{--                                                <use href="/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>--}}
                                        {{--                                            </svg>--}}
                                        {{--                                        </a>--}}
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                    @endforeach

                </div>

                <div class="d-flex justify-content-end pb-5">
                    <a href="/archivio-eventi">
                        <button type="button" class="btn btn-outline-primary">
                            Tutti gli eventi
                            <svg class="icon icon-primary">
                                <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
        </section>

    </div>
@stop

