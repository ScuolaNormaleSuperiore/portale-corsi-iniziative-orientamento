@extends('layouts.app')
@section('content-body')
    <div class="container-fluid">


        <section class="pb-5 mb-1  px-2 ps-4" style="">
            <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item active">Candidature</li>
                </ol>
            </nav>
            <h2 class="h2 py-2">{{$nomeCognome}}</h2>
            <p>DA questa pagina puoi candidarti alle nostre iniziative di orientamento</p>
            <hr/>
        </section>

        <section class="mx-5 px-5 mb-4">

            <div class="row mb-5 pb-5 border-bottom">
                @foreach ($iniziative as $iniziativa)
                    <div class="col-12">
                        <div class="card-wrapper border border-light rounded shadow-sm">
                            <div class="card no-after rounded">
                                <div class="card-body">
                                    <h3 class="card-title h4 text-primary">{{$iniziativa->titolo}}</h3>
                                    @if($iniziativa->descrizione)
                                        <p class="card-text text-secondary">
                                            {!! $iniziativa->descrizione !!}
                                        </p>
                                    @endif

                                    @php
                                        $candidature = $iniziativa->authcandidature;
                                    @endphp
                                    @if ($ruolo == 'Studente')
                                        @php
                                            $candidatura = $candidature->first();
                                        @endphp
                                        <div class="d-flex justify-content-start pb-5">
                                            @if ($candidatura)
                                                <a href="/candidatura/edit/{{$candidatura->getKey()}}">
                                                    <button type="button" class="btn btn-outline-primary">
                                                        Gestisci la candidatura
                                                    </button>
                                                </a>
                                            @else
                                                <a href="/candidatura/{{$iniziativa->getKey()}}/new">
                                                    <button type="button" class="btn btn-outline-primary">
                                                        Inizia la candidatura
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    @elseif ($ruolo == 'Scuola')
                                        <div class="d-flex justify-content-start pb-5 gap-3">
                                            @foreach ($candidature as $candidatura)
                                                <a href="/candidatura/edit/{{$candidatura->getKey()}}">
                                                    <button type="button" class="btn btn-outline-primary">
                                                        {{$candidatura->fename}}
                                                    </button>
                                                </a>
                                            @endforeach
                                            @if ($candidature->count() < $maxCandidatureScuole)
                                                <a href="/candidatura/{{$iniziativa->getKey()}}/new">
                                                    <button type="button" class="btn btn-outline-primary">
                                                        Nuova candidatura
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </section>

    </div>
@stop

