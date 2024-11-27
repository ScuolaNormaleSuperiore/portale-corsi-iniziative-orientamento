<div class="steppers-header">
    <ul>
        @foreach ($steps as $nStep => $contenutoStep)
            @php
                $stepClass = $step > $nStep ? 'confirmed' : ($step == $nStep ? 'active' : '')
            @endphp
            <li class="{{$stepClass}}">0{{$nStep}}. {{$contenutoStep['title']}}
                @if ($stepClass == 'confirmed')
                    <svg class="icon steppers-success">
                        <use href="{{Theme::url('svg/sprites.svg')}}#it-check"></use>
                    </svg>
                    <span class="visually-hidden">Confermato</span>
                @endif
            </li>
        @endforeach
    </ul>
    <span class="steppers-index" aria-hidden="true">{{$step}}/{{count($steps)}}</span>
</div>
