@extends('layouts.app')
@section('content-body')

    <div class="container-fluid px-0">

        @include('sections.breadcrumbs-standard')

        <div class="container">

            <section class="pb-4">
                {!! $descrizione->testo_it !!}
            </section>


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


                {{--                @include('sections.pagination')--}}

            </div>


        </div>

    </div>
@stop

