@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')
        <div class="container">

            <h2 class="visually-hidden">Futuro universitario</h2>

            <section class="pb-4">
                {!! $descrizione->testo_it !!}
            </section>

            @if(!empty($classi))
            <section class="pb-4">
                <div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
                    <!--start card-->
                    @foreach($classi as $classe)
                        @include('components.card-orientamento',['pagina' => $classe, 'baselink' => 'sportello-studenti', 'routefield' => 'id'])
                    @endforeach
                </div>
            </section>
            @endif
        </div>

    </div>
@stop

