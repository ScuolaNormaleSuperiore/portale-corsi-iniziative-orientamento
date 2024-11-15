@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')
        <div class="container">

            <div class="row">

                <div class="col-12 col-lg-4">
                    @include('sections.navleft')
                </div>
                <div class="col-12 col-lg-8">
                    @if($pagina->picture)
                    <div class="img-responsive-wrapper">
                        <div class="img-responsive img-responsive-panoramic">
                            <figure class="img-wrapper">
                                <img src="{{$pagina->picture}}">
                            </figure>
                        </div>
                    </div>
                    @endif
                        @foreach ($pagina->sezioni as $section)
                            <div class="pt-4">
                                <h3 class="h3">{{$section->nome_it}}</h3>
                                <p>{!! $section->contenuto_it !!}</p>
                            </div>
                        @endforeach
                </div>

            </div>
        </div>

    </div>
@stop

