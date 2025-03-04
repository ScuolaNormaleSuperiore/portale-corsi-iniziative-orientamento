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
            <h1 class="h2 py-2">{{$nomeCognome}}</h1>

            @if ($ruolo == 'Scuola')
                <p>Da questa pagina puoi candidare gli studenti della tua scuola alle nostre iniziative di
                    orientamento</p>
            @else
                <p>Da questa pagina puoi candidarti alle nostre iniziative di orientamento</p>
            @endif
            <hr/>
        </section>

        <section class="container px-5 mb-4">

            <div class="row mb-5 pb-5 border-bottom">
                @if ($ruolo == 'Scuola' && !$user->scuola)
                    <h6>
                        Al momento risultano dei problemi con il tuo account come referente che non sembra essere
                        associato ad una scuola.
                        <br/>Si prega di contattare gli amministratore del sistema in caso di errore.
                    </h6>
                @else
                    @forelse ($iniziative as $iniziativa)

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
                                                                    <button type="button"
                                                                            class="btn btn-outline-primary"

                                                                    >
                                                                        <div
                                                                            style="position:absolute;left:-10px;top:-10px;">
                                                                            <small><span
                                                                                    class="badge rounded-pill bg-primary"
                                                                                    style="">Bozza</span></small></div>
                                                                        Gestisci la candidatura
                                                                    </button>
                                                                </a>
                                                                <form class="cancella-candidatura-form d-inline"
                                                                      id="form-cancella-{{$candidatura->getKey()}}"
                                                                      method="POST">

                                                                    @csrf

                                                                    <input type="hidden" name="candidatura-delete"
                                                                           value="{{$candidatura->getKey()}}"/>

                                                                    <button type="button"
                                                                            class="btn btn-outline-danger btn-xs btn-icon btn-me delete-candidatura mt-2 mt-sm-0 d-block d-sm-inline"
                                                                            data-candidatura="{{$candidatura->getKey()}}"
                                                                    >
                                                                        Rimuovi
                                                                        <svg class="icon icon-danger"
                                                                             data-candidatura="{{$candidatura->getKey()}}">
                                                                            <use
                                                                                href="{{Theme::url('svg/sprites.svg')}}#it-delete"></use>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <p>
                                                                    <strong>Il referente della tua scuola sta gestendo
                                                                        la
                                                                        tua candidatura: la potrai visualizzare una
                                                                        volta
                                                                        inviata.</strong>
                                                                </p>
                                                            @endif
                                                        @else
                                                            <a href="/candidatura/view/{{$candidatura->getKey()}}">
                                                                <button type="button" class="btn btn-outline-primary">
                                                                    <div
                                                                        style="position:absolute;left:-10px;top:-10px;">

                                                                        <small><span class="badge rounded-pill
                                                                            {{\App\Enums\CandidatoStatuses::getColor($candidatura->status) ?: ''}}
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
                                                                    <div
                                                                        style="position:absolute;left:-10px;top:-10px;">
                                                                        <small><span
                                                                                class="badge rounded-pill bg-primary"
                                                                                style="">Bozza</span></small></div>
                                                                    {{$candidatura->fename}}
                                                                </button>
                                                            </a>
                                                            <form class="cancella-candidatura-form d-inline"
                                                                  id="form-cancella-{{$candidatura->getKey()}}"
                                                                  method="POST">

                                                                @csrf
                                                                <input type="hidden" name="candidatura-delete"
                                                                       value="{{$candidatura->getKey()}}"/>
                                                                <button type="button"
                                                                        class="btn btn-outline-danger btn-xs btn-icon btn-me delete-candidatura mt-2 mt-sm-0 d-block d-sm-inline"
                                                                        data-candidatura="{{$candidatura->getKey()}}"
                                                                >
                                                                    Rimuovi
                                                                    <svg class="icon icon-danger"
                                                                         data-candidatura="{{$candidatura->getKey()}}">
                                                                        <use
                                                                            href="{{Theme::url('svg/sprites.svg')}}#it-delete"></use>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <a href="/candidatura/view/{{$candidatura->getKey()}}">
                                                                <button type="button" class="btn btn-outline-primary">
                                                                    <div
                                                                        style="position:absolute;left:-10px;top:-10px;">

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
                    @empty
                        <h6>
                            Al momento non risultano iniziative attive.<br/>La invitiamo a consultare nuovamente questa
                            sezione in futuro o a contattare gli uffici competenti per eventuali ulteriori informazioni.
                        </h6>
                    @endforelse
                @endif

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
                        <div class="modal-footer" id="modal-delete-candidatura-footer">
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

            let modalFooter = document.getElementById('modal-delete-candidatura-footer');
            let buttons = document.getElementsByClassName('delete-candidatura');

            for (var i = 0, len = buttons.length; i < len; i++) {
                buttons[i].addEventListener('click', function (ev) {
                    var el = ev.target;
                    var form = el.closest('form');
                    var candidaturaId = el.getAttribute('data-candidatura');

                    document.getElementById('delete-candidatura-button-modal').remove();
                    var deleteButton = document.createElement('button');
                    deleteButton.classList.add("btn", "btn-primary", "btn-sm");
                    deleteButton.setAttribute('type', 'button');
                    deleteButton.setAttribute('id', 'delete-candidatura-button-modal');
                    deleteButton.innerText = 'Conferma cancellazione';

                    modalFooter.prepend(deleteButton)
                    deleteButton.addEventListener('click', function () {
                        form.submit();
                    });

                    console.log("CAND", candidaturaId, el)
                    deleteModal.show();

                    // deleteButton.removeEventListener('click');
                }, false);
            }

        })

    </script>
@stop

