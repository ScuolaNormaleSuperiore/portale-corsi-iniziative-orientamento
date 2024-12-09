{{--<h5 class="text-primary">--}}
{{--    {{$item->titolo_it}}--}}
{{--</h5>--}}
<div class="acceptoverlayable">
    <div class="acceptoverlay acceptoverlay-primary fade show">
        <div class="acceptoverlay-inner">
            <div class="acceptoverlay-icon">
                <svg class="icon icon-xl">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-video"></use>
                </svg>
            </div>
            <p>Accetta i cookie di YouTube per vedere il video. Puoi gestire le preferenze nella
                <a href="#" class="text-white">cookie policy</a>.
            </p>
            <div class="acceptoverlay-buttons bg-dark">
                <button type="button" class="btn btn-primary" data-bs-accept-from="youtube.com"
                        onclick="loadYouTubeVideo('https://youtu.be/{{$item->video_id}}','vid{{$loop->index}}')">
                    Accetta
                </button>
                <div class="form-check">
                    <input id="chk-remember" type="checkbox" data-bs-accept-remember>
                    <label for="chk-remember">Ricorda per tutti i video</label>
                </div>
            </div>
        </div>
    </div>
    <div>
        <video controls data-bs-video id="vid{{$loop->index}}"
               class="video-js"
               width="854" height="480">
        </video>
        <div class="vjs-transcription accordion">
            <div class="accordion-item">
                <h2 class="accordion-header " id="transcription-head{{$loop->index}}">
                    <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#transcription{{$loop->index}}" aria-expanded="true"
                            aria-controls="transcription">
                        {{$item->titolo_it}}
                    </button>
                </h2>
                <div id="transcription{{$loop->index}}" class="accordion-collapse collapse"
                     role="region" aria-labelledby="transcription-head{{$loop->index}}">
                    <div class="accordion-body">
                        {!! $item->descrizione_it !!}
                    </div>
                </div>
            </div>
        </div>
        @if($item->materia_id)
            <div class="chip chip-primary chip-lg chip-simple">
                <span class="chip-label">{{$item->categoria->nome_it}}</span>
            </div>
        @endif
    </div>
</div>

