@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')

        <div class="container">


            {{--            <h2 class="title-xxlarge mb-4">Esplora tutte le novità</h2>--}}
            <form method="GET" action="/archivio-video">
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
                            notizie trovate dalla più recente</p>
                    </div>
                </div>
            </form>
            <div class="row g-4 pt-4">
                        <script>
                            const loadYouTubeVideo = function(videoUrl) {
                                const videoEl = document.getElementById("vid1");
                                const video = bootstrap.VideoPlayer.getOrCreateInstance(videoEl);
                                video.setYouTubeVideo(videoUrl);
                            }
                        </script>
                @foreach ($items as $item)
                    <div class="col-md-6">
                        <div class="acceptoverlayable">
                            <div class="acceptoverlay acceptoverlay-primary fade show">
                                <div class="acceptoverlay-inner">
                                    <div class="acceptoverlay-icon">
                                        <svg class="icon icon-xl"><use href="{{Theme::url('svg/sprites.svg')}}#it-video"></use></svg>
                                    </div>
                                    <p>Accetta i cookie di YouTube per vedere il video. Puoi gestire le preferenze nella <a href="#" class="text-white">cookie policy</a>.
                                    </p>
                                    <div class="acceptoverlay-buttons bg-dark">
                                        <button type="button" class="btn btn-primary" data-bs-accept-from="youtube.com"
                                                onclick="loadYouTubeVideo('https://youtu.be/_0j7ZQ67KtY')">Accetta</button>
                                        <div class="form-check">
                                            <input id="chk-remember" type="checkbox" data-bs-accept-remember>
                                            <label for="chk-remember">Ricorda per tutti i video</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <video controls data-bs-video id="vid1"
                                       class="video-js"
                                       width="640" height="264">
                                </video>
                                <div class="vjs-transcription accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header " id="transcription-head9">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#transcription9" aria-expanded="true" aria-controls="transcription">
                                                Trascrizione
                                            </button>
                                        </h2>
                                        <div id="transcription9" class="accordion-collapse collapse" role="region" aria-labelledby="transcription-head9">
                                            <div class="accordion-body">
                                                Vestibulum hendrerit ultrices nibh, sed pharetra lacus ultrices eget. Morbi et ipsum et sapien dapibus facilisis. Integer eget semper nibh. Proin enim nulla, egestas ac rutrum eget, ullamcorper nec turpis.
                                            </div>
                                        </div>
                                    </div>
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

