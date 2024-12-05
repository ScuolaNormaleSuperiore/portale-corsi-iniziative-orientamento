<div class="steppers-header">
    <ul>
        @php
            $info = isset($candidatura) ? $candidatura->info : [];
            $stepsDone = \Illuminate\Support\Arr::get($info,'steps',[]);
        @endphp
        @foreach ($steps as $nStep => $contenutoStep)
            @php
                $hasStepDone = \Illuminate\Support\Arr::get($stepsDone,$nStep,false)
                    || count($stepsDone) >= (count($steps)-1);
                $href = $hasStepDone ? '/candidatura/edit/'.$candidatura->getKey().'/'.$nStep : null;
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
