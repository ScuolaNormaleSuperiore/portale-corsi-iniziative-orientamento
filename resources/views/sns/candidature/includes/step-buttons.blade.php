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

            @if(array_key_last($steps) == $step)
                <input type="hidden" name="submit-type" value="invia"/>
                <button type="button"
                        class="btn btn-primary btn-me"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-invia-candidatura"
                        id="confermaEdInvia"
                >
                    Conferma ed invia
                </button>

            @else
                <button type="submit" name="submit-type"
                        class="btn btn-primary btn-sm steppers-btn-save d-lg-block"
                        value="save"
                >
                    Salva
                </button>

            @endif



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

<div class="it-example-modal">
    <div class="container">
        <div class="modal" tabindex="-1" role="dialog" id="modal-invia-candidatura"
             aria-labelledby="modal7Title">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal7Title">Invio candidatura</h5>
                    </div>
                    <div class="modal-body">
                        <p>Confermi l'invio della candidatura?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" id="invia-candidatura-button-modal" type="button">Invia
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-dismiss="modal">Annulla
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        let inviaModal = new bootstrap.Modal(document.getElementById('modal-invia-candidatura'), {});

        var form = document.getElementById('candidaturaForm');
        var inviaButton = document.getElementById('invia-candidatura-button-modal');
        inviaButton.addEventListener('click', function () {
            form.submit();
        });


    })

</script>


