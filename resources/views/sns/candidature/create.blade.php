@extends('layouts.app')
@section('content-body')
    <div class="container-fluid">


        @include('candidature.includes.breadcrumbs')

        <section class="mx-5 px-5 mb-4">

            <div class="steppers">
                @include('candidature.includes.steps')

                <form method="POST" action="{{route('candidatura.store',['iniziativa' => $iniziativa->getKey()])}}">
                    @csrf
                    <input type="hidden" name="step" value="{{$step}}"/>

                    <div class="steppers-content" aria-live="polite">
                        <!-- Esempio START -->
                        <p>Contenuto di esempio dello step corrente</p>
                        <!-- Esempio END -->
                    </div>
                    <nav class="steppers-nav">
                        <button type="button" class="btn btn-outline-primary btn-sm steppers-btn-prev">
                            <svg class="icon icon-primary">
                                <use href="{{Theme::url('svg/sprites.svg')}}#it-chevron-left"></use>
                            </svg>
                            Indietro
                        </button>
                        <button type="submit" class="btn btn-outline-primary btn-sm steppers-btn-next">Avanti
                            <svg class="icon icon-primary">
                                <use href="{{Theme::url('svg/sprites.svg')}}#it-chevron-right"></use>
                            </svg>
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm steppers-btn-confirm d-none d-lg-block">
                            Conferma
                        </button>
                    </nav>
                </form>
            </div>

        </section>

    </div>
@stop

