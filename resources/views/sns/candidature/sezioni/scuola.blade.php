@if($ruolo == 'Scuola')
    @php
        $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],'scuola_id',[]);
        $value = \Illuminate\Support\Arr::get($fieldData,'value');
        $referredDataFull = \Illuminate\Support\Arr::get($fieldData,'referred_data_full');
    @endphp
    <div class="select-wrapper form-group-candidature" id="form-group-candidature-scuola_id">
        <input type="hidden" value="{{$value}}" name="scuola_id" id="scuola_id"/>
        <div class="" id="scuola_text">

            @if($referredDataFull)
                <div id="scuola_text">
            <span class="badge bg-primary">
                {{$referredDataFull->tipologia_grado_istruzione}}
            </span>
                </div>
                <p>
                    {{$referredDataFull->denominazione}} (Cod: {{$referredDataFull->codice}})
                    <br/>
                    {{$referredDataFull->indirizzo}}
                    <br/>
                    {{$referredDataFull->cap}} {{$referredDataFull->comune}} ({{$referredDataFull->provincia?->sigla}})
                </p>
            @endif
        </div>
    </div>

@else
    <p class="pb-2">
        Digita alcune lettere della scuola e scegli dall'elenco che appare.
    </p>

    @include('candidature.form.scuole-autocomplete',['field' => 'scuola_id'])

    <p class="pb-2">
        In caso di scuola straniera, compilare manualmente il campo sottostante.
    </p>

    @include('candidature.form.input-icon',['field' => 'scuola_estera','label' => 'Scuola Estera'])
@endif

@include('candidature.form.select',['field' => 'classe','label' => 'Classe'])

@include('candidature.form.input-icon',['field' => 'sezione','label' => 'Sezione', 'cssForm' => 'last'])

