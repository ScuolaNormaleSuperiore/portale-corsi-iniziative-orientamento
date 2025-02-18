@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <section class="pb-5 mb-1  px-2 ps-4" style="">
            <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                    <li class="breadcrumb-item active">Accesso per studentesse e studenti stranieri o senza SPID o CIE</li>
                </ol>
            </nav>

            <h1 class="h2 py-2">Accesso per studentesse e studenti stranieri o senza SPID o CIE</h1>
            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <h2 class="h3 pb-5">I tuoi dati di accesso</h2>
            <form class="needsValidation" method="post" id="loginForm"
                  action="{{ route('login') }}"
            >
                @csrf


                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$error}}
                    </div>
                    @endforeach
                @endif
                @if (session()->has('status'))
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session()->get('status')}}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Indirizzo e-mail</label>
                    <input type="text" autofocus="" autocomplete="off" id="email" name="email"
                           {{--                           placeholder="Indirizzo email" --}}
                           class="form-control"
                           data-rule-required="true"
                    >

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

                </div>


                <div class="py-4 login_buttons">
                    <button class="btn btn-primary" type="submit">Log in</button>


                    <p></p>
                </div>
                <p>Se non hai ancora creato un account, <a class="text-decoration-underline" href="{{ route('register') }}">registrati</a> adesso.</p>
                <p>Se invece hai dimenticato la password, puoi <a class="text-decoration-underline"
                            href="{{ route('password.request') }}">reimpostarla</a>.</p>
            </form>
            <div class="row mt-4">
                <div class="col-12">
                    <div aria-live="polite" id="errorMsgContainer">

                    </div>
                </div>
            </div>
        </section>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Attenzione</strong> Alcuni campi inseriti sono da controllare.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso">';
            const errorWrapper = document.querySelector('#errorMsgContainer');
            const validate = new bootstrap.FormValidate('#loginForm', {
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
                ])
                .addField('#password', [
                    {
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    }
                ])
                .onSuccess(() => {
                    document.forms['loginForm'].submit()
                })
                .onFail((fields) => {
                    errorWrapper.innerHTML = '';
                    errorWrapper.innerHTML = errorMessage
                })
        })
    </script>
@endsection
