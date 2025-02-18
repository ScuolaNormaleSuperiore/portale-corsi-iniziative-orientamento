@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <section class="pb-5 mb-1  px-2 ps-4" style="">
            <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item active">Registrazione studente da SPID/CIE</li>
                </ol>
            </nav>

            <h1 class="h2 py-2">Registrazione studente da SPID/CIE</h1>
            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <h2 class="h3">Completa i tuoi dati</h2>
            <h3 class="h6">Per utilizzare le funzionalità del portale è necessario indicare un indirizzo e-mail.</h3>
            <p>Hai già un account? <a class="text-decoration-underline" href="/login-classic">Accedi</a>.</p>

            <form class="needsValidation" method="post" id="registerForm"
                  action="{{ route('register-cie') }}">
                @csrf

                <input type="hidden" name="codice_fiscale" value="{{ old('codice_fiscale', session()->get('codice_fiscale') ?? '') }}">
                <input type="hidden" name="samlAttributes" value="{{ old('samlAttributes', session()->get('samlAttributes') ?? '') }}">

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
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', session()->get('nome') ?? '') }}" readonly>



                    <label for="nome" style="width: auto;">Nome</label>


                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="cognome" name="cognome" value="{{ old('cognome', session()->get('cognome') ?? '') }}" readonly>






                    <label for="cognome" style="width: auto;">Cognome</label>


                </div>

                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    <label for="email" class="" style="width: auto;">Indirizzo E-mail</label>
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
                .addField('#email', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    },
                    {
                        rule: 'email',
                        errorMessage: 'Inserisci un e-mail valida'
                    },
                ]);
                validate.onSuccess(() => {
                    document.forms['registerForm'].submit()
                })
                .onFail((fields) => {
                    errorWrapper.innerHTML = '';
                    errorWrapper.innerHTML = errorMessage
                })
        })
    </script>

@endsection
