@include('candidature.form.riepilogo-text',['label' => 'Cognome','value' => $candidatura->cognome])

@include('candidature.form.riepilogo-text',['label' => 'Nome','value' => $candidatura->nome])

@include('candidature.form.riepilogo-text',['value' => $candidatura->luogo_nascita,'label' => 'Luogo di nascita'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->data_nascita,'label' => 'Data di nascita'])

@include('candidature.form.riepilogo-text',['value' => $candidatura->sesso,'label' => 'Genere'])
