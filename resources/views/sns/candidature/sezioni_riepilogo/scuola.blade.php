<p class="pb-2">
    Digita alcune lettere della scuola e scegli dall'elenco che appare.
</p>

@include('candidature.form.scuole-autocomplete',['field' => 'scuola_id'])

<p class="pb-2">
    In caso di scuola straniera, compilare manualmente il campo sottostante.
</p>

@include('candidature.form.input-icon',['field' => 'scuola_estera','label' => 'Scuola Estera'])

@include('candidature.form.select',['field' => 'classe','label' => 'Classe'])

@include('candidature.form.input-icon',['field' => 'sezione','label' => 'Sezione'])

