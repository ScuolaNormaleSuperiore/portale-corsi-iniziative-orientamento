@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                <li class="breadcrumb-item active">Reset password</li>
            </ol>
        </nav>

        <section>
            <h1 class="h2 pb-5">Reset password</h1>
            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <h2 class="h3 mb-4">Re-imposta la tua Password</h2>

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

            @if (session()->has('status'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session()->get('status')}}
                        </div>
                    </div>
                </div>
            @endif

            {{--            <p>Hai già un account? <a href="/login">Accedi</a>.</p>--}}

            <form method="POST" action="{{ route('password.update') }}">
                @csrf


                <div class="form-group">
                    <input type="email" class="form-control" id="id_email" name="email" value="{{$request->get('email') ?: old('email')}}">
                    <input type="hidden" name="token" value="{{$token}}">
                    <label for="id_email" class="" style="width: auto;">Indirizzo E-mail</label>



                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" data-bs-input class="form-control input-password" id="password" name="password">
                    <button type="button" class="password-icon btn" role="switch" aria-checked="false">
                        <span class="visually-hidden">Mostra/Nascondi Password</span>
                        <svg class="password-icon-visible icon icon-sm" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-password-visible"></use></svg>
                        <svg class="password-icon-invisible icon icon-sm d-none" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-password-invisible"></use></svg>
                    </button>
                    <p id="infoPassword3" class="form-text text-muted d-block small pb-0">Inserisci almeno 8 caratteri, combinando maiuscole, numeri e caratteri speciali.</p>
                    <div class="password-strength-meter">
                        <p id="strengthMeterInfo3" class="strength-meter-info small form-text text-muted pt-0" aria-live="polite"
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
                            <div class="progress-bar bg-muted" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password (di nuovo)</label>
                    <input type="password" data-bs-input class="form-control input-password" id="password_confirmation" name="password_confirmation">
                    <button type="button" class="password-icon btn" role="switch" aria-checked="false">
                        <span class="visually-hidden">Mostra/Nascondi Password</span>
                        <svg class="password-icon-visible icon icon-sm" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-password-visible"></use></svg>
                        <svg class="password-icon-invisible icon icon-sm d-none" aria-hidden="true"><use href="{{Theme::url('svg/sprites.svg')}}#it-password-invisible"></use></svg>
                    </button>
                </div>


                <div class="py-4 signup_buttons">
                    <button class="btn btn-primary" type="submit">Re-imposta password</button>

                </div>

            </form>
        </section>


    </div>

@endsection
