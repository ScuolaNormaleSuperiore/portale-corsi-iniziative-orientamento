@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                <li class="breadcrumb-item active">Registrazione scuola</li>
            </ol>
        </nav>

        <section>
            <h1 class="h2 pb-5">La tua richiesta è stata presa in carico</h1>
            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <p>
                Grazie per esserti registrato!<br/>
                Prima di poter effettuare il login ed accedere autti i servizi del portale
                dovrai attendere che il nostro staff approvi la richiesta di cambio di indirizzo e-mail.<br/>
                Ci metteremo il minor tempo possibile!
            </p>
        </section>
    </div>
@stop

