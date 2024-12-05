<div class="steppers-header">
    <ul>
        @foreach ($steps as $nStep => $contenutoStep)
            @php
                $href = $step > $nStep ? '/candidatura/edit/'.$candidatura->getKey().'/'.$nStep : null;
            @endphp
            @if ($href)
                <li class="confirmed">
                    <a href="{{$href}}">
                        0{{$nStep}}. {{$contenutoStep['title']}}
                    </a>
                    <svg class="icon steppers-success">
                        <use href="{{Theme::url('svg/sprites.svg')}}#it-check"></use>
                    </svg>
                    <span class="visually-hidden">Confermato</span>
                </li>
            @else
                <li class="">
                    0{{$nStep}}. {{$contenutoStep['title']}}
                </li>
            @endif
        @endforeach
    </ul>
    <span class="steppers-index" aria-hidden="true">{{$step}}/{{count($steps)}}</span>
</div>
