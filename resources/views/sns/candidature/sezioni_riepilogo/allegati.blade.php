<ul class="upload-file-list">

    @foreach($candidatura->attachments as $attachment)
        <li class="upload-file success">
            <a href="/downloadmediable/attachment/{{$attachment->getKey()}}">
                <svg class="icon icon-sm" aria-hidden="true">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-file"></use>
                </svg>
                <p class="d-inline">
                    <span class="visually-hidden">File caricato:</span>
                    {{$attachment->nome}} <span class="upload-file-weight">{{$attachment->dim}}</span>
                </p>
            </a>
        </li>
    @endforeach
</ul>

<script>

</script>
