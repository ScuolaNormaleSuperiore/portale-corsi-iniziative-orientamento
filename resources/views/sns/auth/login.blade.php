@extends('layouts.app')
@section('content-body')
    <div class="container-fluid">

        <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                <li class="breadcrumb-item active">Accesso</li>
            </ol>
        </nav>

        <section>
            <h2 class="h2">Accedi</h2>
            <p>Scegli uno dei seguenti metodi di autenticazione per accedere.</p>

            <hr/>
            <div class="row">
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
                <hr/>
            </div>
            <div class="row">
                <div class="col-12">

                    <h2 class="h2 pb-4">Per le scuole</h2>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column w-50">
                        <h4 class="h4 pb-3">Per i possessori di SPID o CIE</h4>
                        <div class="btn-example">
                            <a href="/register-scuola">
                                <button type="button" class="btn btn-primary">
                                    Accedi
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <hr/>
            </div>
        </section>

    </div>
@stop

