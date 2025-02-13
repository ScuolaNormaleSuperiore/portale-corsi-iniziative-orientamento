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

            <h1 class="h2 py-2">Registrazione studente</h1>
            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <h2 class="h3">Inserisci i tuoi dati</h2>
            <p>Hai già un account? <a class="text-decoration-underline" href="/login-classic">Accedi</a>.</p>

            <form class="needsValidation" method="post" id="registerForm"
                  action="{{ route('register') }}">
                @csrf

                @if ($errors->any())
                    <div class="row mb-4">
                        <div class="col-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! $error !!}
                        </div>
                    @endforeach
                        </div>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-12">
                        <div aria-live="polite" id="errorMsgContainer">

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}">
                    <label for="nome" style="width: auto;">Nome</label>


                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="cognome" name="cognome" value="{{old('cognome')}}">
                    <label for="cognome" style="width: auto;">Cognome</label>


                </div>

                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    <label for="email" class="" style="width: auto;">Indirizzo E-mail</label>


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

                <p>Registrandoti, accetti la nostra <a class="text-decoration-underline" href="/pagina/privacy-policy/">privacy policy</a>.</p>
            </form>
        </section>


    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Attenzione</strong> Alcuni campi inseriti sono da controllare.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso">';
            const errorWrapper = document.querySelector('#errorMsgContainer');
            const validate = new bootstrap.FormValidate('#registerForm', {
                errorFieldCssClass: 'is-invalid',
                errorLabelCssClass: 'form-feedback',
                errorLabelStyle: '',
                focusInvalidField: false,
            })
            validate
                .addField('#nome', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    }
                ])
                .addField('#cognome', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    }
                ])
                .addField('#email', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    },
                    {
                        rule: 'email',
                        errorMessage: 'Inserisci un e-mail valida'
                    },
                ])
                .addField('#password', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    },
                    // {
                    //     rule: 'strongPassword',
                    //     errorMessage: 'Inserisci almeno 8 caratteri, con almeno una minuscola, una maiuscola, un numero e un carattere speciale.'
                    // },

                ])
                .addField('#password_confirmation', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    },
                    {
                        validator: (value, fields) => {
                            if (
                                fields[4] &&
                                fields[4].elem
                            ) {
                                console.log("RP:::",value,fields[4].elem.value);
                                const repeatPasswordValue =
                                    fields[4].elem.value;
                                return value === repeatPasswordValue;
                            }

                            return true;
                        },
                        errorMessage: 'Le password non coincidono',
                    }

                ])
                .onSuccess(() => {
                    document.forms['registerForm'].submit()
                })
                .onFail((fields) => {
                    errorWrapper.innerHTML = '';
                    errorWrapper.innerHTML = errorMessage
                })
        })
    </script>

@endsection
