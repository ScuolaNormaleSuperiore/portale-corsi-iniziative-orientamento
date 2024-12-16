<p class="mb-5">
    Il livello più alto che hai raggiunto nelle seguenti due competizioni.
</p>
@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiMatematica::optionLabel($candidatura->olimpiadi_matematica),'label' => 'Olimpiadi di matematica (individuale)'])
@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiFisica::optionLabel($candidatura->olimpiadi_fisica), 'label' => 'Olimpiadi di fisica (individuale)'])

<p>
    Eventuali altre partecipazioni a concorsi.
</p>

@include('candidature.form.riepilogo-text',['value' => $candidatura->partecipazione_concorsi])
