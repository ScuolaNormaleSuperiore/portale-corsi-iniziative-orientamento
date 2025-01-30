@include('candidature.form.riepilogo-text',['value' => $candidatura->titolo1?->nome,'label' => 'Titolo di studio del genitore 1'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->titolo2?->nome,'label' => 'Titolo di studio del genitore 2'])

@php
    $professione1 = $candidatura->professione1 ? $candidatura->professione1->nome : $candidatura->gen1_professione_altro;
    $professione2 = $candidatura->professione2 ? $candidatura->professione2->nome : $candidatura->gen2_professione_altro;
@endphp

@include('candidature.form.riepilogo-text',['value' => $professione1,'label' => 'Professione del genitore 1'])

@include('candidature.form.riepilogo-text',['value' => $professione2,'label' => 'Professione del genitore 2'])
