@php
    if ($candidatura->scuola) {
        $scuolaEstera = false;
        $scuola = $candidatura->scuola;
        $scuolaLabel = 'Scuola';
    } else {
        $scuolaEstera = true;
        $scuola = $candidatura->scuola_estera;
        $scuolaLabel = 'Scuola Estera';
    }
@endphp

@if(!$scuolaEstera)
    <div id="scuola_text">
            <span class="badge bg-primary">
                {{$scuola->tipologia_grado_istruzione}}
            </span>
    </div>
    <p>
        {{$scuola->denominazione}} (Cod: {{$scuola->codice}})
        <br/>
        {{$scuola->indirizzo}}
        <br/>
        {{$scuola->cap}} {{$scuola->comune}} ({{$scuola->provincia?->sigla}})
    </p>
@else
    @include('candidature.form.riepilogo-text',['value' => $scuola,'label' => $scuolaLabel])
@endif

@include('candidature.form.riepilogo-text',['value' => $candidatura->classe,'label' => 'Classe'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->sezione,'label' => 'Sezione'])

