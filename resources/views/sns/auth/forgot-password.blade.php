@extends('layouts.app')
@section('content-body')

    <div class="container-fluid">

        <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                <li class="breadcrumb-item"><a href="/login">Accesso</a><span class="separator">/</span></li>
                <li class="breadcrumb-item active">Password dimenticata</li>
            </ol>
        </nav>

        <section>
            <h1 class="h2 pb-5">Password dimenticata</h1>
            <hr/>

        </section>

        <section class="container pt-4 pb-4">
            <h2 class="h3 mb-4">RE-imposta la Password</h2>

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
            <p>
                Hai dimenticato la tua password? Inserisci qui sotto l'indirizzo e-mail con cui ti sei registrato, ti invieremo una mail con un link per re-impostarla.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf


                <div class="form-group">
                    <input type="email" class="form-control" id="id_email" name="email" value="{{old('email')}}">
                    <label for="id_email" class="" style="width: auto;">Indirizzo E-mail</label>



                </div>



                <div class="py-4 signup_buttons">
                    <button class="btn btn-primary" type="submit">Invia</button>

                </div>

            </form>
        </section>


    </div>

@endsection
