<p class="mb-5">
    Riporta il livello più alto che hai raggiunto nelle seguenti competizioni.
</p>
@include('candidature.form.select',['field' => 'olimpiadi_matematica', 'label' => 'Olimpiadi di matematica (individuale)'])
@include('candidature.form.select',['field' => 'olimpiadi_matematica_squadre', 'label' => 'Olimpiadi di matematica (a squadre miste)'])
@include('candidature.form.select',['field' => 'olimpiadi_matematica_squadre_femminili', 'label' => 'Olimpiadi di matematica (a squadre femminili)'])
@include('candidature.form.select',['field' => 'olimpiadi_fisica', 'label' => 'Olimpiadi di fisica (individuale)'])
@include('candidature.form.select',['field' => 'olimpiadi_fisica_squadre_miste', 'label' => 'Olimpiadi di fisica (a squadre miste)'])

@include('candidature.form.select',['field' => 'olimpiadi_scienze_naturali', 'label' => 'Olimpiadi di scienze naturali'])
@include('candidature.form.select',['field' => 'giochi_chimica', 'label' => 'Giochi della chimica'])
@include('candidature.form.select',['field' => 'olimpiadi_informatica', 'label' => 'Olimpiadi di informatica'])

<p>
    Eventuali partecipazioni a stages e gare internazionali
</p>
@include('candidature.form.checkbox',['field' => 'stages','label' => ''])
@include('candidature.form.checkbox',['field' => 'gare_internazionali','label' => '', 'cssForm' => 'last'])


<p>
    Riporta eventuali altre partecipazioni a concorsi.
</p>

@include('candidature.form.textarea',['field' => 'partecipazione_concorsi','label' => 'Partecipazione a concorsi', 'cssForm' => 'last'])
