@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')
        <div class="container">

            <section class="pb-4">
                {!! $descrizione->testo_it !!}
            </section>

            <section class="pb-4">
                <div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
                    <!--start card-->
                    @foreach($classi as $classe)
                        @include('components.card-orientamento',['pagina' => $classe, 'baselink' => 'sportello-studenti', 'routefield' => 'id'])
                    @endforeach
                </div>
            </section>
        </div>

    </div>
@stop

