<nav class="steppers-nav">
    <div>
        @if($step > 1)
            <a href="{{route('candidatura.edit',['candidatura' => $candidatura->getKey(),'step' => ($step - 1)])}}">
                <button type="button" class="btn btn-outline-primary btn-sm steppers-btn-prev">
                    <svg class="icon icon-primary">
                        <use href="{{Theme::url('svg/sprites.svg')}}#it-chevron-left"></use>
                    </svg>
                    Indietro
                </button>
            </a>
        @endif
    </div>

    <div class="d-flex justify-content-end gap-lg-3 gap-5">
        @php
            $info = isset($candidatura) ? $candidatura->info : [];
            $stepsDone = \Illuminate\Support\Arr::get($info,'steps',[]);
        @endphp
        <div class="d-flex justify-content-end gap-lg-3 gap-5">

            <button type="submit" name="submit-type"
                    class="btn btn-primary btn-sm steppers-btn-save d-lg-block"
                    @if(array_key_last($steps) == $step)
                        value="invia"
                        @if (count($stepsDone) < (count($steps)-1))
                            disabled="disabled"
                        @endif
                    @else
                        value="save"
                    @endif
            >
            @if (array_key_last($steps) != $step)
                Salva
            @else
                Conferma ed invia
            @endif
        </button>
        @if (array_key_last($steps) != $step)
            <button type="submit" name="submit-type" value="next"
                    class="btn btn-outline-primary btn-sm steppers-btn-next">Avanti
                <svg class="icon icon-primary">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-chevron-right"></use>
                </svg>
            </button>
        @endif


    </div>
</nav>

