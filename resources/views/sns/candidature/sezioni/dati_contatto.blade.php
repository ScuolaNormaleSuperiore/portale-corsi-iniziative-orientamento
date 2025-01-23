@include('candidature.form.input-icon',['type' => 'email','field' => 'emails','label' => 'Email'])

@include('candidature.form.input-icon',['type' => 'tel','field' => 'telefono','label' => 'Telefono'])


@include('candidature.form.select',['field' => 'nazione_id','label' => 'Nazione'])

<div class="italiano" id="italiano">
    @include('candidature.form.select',['field' => 'provincia_id','label' => 'Provincia'])
    @include('candidature.form.select',['field' => 'comune_id','label' => 'Comune'])
    <input type="hidden" disabled id="comune_id_init" value="{{old('comune_id') ?: \Illuminate\Support\Arr::get($sectionData['fields']['comune_id'],'value')}}"/>
</div>
<div class="estero" id="estero">
    @include('candidature.form.input-icon',['field' => 'comune_estero','label' => 'Comune'])
</div>
@include('candidature.form.input-icon',['field' => 'indirizzo','label' => 'Indirizzo'])
@include('candidature.form.input-icon',['field' => 'cap','label' => 'CAP', 'cssForm' => 'last'])

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        let comuni = {};
        var nazioneEl = document.getElementById('nazione_id');
        nazioneEl.addEventListener('change', function (e,v) {
            var val = parseInt(e.target.value);
            if (val === 1) {
                document.getElementById('italiano').classList.remove('d-none');
                document.getElementById('estero').classList.add('d-none');
            } else {
                document.getElementById('italiano').classList.add('d-none');
                document.getElementById('estero').classList.remove('d-none');
            }
        });
        nazioneEl.dispatchEvent(new Event('change'));

        var provinciaEl = document.getElementById('provincia_id');
        provinciaEl.addEventListener('change', function (e,v) {
            var val = parseInt(e.target.value);

            requestComuni(val)
                .then(options => updateComuni())
                // In case of errors, we need to clear the results so the accessible
                // autocomplate show its 'No result found'
                .catch(error => updateComuni());
        });

        provinciaEl.dispatchEvent(new Event('change'));

        function updateComuni() {

            var comuneEl = document.getElementById('comune_id');
            var comuneInitEl = document.getElementById('comune_id_init');
            var value = parseInt(comuneInitEl.value);
            console.log("COMUNE VALUE === ", value);
            var html = '<option '+
                (isNaN(value) ? "selected " : "")+
                ' value="">Seleziona...</option>';
            for (var i in comuni) {
                var currComune = comuni[i];
                html += '<option ' +
                    (parseInt(i) === value ? "selected " : "") +
                    ' value="'+i+'">'+currComune+'</option>';
            }
            comuneEl.innerHTML = html;

        }

        function requestComuni(query, fetchArgs = {}) {
            console.log("JSON1::: ", query);
            return axios.post('/api/comuni-provincia', {
                value: query,
            })
                .then(function (response) {
                    comuni = {};
                    for (var i in response.data.result) {
                        var comune = response.data.result[i];
                        comuni[i] = comune;

                    }

                    console.log("JSON::: ", response.data.result);

                    return comuni;
                })
                .catch(function (error) {
                    comuni = {};
                    console.log("JSONE::: ", error);
                    var data = error.response.data;
                    // console.log(error.response.data);
                });
        }
    });


</script>
