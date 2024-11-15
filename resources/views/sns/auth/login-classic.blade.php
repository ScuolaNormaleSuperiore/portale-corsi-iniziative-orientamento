@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                <li class="breadcrumb-item active">Accesso per studenti stranieri</li>
            </ol>
        </nav>

        <section>
            <h2 class="pb-5">Accesso per studenti stranieri</h2>
            <hr/>

        </section>
        <section class="container pt-4 pb-4">
                    <h3 class="pb-5">I tuoi dati di accesso</h3>
            <form  class="validate-form" method="post"
                  action="{{ route('login') }}"
                  >
                @csrf


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
                    <input type="password" data-bs-input class="form-control input-password" id="password" name="password">
                    <button type="button" class="password-icon btn" role="switch" aria-checked="false">
                        <span class="visually-hidden">Mostra/Nascondi Password</span>
                        <svg class="password-icon-visible icon icon-sm" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-password-visible"></use></svg>
                        <svg class="password-icon-invisible icon icon-sm d-none" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-password-invisible"></use></svg>
                    </button>

                </div>




{{--                <div class="form-check">--}}
{{--                    <input id="id_remember" name="remember" type="checkbox">--}}
{{--                    <label for="id_remember">Ricordami</label>--}}
{{--                </div>--}}




                <div class="py-4 login_buttons">
                    <button class="btn btn-primary" type="submit">Log in</button>
{{--                    <span class="px-3 my-3 my-md-0">oppure</span>--}}








{{--                    <a class="btn btn-icon btn-outline-primary github" href="/accounts/github/login/?process=login" title="GitHub">--}}
{{--                        <svg class="icon icon-sm icon-primary">--}}
{{--                            <use xlink:href="https://docs.italia.it/media/static/vendor/bootstrap-italia/svg/sprite.svg#it-github"></use>--}}
{{--                        </svg>--}}
{{--                        <span>--}}
{{--        Autenticati con GitHub--}}
{{--      </span>--}}
{{--                    </a>--}}










                    <p></p>
                </div>
                <p>Se non hai ancora creato un account, <a href="{{ route('register') }}">registrati</a> adesso.</p>
                <p>Se invece hai dimenticato la password, puoi <a href="{{ route('password.request') }}">reimpostarla</a>.</p>
            </form>
        </section>

    </div>

@endsection