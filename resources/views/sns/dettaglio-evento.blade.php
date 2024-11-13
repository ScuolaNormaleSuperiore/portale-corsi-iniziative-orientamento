@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')
        <div class="container">

            <div class="d-flex">

                <div class="w-25">
                    @include('sections.navleft')
                </div>
                <div class="w-75">
                    @if($evento->picture)
                    <div class="img-responsive-wrapper">
                        <div class="img-responsive img-responsive-panoramic">
                            <figure class="img-wrapper">
                                <img src="{{$evento->picture}}">
                            </figure>
                        </div>
                    </div>
                    @endif
                        @foreach ($evento->sezioni as $section)
                            <div class="pt-4" id="sezione_{{$loop->index}}">
                                <h3 class="h3">{{$section->nome_it}}</h3>
                                <p>{!! $section->contenuto_it !!}</p>
                            </div>
                        @endforeach
                </div>

            </div>
        </div>

    </div>
@stop

