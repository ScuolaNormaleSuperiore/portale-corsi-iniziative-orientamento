@include('candidature.form.riepilogo-text',['value' => $candidatura->emails,'label' => 'Email'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->telefono,'label' => 'Telefono'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->indirizzo,'label' => 'Indirizzo'])
@include('candidature.form.riepilogo-text',['value' => $candidatura->comune,'label' => 'Comune'])
@include('candidature.form.riepilogo-text',['value' => $candidatura->cap,'label' => 'CAP'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->provincia->nome . ' (' . $candidatura->provincia->sigla . ')','label' => 'Provincia'])
