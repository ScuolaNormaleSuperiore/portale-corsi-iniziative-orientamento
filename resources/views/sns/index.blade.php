@extends('layouts.app')
@section('content-body')
    <div class="container-fluid px-0">
        <h1 class="visually-hidden">Homepage</h1>


        @if($avvisi->count() > 0 || request()->get('newsletterconfirmed'))
            <section class="my-2 px-2 bg-white d-flex flex-column gap-2">
                @if(request()->get('newsletterconfirmed'))
                    <div class="alert alert-success mb-0" role="alert">
                        Il tuo indirizzo email è stato aggiunto alla nostra newsletter
                    </div>
                @endif
                @foreach ($avvisi as $avviso)
                    <div class="alert alert-{{$avviso->tipo ?: 'success'}} mb-0" role="alert">
                        {!! $avviso->descrizione !!}
                    </div>
                @endforeach
            </section>
        @endif


        @php
            $heroText = $copertina->titolo_it ?: "Scopri il tuo futuro, costruisci l'eccellenza: entra alla Normale.";
            $heroCallToAction = $copertina->call_to_action ?: "Candidati per i corsi di orientamento";
            $heroLink = $copertina->link ?: "/candidature";
        @endphp
        <section class="it-hero-wrapper it-dark
            @if ($copertina->picture) it-overlay @endif
        ">
            <!-- - img-->
            <div class="img-responsive-wrapper">
                <div class="img-responsive">
                    <div class="img-wrapper"><img
                            src="{{$copertina->picture ?: Theme::url('/assets/bg-hero-index.png')}}"
                            title="{{$copertina->picture_alt}}"
                            alt="{{$copertina->picture_alt}}">
                    </div>
                </div>
            </div>
            <!-- - texts-->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-hero-text-wrapper bg-dark">
                            <h2 class="fw-bold @if ($copertina->picture) text-white @endif">{{$heroText}}</h2>
                            <div class="it-btn-container"><a class="btn btn-sm btn-secondary" href="{{$heroLink}}">
                                    {{$heroCallToAction}}
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        {{--        Pagine orientamento--}}

        <section style="background-color:#F4FAFB" class="pt-5">

            <div class="container">
                <h2>Conosci le attività di orientamento</h2>
                <p class="" style="color:#2F475E;">Scopri le opportunità offerte per partecipare ad eventi di
                    orientamento, visitare i luoghi della Normale e vivere esperienze educative uniche.</p>
                <div class="row pb-5">
                    <div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
                        <!--start card-->
                        @foreach($pagine as $pagina)
                            @include('components.card-orientamento',['pagina' => $pagina])
                        @endforeach

                    </div>
                </div>

                <div class="d-flex justify-content-end pb-5">
                    <a href="/orientamento">
                        <button type="button" class="btn btn-outline-primary">
                            Scopri l'orientamento
                            <svg class="icon icon-primary">
                                <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
        </section>
            {{--        Corsi--}}

            @if ($corsi->count() > 0)
                <section style="background-color:white;" class="pt-5 border-bottom">

                    <div class="container">
                        <h2>I nostri corsi</h2>
                        {{--                <p class="" style="color:#2F475E;">Scopri le opportunità offerte per partecipare ad eventi di--}}
                        {{--                    orientamento, visitare i luoghi della Normale e vivere esperienze educative uniche.</p>--}}
                        <div class="row pb-5">
                            <div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
                                <!--start card-->
                                @foreach($corsi as $corso)
                                    @include('components.card-corso',['corso' => $corso])
                                @endforeach

                            </div>
                        </div>

                    </div>
                </section>
            @endif


            {{-- Per saperne di più --}}

            <section class="evidence-section">
                <div class=""
                     {{--                 style="background: linear-gradient(to bottom, #B8D9E2 50%, #FFFFFF 50%);"--}}
                     style="background-color: #B8D9E2;margin-bottom:-120px;min-height:260px;padding-top:40px;"
                >
                    <div class="container" style="">
                        <div class="row">
                            <h2 class="text-center">Per saperne di più</h2>
                        </div>
                    </div>
                </div>
                <div class="container" style="background-color: transparent">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            @include('components/card-img-bottom',['title' => "Parla con noi",
                                    'subtitle' =>  "chiedi al nostro chatbot o consulta le nostre FAQ",
                                    'img' =>  Theme::url('/assets/img1.png'),
                                    'link' => '/chat',
                                    ])
                        </div>
                        <div class="col-12 col-lg-6">
                            @include('components/card-img-bottom',['title' => "Sportello da studente a studente",
                                    'subtitle' =>  "incontra online studenti e studentesse Tutor",
                                    'img' =>  Theme::url('/assets/img2.png'),
                                    'link' => '/sportello-studenti',
                                    ])
                        </div>
                    </div>
                </div>
            </section>

        {{--        News--}}

        @if (count($feeds) > 0)
        <section class="pt-5">
            <div class="container">
                <h2 class="pb-5">In evidenza</h2>


                <div class="row pb-5">

                    @foreach ($feeds as $feed)
                        <div class="col-12 col-lg-4">
                            <!--start card-->
                            <div class="card-wrapper">
                                <div class="card card-bg  card-img no-after">
                                    <div class="img-responsive-wrapper">
                                        <div class="img-responsive img-responsive-panoramic">
                                            <figure class="img-wrapper">
                                                <img src="{{$feed['media']}}"
                                                     title="{!! $feed['title'] !!}" alt="{!! $feed['title'] !!}">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title h5 ">
                                            <a target="_blank" href="{{$feed['link']}}">
                                                {!! $feed['title'] !!}
                                            </a>
                                        </h3>

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
                    <a target="_blank" href="https://normalenews.sns.it">
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
        @endif


        {{-- Video --}}
        @if ($video->count() > 0)
            <section class="pt-5">
                <div class="container">
                    <h2 class="pb-5">Video</h2>


                    <div class="row pb-5">

                        <script>
                            const loadYouTubeVideo = function (videoUrl, id) {
                                const videoEl = document.getElementById(id);
                                const video = bootstrap.VideoPlayer.getOrCreateInstance(videoEl);
                                video.setYouTubeVideo(videoUrl);
                            }
                        </script>
                        @foreach ($video as $singleVideo)
                            <div class="col-12 col-lg-4">
                                @include('single-video',['item' => $singleVideo])
                            </div>
                        @endforeach

                    </div>

                    <div class="d-flex justify-content-end pb-5">
                        <a href="/archivio-video">
                            <button type="button" class="btn btn-outline-primary">
                                Tutti i video
                                <svg class="icon icon-primary">
                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-arrow-right"></use>
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- Newsletter --}}

        <section class="pt-5" style="background: #B8D9E2;">
            <div class="container text-center">
                <h2 class="">Vuoi rimanere aggiornato sulle nostre attività?</h2>
                <p>Iscriviti per ricevere la nostra newsletter</p>

                <div class="row pt-4">
                    <div class="col-12 col-lg-6 m-auto">
                        <div class="form-group">
                            <label class="active" for="exampleInputTime">Email</label>
                            <div class="input-group mb-3 newsletter-form">
                                <input type="email" required class="form-control"
                                       placeholder="Inserisci la tua email"
                                       aria-label="Inserisci la tua email">
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

        @if($eventi->count() > 0)
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
                                                     title="{{$evento->picture_alt}}"
                                                     alt="{{$evento->picture_alt}}">
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
                                      <a href="/dettaglio-evento/{{$evento->id}}" class="text-decoration-none" data-element="evento-category-link">
                                          <h3 class="card-title">{{$evento->titolo_it}}</h3>
                                      </a>
                                      @if($evento->sottotitolo_it)
                                      <p class="card-text text-secondary">
                                          {{$evento->sottotitolo_it}}
                                      </p>
                                      @endif

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

        @endif
        {{--        Evento speciale --}}

        @if($eventoSpeciale)

            <section class="pt-5 it-hero-wrapper it-dark it-overlay bg-white it-hero-small-size">
                <!-- - img-->
                <div class="img-responsive-wrapper">
                    <div class="img-responsive">
                        <div class="img-wrapper">
                            <img src="{{$eventoSpeciale->picture}}"
                                 title="{{$eventoSpeciale->picture_alt}}"
                                 alt="{{$eventoSpeciale->picture_alt}}">
                        </div>
                    </div>
                </div>
                <!-- - texts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="it-hero-text-wrapper bg-dark">
                                @if($eventoSpeciale->luogo)
                                    <span class="text-white">{{$eventoSpeciale->luogo}}</span>
                                @endif
                                <h2 class="text-white">{{$eventoSpeciale->titolo_it}}</h2>
                                <p class="d-none d-lg-block text-white">{{$eventoSpeciale->sottotitolo_it}}</p>
                                @if ($eventoSpeciale->data)
                                    @php
                                        $date = \Carbon\Carbon::createFromFormat("Y-m-d",$eventoSpeciale->data)->locale('it_IT');
                                    @endphp
                                    <div class="text-white">
                                        {{ucfirst($date->dayName)}} {{$date->day}} {{ucfirst($date->monthName)}} {{$date->year}}
                                    </div>
                                @endif
                                <div class="it-btn-container">
                                    <a class="btn btn-sm btn-secondary" href="/dettaglio-evento/{{$evento->id}}">
                                        Scopri l'evento
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif

@stop

