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
            <p>Scegli uno dei seguenti metodi di autenticazione per accedere.</p>
            <hr/>
        </section>

        <section class="mx-5 px-5 mb-4">

            <div class="row mb-5 pb-5 border-bottom">
                <div class="col-12">

                    <h2 class="h2 pb-4">Per gli studenti</h2>
                </div>
                <div class="col-6">
                    <h4 class="h4 pb-3">Per i possessori di SPID o CIE</h4>
                    <div class="btn-example">
                        <a href="/login-studenti">
                            <button type="button" class="btn btn-primary">
                                Accedi
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <h4 class="h4 pb-3">Per gli studenti stranieri</h4>
                    <div class="btn-example">
                        <a href="/login-classic">
                            <button type="button" class="btn btn-primary">
                                Accedi
                            </button>
                        </a>
                    </div>

                </div>
            </div>
            <div class="row  pb-5">
                <div class="col-12">

                    <h2 class="h2 pb-1">Per gli istituti scolastici</h2>
                        <p class="pb-3">Modalità di accesso per i referenti scolastici</p>
                </div>
                <div class="col-6">
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
        </section>

    </div>
@stop

