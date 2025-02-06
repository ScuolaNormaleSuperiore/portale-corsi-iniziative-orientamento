@extends('layouts.app')
@section('content-body')
    <div class="container-fluid">


        @if (isset($errors) && count($errors) > 0)
            <div class="row mt-4">
                <div class="col-12">
                    @foreach ($errors as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! $error !!}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if (isset($success) && $success)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! $success !!}
                    </div>
                </div>
            </div>
        @endif

        <section class="pb-5 mb-1  px-2 ps-4" style="">
            <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item active">Candidature</li>
                </ol>
            </nav>
            <h2 class="h2 py-2">{{$nomeCognome}}</h2>
            <p>Da questa pagina puoi candidarti alle nostre iniziative di orientamento</p>
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
                                            <div class="position-relative">
                                                @if ($candidatura)

                                                    @if ($candidatura->status == \App\Enums\CandidatoStatuses::BOZZA->value)
                                                        @if($candidatura->user_id == \Illuminate\Support\Facades\Auth::id())
                                                            <a href="/candidatura/edit/{{$candidatura->getKey()}}">
                                                                <button type="button" class="btn btn-outline-primary"

                                                                >
                                                                    <div
                                                                        style="position:absolute;left:-10px;top:-10px;">
                                                                        <small><span
                                                                                class="badge rounded-pill bg-primary"
                                                                                style="">Bozza</span></small></div>
                                                                    Gestisci la candidatura
                                                                </button>
                                                            </a>
                                                            <button type="button"
                                                                    class="btn btn-outline-danger btn-xs btn-icon btn-me delete-candidatura"
                                                                    data-candidatura="{{$candidatura->getKey()}}"
                                                            >
                                                                <svg class="icon icon-danger"
                                                                     data-candidatura="{{$candidatura->getKey()}}">
                                                                    <use
                                                                        href="{{Theme::url('svg/sprites.svg')}}#it-delete"></use>
                                                                </svg>
                                                            </button>
                                                        @else
                                                            <p>
                                                                <strong>Il referente della tua scuola sta gestendo la
                                                                    tua candidatura: la potrai visualizzare una volta
                                                                    inviata.</strong>
                                                            </p>
                                                        @endif
                                                    @else
                                                        <a href="/candidatura/view/{{$candidatura->getKey()}}">
                                                            <button type="button" class="btn btn-outline-primary">
                                                                <div style="position:absolute;left:-10px;top:-10px;">

                                                                    <small><span class="badge rounded-pill
                                                                        {{$candidatura->status == 'inviata' ? 'bg-primary' : ($candidatura->status == 'approvata' ? 'bg-success' : 'bg-danger')}}
                                                                    "
                                                                                 style="">{{\App\Enums\CandidatoStatuses::optionLabel($candidatura->status)}}</span></small>
                                                                </div>

                                                                Vedi la candidatura
                                                            </button>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="/candidatura/{{$iniziativa->getKey()}}/new">
                                                        <button type="button" class="btn btn-outline-primary">
                                                            Inizia la candidatura
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @elseif ($ruolo == 'Scuola')
                                        <div class="d-flex flex-wrap justify-content-start pb-5 gap-5">
                                            @foreach ($candidature as $candidatura)
                                                <div class="position-relative">
                                                    @if ($candidatura->status == \App\Enums\CandidatoStatuses::BOZZA->value)
                                                        <a href="/candidatura/edit/{{$candidatura->getKey()}}">
                                                            <button type="button" class="btn btn-outline-primary">
                                                                <div style="position:absolute;left:-10px;top:-10px;">
                                                                    <small><span class="badge rounded-pill bg-primary"
                                                                                 style="">Bozza</span></small></div>
                                                                {{$candidatura->fename}}
                                                            </button>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-outline-danger btn-xs btn-icon btn-me delete-candidatura"
                                                                data-candidatura="{{$candidatura->getKey()}}"
                                                        >
                                                            <svg class="icon icon-danger"
                                                                 data-candidatura="{{$candidatura->getKey()}}">
                                                                <use
                                                                    href="{{Theme::url('svg/sprites.svg')}}#it-delete"></use>
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <a href="/candidatura/view/{{$candidatura->getKey()}}">
                                                            <button type="button" class="btn btn-outline-primary">
                                                                <div style="position:absolute;left:-10px;top:-10px;">

                                                                    <small><span class="badge rounded-pill
                                                                        {{$candidatura->status == 'inviata' ? 'bg-primary' : ($candidatura->status == 'approvata' ? 'bg-success' : 'bg-danger')}}
                                                                    "
                                                                                 style="">{{\App\Enums\CandidatoStatuses::optionLabel($candidatura->status)}}</span></small>
                                                                </div>
                                                                {{$candidatura->fename}}
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                            @if (is_null($iniziativa->max_candidature_scuola) || $candidature->count() < $iniziativa->max_candidature_scuola)
                                                <div class="position-relative">

                                                    <a href="/candidatura/{{$iniziativa->getKey()}}/new">
                                                        <button type="button" class="btn btn-outline-primary">
                                                            Nuova candidatura
                                                        </button>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            Candidature effettuate dalla scuola:
                                            <strong>{{$candidature->count()}}</strong><br/>
                                            Candidature ancora disponibili per la scuola:
                                            <strong>{{is_null($iniziativa->max_candidature_scuola)?"Illimitate":(max(0,($iniziativa->max_candidature_scuola - $candidature->count())))}}</strong>
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

    <div class="it-example-modal">
        <div class="container">
            <div class="modal" tabindex="-1" role="dialog" id="modal-delete-candidatura"
                 aria-labelledby="modal7Title">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal7Title">Cancellazione candidatura</h5>
                        </div>
                        <div class="modal-body">
                            <p>Confermi la cancellazione della candidatura?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-sm" id="delete-candidatura-button-modal" type="button">
                                Conferma cancellazione
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-dismiss="modal">Torna
                                indietro
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let deleteModal = new bootstrap.Modal(document.getElementById('modal-delete-candidatura'), {});

            let buttons = document.getElementsByClassName('delete-candidatura');

            for (var i = 0, len = buttons.length; i < len; i++) {
                buttons[i].addEventListener('click', function (ev) {
                    var el = ev.target;
                    var candidaturaId = el.getAttribute('data-candidatura');
                    console.log("CAND", candidaturaId, el)
                    deleteModal.show();
                    var deleteButton = document.getElementById('delete-candidatura-button-modal');
                    // deleteButton.removeEventListener('click');
                    deleteButton.addEventListener('click', function () {
                        window.location.href = "/candidature?delete=" + candidaturaId;
                    });
                }, false);
            }

        })

    </script>
@stop

