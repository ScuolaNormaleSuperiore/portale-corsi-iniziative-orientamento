@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')

        <div class="container">

            {{--            <section class="pb-4">--}}
            {{--                {!! $descrizione->testo_it !!}--}}
            {{--            </section>--}}


            <form method="GET" action="/archivio-video">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="select-wrapper">
                            <label for="video-categoria-select">Categoria</label>
                            <select name="video-categoria" id="video-categoria-select">
                                <option selected="" value="">Scegli un'opzione</option>
                                @foreach ($categorie as $id => $value)
                                    <option value="{{$id}}"
                                            @if ($categoriaSelected == $id)
                                                selected="selected"
                                        @endif
                                    >
                                        {{$value}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">

                        <div class="cmp-input-search">
                            <div class="form-group mb-0">
                                <div class="input-group">
                                    <label for="filter" class="visually-hidden active"></label>
                                    <input type="search" class="form-control"
                                           placeholder="Cerca nel titolo o nella descrizione"
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
                            </div>
                        </div>
                    </div>

                </div>
                <p id="autocomplete-label" class="u-grey-light text-paragraph-card mt-2 mb-30 mt-lg-3 mb-lg-40">
                    {{$items->total()}}
                    video trovati in ordine alfabetico</p>

            </form>


            <div class="row g-4 pt-4">
                <script>
                    const loadYouTubeVideo = function (videoUrl, id) {
                        const videoEl = document.getElementById(id);
                        const video = bootstrap.VideoPlayer.getOrCreateInstance(videoEl);
                        video.setYouTubeVideo(videoUrl);
                    }
                </script>
                @foreach ($items as $item)
                    <div class="col-md-6">
                        @include('single-video',['item' => $item])
                        <hr/>
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

