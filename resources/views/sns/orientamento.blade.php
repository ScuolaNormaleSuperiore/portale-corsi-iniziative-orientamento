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
                    @foreach($pagine as $pagina)
                        @include('components.card-orientamento',['pagina' => $pagina])
                    @endforeach

                </div>
            </section>
        </div>

    </div>
@stop

