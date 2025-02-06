@extends('layouts.app')
@section('content-body')
    <div class="container-fluid">


        <section class="pb-5 mb-1  px-2 ps-4" style="">
            <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item active">Accesso</li>
                </ol>
            </nav>
            <h2 class="h2 py-2">Accedi</h2>

            {!! $descrizione->testo_it !!}

            <hr/>
        </section>

        @if (isset($saml2Error) && $saml2Error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Si è verificato un inconveniente tecnico con il login tramite SPID. Si prega di riprovare.
            </div>
        @endif

        <section class="container px-5 mb-4">

            <div class="row mb-5 pb-5 border-bottom">
                <div class="col-12">

                    <h2 class="h2 pb-4">Candidatura spontanea studenti</h2>
                </div>
                <div class="col-12 col-md-6">
                    <h4 class="h4 pb-3">Studenti in possesso di SPID o CIE</h4>
                    <div class="btn-example">
                        <a href="/saml2/bf441d43-662c-4c96-9451-b7c8a51c21a1/login">
                            <button type="button" class="btn btn-primary">
                                Accedi
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <h4 class="h4 pb-3 mt-4 mt-md-0">Studenti stranieri o non in possesso di SPID o CIE</h4>
                    <div class="btn-example">
                        <a href="/login-classic">
                            <button type="button" class="btn btn-primary">
                                Accedi
                            </button>
                        </a>
                    </div>

                </div>
            </div>
            <div class="row  mb-5 pb-5 border-bottom">
                <div class="col-12 col-md-6">
                    <div class="col-12">

                        <h2 class="h2 pb-1">Per gli istituti scolastici</h2>
                        <p class="pb-3">Modalità di accesso per i referenti scolastici</p>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <div class="btn-example">
                                <a href="/login-scuola">
                                    <button type="button" class="btn btn-primary">
                                        Accedi come referente
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="col-12">

                        <h2 class="h2 pb-1 mt-4 mt-md-0">Per gli operatori SNS</h2>
                        <p class="pb-3">Modalità di accesso per gli operatori SNS</p>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <div class="btn-example">
                                <a href="/saml2/bf441d43-662c-4c96-9451-b7c8a51c21a1/login">
                                    <button type="button" class="btn btn-primary">
                                        Accedi come operatore SNS
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
@stop

