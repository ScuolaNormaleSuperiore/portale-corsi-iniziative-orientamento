<p class="mb-5">
    Riporta il livello più alto che hai raggiunto nelle seguenti due competizioni.
</p>
@include('candidature.form.select',['field' => 'olimpiadi_matematica', 'label' => 'Olimpiadi di matematica (individuale)'])
@include('candidature.form.select',['field' => 'olimpiadi_fisica', 'label' => 'Olimpiadi di fisica (individuale)'])

<p>
    Riporta eventuali altre partecipazioni a concorsi.
</p>

@include('candidature.form.textarea',['field' => 'partecipazione_concorsi','label' => 'Partecipazione a concorsi', 'cssForm' => 'last'])
