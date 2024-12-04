@php
if ($candidatura->scuola) {
    $scuola = $candidatura->scuola->getScuolaFE();
    $scuolaLabel = 'Scuola';
} else {
    $scuola = $candidatura->scuola_estera;
    $scuolaLabel = 'Scuola Estera';
}
@endphp

@include('candidature.form.riepilogo-text',['value' => $scuola,'label' => $scuolaLabel])

@include('candidature.form.riepilogo-text',['value' => $candidatura->classe,'label' => 'Classe'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->sezione,'label' => 'Sezione'])

