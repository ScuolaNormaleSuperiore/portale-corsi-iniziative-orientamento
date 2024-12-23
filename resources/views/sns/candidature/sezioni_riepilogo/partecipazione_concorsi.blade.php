<p class="mb-5">
    Il livello più alto che hai raggiunto nelle seguenti due competizioni.
</p>
@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiMatematica::optionLabel($candidatura->olimpiadi_matematica),'label' => 'Olimpiadi di matematica (individuale)'])

@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiMatematicaSquadre::optionLabel($candidatura->olimpiadi_matematica_squadre),'label' => 'Olimpiadi di matematica (individuale)'])
@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiMatematicaSquadreFemminili::optionLabel($candidatura->olimpiadi_matematica_squadre_femminili),'label' => 'Olimpiadi di matematica (individuale)'])

@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiFisica::optionLabel($candidatura->olimpiadi_fisica), 'label' => 'Olimpiadi di fisica (individuale)'])
@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiFisicaSquadreMiste::optionLabel($candidatura->olimpiadi_fisica_squadre_miste),'label' => 'Olimpiadi di matematica (individuale)'])
@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiScienzeNaturali::optionLabel($candidatura->olimpiadi_scienze_naturali),'label' => 'Olimpiadi di matematica (individuale)'])
@include('candidature.form.riepilogo-text',['value' => \App\Enums\GiochiChimica::optionLabel($candidatura->giochi_chimica),'label' => 'Olimpiadi di matematica (individuale)'])

@include('candidature.form.riepilogo-text',['value' => \App\Enums\OlimpiadiInformatica::optionLabel($candidatura->olimpiadi_informatica),'label' => 'Olimpiadi di matematica (individuale)'])

<p class="mt-5">
    Eventuali partecipazioni a stages
</p>

@foreach($candidatura->stages as $optionIndex => $stage)
    <div class="form-check form-check-group fw-bold">
        <label for="corsi[{{$optionIndex}}]">
            {{\App\Enums\Stages::optionLabel($stage)}}
        </label>
    </div>
@endforeach

<p class="mt-5">
    Eventuali partecipazioni a gare internazionali
</p>

@foreach($candidatura->gare_internazionali as $optionIndex => $gara)
    <div class="form-check form-check-group fw-bold">
        <label for="corsi[{{$optionIndex}}]">
            {{\App\Enums\GareInternazionali::optionLabel($gara)}}
        </label>
    </div>
@endforeach

<p class="mt-5">
    Eventuali altre partecipazioni a concorsi.
</p>

@include('candidature.form.riepilogo-text',['value' => $candidatura->partecipazione_concorsi])
