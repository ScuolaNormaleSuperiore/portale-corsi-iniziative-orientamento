@php
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],'informativa',[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = \Illuminate\Support\Arr::get($fieldData,'value',old('informativa'));
@endphp
<p class="mb-3">
    I dati personali forniti nel presente modulo di candidatura saranno trattati in conformità con il Decreto
    Legislativo 30 giugno 2003, n. 196 (Codice in materia di protezione dei dati personali) e con il
    Regolamento UE 2016/679 (GDPR) relativo alla protezione delle persone fisiche con riguardo al trattamento dei
    dati personali.
</p>

<p class="mb-3">
    Per i dettagli sul trattamento dei dati personali consulta l'<a class="text-decoration-underline" href="/pagina/privacy-policy">informativa sulla privacy</a>.
</p>
<p class="mb-3">Ai sensi degli artt. 46 e 47 del DPR 445/2000, nella consapevolezza delle sanzioni civili e penali nel caso di dichiarazioni non veritiere, di formazione o uso di atti falsi, richiamate dall’art. 76 del DPR 445/2000, dichiaro che tutte le informazioni e dichiarazione, corrispondono al vero.

</p>
<div class="row">
    <div class="col-12">
        <div class="form-check form-check-inline">
            <input id="informativa" name="informativa"
                   type="checkbox"
                   value="1"
                   @if($value)
                       checked="checked"
                @endif
            >
            <label for="informativa">
                Ho letto e compreso l'informativa sulla privacy e assumo le dichiarazioni rese ex artt. 46-47 DPR 445/2000.
            </label>
        </div>
    </div>
</div>

