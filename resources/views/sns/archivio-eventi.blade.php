@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')

        <div class="container">


            {{--            <h2 class="title-xxlarge mb-4">Esplora tutte le novità</h2>--}}
            <form method="GET" action="/archivio-eventi">
                <div class="cmp-input-search">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <label for="filter" class="visually-hidden active"></label>
                            <input type="search" class="form-control" placeholder="Cerca nel titolo o sottotitolo"
                                   id="filter" name="filter" value="{{$filter ?: ''}}">
                            {{--                        <ul class="autocomplete-list"></ul>--}}

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="submit-search">Cerca</button>
                            </div>

                            <span class="autocomplete-icon" aria-hidden="true">
                  <svg class="icon icon-sm icon-primary">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-search"></use>
                  </svg>
                </span>
                        </div>
                        <p id="autocomplete-label" class="u-grey-light text-paragraph-card mt-2 mb-30 mt-lg-3 mb-lg-40">
                            {{$items->total()}}
                            eventi trovati dal più recente</p>
                    </div>
                </div>
            </form>

            <h2 class="visually-hidden">Risultati della ricerca</h2>

            <div class="row g-4 pt-4">
                @foreach ($items as $item)
                    <div class="col-md-6 col-xl-4">
                        <div class="card-wrapper border border-light rounded shadow-sm">
                            <div class="card no-after rounded">
                                {{-- IMMAGINE --}}
                                @if($item->picture)
                                    <div class="img-responsive-wrapper">
                                        <div class="img-responsive img-responsive-panoramic">
                                            <figure class="img-wrapper">
                                                <img src="{{$item->picture}}"
                                                     title="{{$item->picture_alt}}"
                                                     alt="{{$item->picture_alt}}">
                                            </figure>
                                            @if ($item->data)
                                                @php
                                                    $date = \Carbon\Carbon::createFromFormat("Y-m-d",$item->data)->locale('it_IT');
                                                @endphp
                                                <div class="card-calendar d-flex flex-column justify-content-center">
                                                    <span class="card-date">{{$date->day}}</span>
                                                    <span class="card-day">{{$date->monthName}}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                {{-- FINE IMMAGINE --}}
                                <div class="card-body">
                                    <div class="category-top">
                                        <a class="category text-decoration-none" href="#">EVENTI</a>
                                        @if ($item->data)
                                            @php
                                                $date = \Carbon\Carbon::createFromFormat("Y-m-d",$item->data)->locale('it_IT');
                                            @endphp
                                            @if (!$item->data_fine)
                                                <span class="data">{{$date->day}} {{$date->monthName}}</span>
                                            @else
                                                @php
                                                    $dateEnd = \Carbon\Carbon::createFromFormat("Y-m-d",$item->data_fine)->locale('it_IT');
                                                @endphp
                                                <span class="data">Dal {{$date->day}} {{$date->monthName}} al {{$dateEnd->day}} {{$dateEnd->monthName}}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <a href="/dettaglio-evento/{{$item->id}}" class="text-decoration-none"
                                       data-element="evento-category-link">
                                        <h3 class="card-title">{{$item->titolo_it}}</h3>
                                    </a>
                                    @if($item->sottotitolo_it)
                                        <p class="card-text text-secondary">
                                            {{$item->sottotitolo_it}}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!--end card-->

            </div>
            <div class="row my-4">


                @include('sections.pagination')

            </div>


        </div>

    </div>
@stop

