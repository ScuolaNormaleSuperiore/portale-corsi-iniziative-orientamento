@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <section class="pb-5 mb-1  px-2 ps-4" style="">
            <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item active">Registrazione scuola</li>
                </ol>
            </nav>

            <h1 class="h2 py-2">Registrazione scuola</h1>

            {!! $descrizione->testo_it !!}

            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <h2 class="h3">Inserisca i dati di accesso della scuola</h2>
            <p>La scuola ha già un account? <a class="text-decoration-underline" href="/login-scuola">Accedi</a>.</p>

            <form class="needsValidation" method="post" id="registerScuolaForm"
                  method="post"
                  action="{{ route('register-scuola') }}"
            >
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


                <h3 class="pb-2">1. Selezioni la sua scuola</h3>
                <p>
                    Individui e scelga la scuola che vuole registrare (è possibile inserire anche solo alcune lettere del nome della scuola e restringere la ricerca a una provincia).
                </p>

                @include('components.scuole-autocomplete',['province' => $province])

                <p>
                    Se non riesce ad individuare la scuola nel nostro archivio,
                    scriva a <a href="mailto:orientamento@sns.it">orientamento@sns.it</a> o
                    ci contatti ai numeri di telefono indicati nella sezione <a href="/chat">Parla con noi</a>


                </p>
                <hr/>

                <h3 class="pb-2 pt-2">
                    2. Confermi l'indirizzo e-mail istituzionale o imposti un nuovo indirizzo
                </h3>

                <div>
                    <p>
                        Se l'indirizzo e-mail della scuola che vi abbiamo indicato non è corretto
                        o non è presidiato, può indicare un nuovo indirizzo e-mail, che dovrà
                        essere verificato e approvato dagli Uffici della Scuola Normale.
                        Riceverà un  messaggio di conferma all'indirizzo indicato.
                        Si raccomanda di inserire nelle note un riferimento per un eventuale
                        contatto in caso di necessità da parte della Scuola Normale.
                    </p>
                    <div class="form-check">
                        <input id="cambiaEmailButton" name="cambiaEmailButton" type="checkbox" value="1"

                               @if(old('cambiaEmailButton') == 1)
                                   checked="checked"
                            @endif
                        >
                        <label for="cambiaEmailButton">Voglio impostare un altro indirizzo e-mail</label>
                    </div>
                </div>
                {{--                <div class="signup_buttons">--}}
                {{--                    <button class="btn btn-primary btn-sm" type="button" id="cambiaEmailButton">Cambia e-mail</button>--}}

                {{--                </div>--}}


                <div class="d-none pt-4" id="cambiaEmailScuola">
                    <div class="form-group">
                        <input type="text" class="form-control" id="emailScuolaAggiornato"
                               name="emailScuolaAggiornato" value="{{old('emailScuolaAggiornato')}}">
                        <label for="emailScuolaAggiornato" class="" style="width: auto;">Indirizzo E-mail Scuola
                            aggiornato</label>


                    </div>
                    <p>
                        Oltre all'indirizzo email, indica eventuali note o come contattarti nel campo sottostante</p>
                    <div class="form-group pt-2">
                        <label for="noteEmailScuola" class="" style="width: auto;">Note/contatti</label>
                        <textarea class="form-control border" id="noteEmailScuola" rows="3"
                                  name="noteEmailScuola">
                            {{old('noteEmailScuola')}}
                        </textarea>


                    </div>
                </div>

                <h3 class="pb-2 pt-2">
                    3. Imposti la password di accesso per la sua scuola
                </h3>
                <p>
                    Scelga una password per il suo account. Per accedere al sistema dovrà utilizzare l'indirizzo
                    e-mail inserito, al quale arriverà un messaggio per confermare da parte vostra l'account.
                </p>

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
                    <p id="infoPassword3" class="form-text text-muted d-block small pb-0">Inserire almeno 8 caratteri,
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


                <div class="py-4 signup_buttons text-center">
                    <button class="btn btn-primary" type="submit">Registra la scuola</button>

                </div>

                <p>Registrando la scuola, accetta la nostra <a class="text-decoration-underline" href="/pagina/privacy-policy/">privacy policy</a>.</p>


            </form>
        </section>

    </div>

    <script>

        let emailChecked = "{{old('cambiaEmailButton')}}";

        document.addEventListener("DOMContentLoaded", function () {

            function changeEmailScuola(checked) {
                var divEmail = document.getElementById('cambiaEmailScuola');
                if (checked) {
                    divEmail.classList.remove('d-none');
                    validate.addField('#emailScuolaAggiornato', [
                        {
                            rule: 'email',
                            errorMessage: 'Inserisci una e-mail valida'
                        },
                    ]);
                } else {
                    divEmail.classList.add('d-none');
                    validate.removeField('#emailScuolaAggiornato');
                }
            }

            const errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Attenzione</strong> Alcuni campi inseriti sono da controllare.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso">';
            const errorWrapper = document.querySelector('#errorMsgContainer');
            const validate = new bootstrap.FormValidate('#registerScuolaForm', {
                errorFieldCssClass: 'is-invalid',
                errorLabelCssClass: 'form-feedback',
                errorLabelStyle: '',
                focusInvalidField: false,
            })

            var button = document.getElementById('cambiaEmailButton');
            button.addEventListener('change', function (e) {
                changeEmailScuola(e.target.checked);
            });
            if (emailChecked) {
                changeEmailScuola(true);
            }

            validate
                .addField('#scuola_id', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    }
                ])
                .addField('#password', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    },
                    // {
                    //     rule: 'strongPassword',
                    //     errorMessage: 'Inserisci almeno 8 caratteri, con almeno una minuscola, una maiuscola, un numero e un carattere speciale.'
                    // }

                ])
                .addField('#password_confirmation', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    },
                    {
                        validator: (value, fields) => {
                            if (
                                fields[2] &&
                                fields[2].elem
                            ) {
                                const repeatPasswordValue =
                                    fields[2].elem.value;
                                return value === repeatPasswordValue;
                            }

                            return true;
                        },
                        errorMessage: 'Le password non coincidono',
                    }

                ])
                .onSuccess(() => {
                    document.forms['registerScuolaForm'].submit()
                })
                .onFail((fields) => {
                    errorWrapper.innerHTML = '';
                    errorWrapper.innerHTML = errorMessage
                })

        })

    </script>

@endsection
