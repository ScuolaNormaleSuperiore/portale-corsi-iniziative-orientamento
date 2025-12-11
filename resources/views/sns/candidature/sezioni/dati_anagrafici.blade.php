@include('candidature.form.input-icon',['field' => 'cognome','label' => 'Cognome'])

@include('candidature.form.input-icon',['field' => 'nome','label' => 'Nome'])

@include('candidature.form.input-icon',['field' => 'codice_fiscale','label' => 'Codice fiscale'])

@include('candidature.form.input-icon',['field' => 'luogo_nascita','label' => 'Luogo di nascita'])

@include('candidature.form.input-icon',['type' => 'date','field' => 'data_nascita','label' => 'Data di nascita'])

@include('candidature.form.select',['field' => 'sesso','label' => 'In che genere ti identifichi?', 'cssForm' => 'last'])
