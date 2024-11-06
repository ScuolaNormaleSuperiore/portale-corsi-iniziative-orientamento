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
                                    <h3 class="card-title h5 text-primary">Sportello d astudente a studente</h3>
                                    <p class="card-text font-serif">incontra online i nostri studenti tutor</p>
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

        <section style="background-color:#F4FAFB" class="pt-5">

            <div class="container">
                <h2>Partecipa alle nostre attività di orientamento</h2>
                <p class="" style="color:#2F475E;">Scopri le opportunità offerte per partecipare ad eventi di orientamento, visitare i luoghi della Normale e vivere esperienze educative uniche.</p>
                <div class="row">
                    <div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
                        <!--start card-->
                        @foreach($pagine as $pagina)
                        <div class="card card-teaser" style="border-radius: 4px;border-top: 3px solid #005A74;">
                            <div class="card-body" >
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
            </div>
        </section>

    </div>
@stop

