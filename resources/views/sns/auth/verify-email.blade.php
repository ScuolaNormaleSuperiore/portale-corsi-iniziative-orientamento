@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <section class="pb-5 mb-1  px-2 ps-4" style="">
            <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item active">Verifica e-mail</li>
                </ol>
            </nav>

            <h1 class="h2 py-2">Verifica il tuo indirizzo e-mail</h1>
            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <p>
                Grazie per esserti registrato!<br/>
                Prima di poter effettuare il login ed accedere autti i servizi del portale
                è necessario che verifichi il tuo indirizzo e-mail cliccando sul link che ti
                abbiamo inviato.<br/>
                Non hai ricevuto la nostra e-email? Clicca sul link sottostante per riceverene un'altra.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Ti abbiamo appena inviata una nuova e-mail di verifica
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso">
                        <svg class="icon">
                            <use href="{{Theme::url('svg/sprites.svg')}}#it-close"></use>
                        </svg>
                    </button>
                </div>

            @endif

            <div class="py-3 signup_buttons d-flex justify-content-center gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button class="btn btn-primary" type="submit">Re-invia il link di verifica</button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger" type="submit">Esci</button>
                </form>
            </div>
        </section>


    </div>

@endsection
