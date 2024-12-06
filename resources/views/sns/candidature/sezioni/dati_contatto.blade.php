@include('candidature.form.input-icon',['type' => 'email','field' => 'emails','label' => 'Email'])

@include('candidature.form.input-icon',['type' => 'tel','field' => 'telefono','label' => 'Telefono'])

@include('candidature.form.input-icon',['field' => 'indirizzo','label' => 'Indirizzo'])
@include('candidature.form.input-icon',['field' => 'comune','label' => 'Comune'])
@include('candidature.form.input-icon',['field' => 'cap','label' => 'CAP'])

@include('candidature.form.select',['field' => 'provincia_id','label' => 'Provincia', 'cssForm' => 'last'])
