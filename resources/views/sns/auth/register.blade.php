@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <section class="pb-5 mb-1  px-2 ps-4" style="">
            <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item active">Registrazione studente</li>
                </ol>
            </nav>

            <h2 class="h2 py-2">Registrazione studente</h2>
            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <h3>Inserisci i tuoi dati</h3>
            <p>Hai già un account? <a href="/login-classic">Accedi</a>.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf


                <div class="form-group">
                    <input type="text" class="form-control" id="id_nome" name="nome">
                    <label for="id_nome" style="width: auto;">Nome</label>


                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="id_cognome" name="cognome">
                    <label for="id_cognome" style="width: auto;">Cognome</label>


                </div>

                <div class="form-group">
                    <input type="email" class="form-control" id="id_email" name="email">
                    <label for="id_email" class="" style="width: auto;">Indirizzo E-mail</label>


                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" data-bs-input class="form-control input-password" id="password"
                           name="password">
                    <button type="button" class="password-icon btn" role="switch" aria-checked="false">
                        <span class="visually-hidden">Mostra/Nascondi Password</span>
                        <svg class="password-icon-visible icon icon-sm" aria-hidden="true">
                            <use href="{{Theme::url('svg/sprites.svg')}}#it-password-visible"></use>
                        </svg>
                        <svg class="password-icon-invisible icon icon-sm d-none" aria-hidden="true">
                            <use href="{{Theme::url('svg/sprites.svg')}}#it-password-invisible"></use>
                        </svg>
                    </button>
                    <p id="infoPassword3" class="form-text text-muted d-block small pb-0">Inserisci almeno 8 caratteri,
                        combinando maiuscole, numeri e caratteri speciali.</p>
                    <div class="password-strength-meter">
                        <p id="strengthMeterInfo3" class="strength-meter-info small form-text text-muted pt-0"
                           aria-live="polite"
                           data-bs-short-pass="Password troppo breve."
                           data-bs-bad-pas="Password debole."
                           data-bs-good-pass="Password abbastanza sicura."
                           data-bs-strong-pass="Password sicura."
                        ></p>
                        <div class="password-meter progress rounded-0 position-absolute">
                            <div class="row position-absolute w-100 m-0">
                                <div class="col-3 border-start border-end border-white"></div>
                                <div class="col-3 border-start border-end border-white"></div>
                                <div class="col-3 border-start border-end border-white"></div>
                                <div class="col-3 border-start border-end border-white"></div>
                            </div>
                            <div class="progress-bar bg-muted" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password (di nuovo)</label>
                    <input type="password" data-bs-input class="form-control input-password" id="password_confirmation"
                           name="password_confirmation">
                    <button type="button" class="password-icon btn" role="switch" aria-checked="false">
                        <span class="visually-hidden">Mostra/Nascondi Password</span>
                        <svg class="password-icon-visible icon icon-sm" aria-hidden="true">
                            <use href="{{Theme::url('svg/sprites.svg')}}#it-password-visible"></use>
                        </svg>
                        <svg class="password-icon-invisible icon icon-sm d-none" aria-hidden="true">
                            <use href="{{Theme::url('svg/sprites.svg')}}#it-password-invisible"></use>
                        </svg>
                    </button>
                </div>


                <div class="py-4 signup_buttons">
                    <button class="btn btn-primary" type="submit">Iscriviti</button>

                </div>

                <p>Registrandoti, accetti la nostra <a href="/pagina/privacy-policy/">privacy policy</a>.</p>
            </form>
        </section>


    </div>

@endsection
