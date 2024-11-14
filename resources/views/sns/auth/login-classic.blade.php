@extends('layouts.app')
@section('content-body')

    <div class="container">

        <div class="row pt-5">
            <div class="col-md-6 mb-4">
                <h2 class="text-center title pb-4">
                    Accesso studenti stranieri
                </h2>
                <form style="max-width: 400px;margin: 0 auto;" class="validate-form" method="post"
                      action="{{ route('login') }}"
                      name="loginform">
                    @csrf

                    <div class="form-group">

                        <input type="text" autofocus="" autocomplete="off" name="email"
                               placeholder="Indirizzo email" class="form-control"
                               data-rule-required="true"
                               value="">
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

{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputPassword3">Scegli password</label>--}}
{{--                        <input type="password" data-bs-input class="form-control input-password" id="exampleInputPassword3" aria-describedby="strengthMeterInfo3 infoPassword3">--}}
{{--                        <button type="button" class="password-icon btn" role="switch" aria-checked="false">--}}
{{--                            <span class="visually-hidden">Mostra/Nascondi Password</span>--}}
{{--                            <svg class="password-icon-visible icon icon-sm" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-password-visible"></use></svg>--}}
{{--                            <svg class="password-icon-invisible icon icon-sm d-none" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-password-invisible"></use></svg>--}}
{{--                        </button>--}}
{{--                        <p id="infoPassword3" class="form-text text-muted d-block small pb-0">Inserisci almeno 8 caratteri, combinando maiuscole, numeri e caratteri speciali.</p>--}}
{{--                        <div class="password-strength-meter">--}}
{{--                            <p id="strengthMeterInfo3" class="strength-meter-info small form-text text-muted pt-0" aria-live="polite"--}}
{{--                               data-bs-short-pass="Password troppo breve."--}}
{{--                               data-bs-bad-pas="Password debole."--}}
{{--                               data-bs-good-pass="Password abbastanza sicura."--}}
{{--                               data-bs-strong-pass="Password sicura."--}}
{{--                            ></p>--}}
{{--                            <div class="password-meter progress rounded-0 position-absolute">--}}
{{--                                <div class="row position-absolute w-100 m-0">--}}
{{--                                    <div class="col-3 border-start border-end border-white"></div>--}}
{{--                                    <div class="col-3 border-start border-end border-white"></div>--}}
{{--                                    <div class="col-3 border-start border-end border-white"></div>--}}
{{--                                    <div class="col-3 border-start border-end border-white"></div>--}}
{{--                                </div>--}}
{{--                                <div class="progress-bar bg-muted" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    {{--                    <div class="form-group form-check"><input id="remember_me" class="form-check-input" type="checkbox"--}}
                    {{--                                                              tabindex="1" name="Cookie"> <label--}}
                    {{--                                class="form-check-label"--}}
                    {{--                                for="remember_me">Ricordami</label>--}}
                    {{--                    </div>--}}
                    <button class="btn btn-lg btn-primary d-block mx-auto" name="LoginButton"> Accedi
                    </button>
                </form>
                <hr>
                <div class="text-center mb-5"><a href="{{ route('password.request') }}">Hai dimenticato la password?</a>
                </div>
                {{--                <script type="text/javascript">--}}
                {{--                    jQuery(document).ready(function () {--}}
                {{--                        jQuery('[name="password"]').password({--}}
                {{--                            strengthMeter: false,--}}
                {{--                            message: "Mostra/nascondi password",--}}
                {{--                        });--}}
                {{--                    });</script>--}}
                {{--            </div>--}}

                <div class="col-md-6 mb-4"><h1 class="text-center title">Sei un'organizzazione?</h1>
                    <p class="text-center mb-5"></p>
                    <p>Registra la tua organizzazione per inserire opportunità ed eventi dedicati ai giovani</p>
                    <p></p>
                    <div class="text-center"><a href="/join/as/private_organization" class="btn btn-lg btn-primary">Registrati </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection