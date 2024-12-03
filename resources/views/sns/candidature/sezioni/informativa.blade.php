<p class="mb-3">
    I dati personali forniti nel presente modulo di candidatura saranno trattati in conformità con il Decreto
    Legislativo 30 giugno 2003, n. 196 (Codice in materia di protezione dei dati personali) e con il
    Regolamento UE 2016/679 (GDPR) relativo alla protezione delle persone fisiche con riguardo al trattamento dei
    dati personali.
</p>

<p class="mb-3">
    Per i dettagli sul trattamento dei dati personali consulta l'<a href="/pagina/privacy">informativa sulla privacy</a>.
</p>

<div class="row">
    <div class="col-12">
        <div class="form-check form-check-inline">
            <input id="privacy" name="privacy"
                   type="checkbox"
                   value="1"
                   @if($candidatura->privacy || old('privacy'))
                       checked="checked"
                @endif
            >
            <label for="privacy">
                Ho letto e compreso l’informativa sulla privacy
            </label>
        </div>
    </div>
</div>

