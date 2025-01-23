@include('candidature.form.riepilogo-text',['value' => $candidatura->emails,'label' => 'Email'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->telefono,'label' => 'Telefono'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->nazione->nome,'label' => 'Nazione'])

@if ($candidatura->nazione_id == 1)
    @include('candidature.form.riepilogo-text',['value' => $candidatura->comune->nome,'label' => 'Comune'])
    @include('candidature.form.riepilogo-text',['value' => $candidatura->provincia->nome . ' (' . $candidatura->provincia->sigla . ')','label' => 'Provincia'])
@else
    @include('candidature.form.riepilogo-text',['value' => $candidatura->comune_estero,'label' => 'Comune'])
@endif

@include('candidature.form.riepilogo-text',['value' => $candidatura->indirizzo,'label' => 'Indirizzo'])
@include('candidature.form.riepilogo-text',['value' => $candidatura->cap,'label' => 'CAP'])
