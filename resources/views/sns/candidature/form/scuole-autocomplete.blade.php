@php
    $fieldData = \Illuminate\Support\Arr::get($sectionData['fields'],$field,[]);
    $validation = \Illuminate\Support\Arr::get($fieldData,'validation',[]);
    $value = old($field) ?: \Illuminate\Support\Arr::get($fieldData,'value');
    $referredData = old('scuola_referred_data') ?: \Illuminate\Support\Arr::get($fieldData,'referred_data');
    $referredDataFull = old('scuola_referred_data_full') ?:  \Illuminate\Support\Arr::get($fieldData,'referred_data_full');
@endphp
<div class="d-flex justify-items-center gap-3">
    <div class="select-wrapper w-50 form-group-candidature" id="form-group-candidature-scuola_id">
        <label for="scuolaAutocomplete">Scuola*</label>
        <select class="form-control" id="scuolaAutocomplete" title="Scegli una scuola"
        >
        </select>
        <input type="hidden" value="{{$value}}" name="scuola_id" id="scuola_id"/>
    </div>
    <div class="w-50">
        @include('candidature.form.select',['field' => 'provincia_scuola_id','label' => 'Provincia scuola'])
    </div>

</div>
<div class="d-flex align-items-center">

    <div class="" id="scuola_text">

        @if($referredDataFull)
            <div id="scuola_text">
            <span class="badge bg-primary">
                {{$referredDataFull->tipologia_grado_istruzione}}
            </span>
            </div>
            <p>
                {{$referredDataFull->denominazione}} (Cod: {{$referredDataFull->codice}})
                <br/>
                {{$referredDataFull->indirizzo}}
                <br/>
                {{$referredDataFull->cap}} {{$referredDataFull->comune}} ({{$referredDataFull->provincia?->sigla}})
            </p>
        @endif
    </div>
    <div>
        <button type="button" class="btn {{ $referredDataFull ? '' : 'd-none'}}"
                id="rimuoviScuola"
        >
            <svg class="icon icon-danger" aria-hidden="true">
                <use href="{{Theme::url('svg/sprites.svg')}}#it-delete"></use>
            </svg>
        </button>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        let status;

        let scuole = {};

        let rimuoviScuolaButton = document.getElementById('rimuoviScuola');

        let scuoleToArray = function () {
            console.log("SCUOLE:::", scuole);
            var sa = [];

            for (var i in scuole) {
                var scuola = scuole[i];
                sa.push(scuola.denominazione + ' (' + scuola.provincia_sigla + ') - Cod:' + scuola.codice);
            }

            return sa;
        }

        function requestSuggestions(query, fetchArgs = {}) {
            console.log("JSON1::: ", query);
            document.getElementById('scuola_id').value = null;
            return axios.post('/api/scuole-suggest', {
                value: query,
                provincia_scuola_id : document.getElementById('provincia_scuola_id').value,
            })
                .then(function (response) {
                    scuole = {};
                    for (var i in response.data.result) {
                        var scuola = response.data.result[i];
                        scuole[scuola.codice] = scuola;

                    }

                    console.log("JSON::: ", response.data.result);

                    return scuoleToArray();
                })
                .catch(function (error) {
                    scuole = {};
                    console.log("JSONE::: ", error);
                    var data = error.response.data;
                    // console.log(error.response.data);
                });
        }

        // We'll wrap that function multiple times, each enhancing the previous
        // wrapping to handle the the different behaviours necessary to
        // appropriately coordinate requests to the server and display feedback to
        // users
        const makeRequest =
            // Wrapping everything is the error handling to make sure it catches
            // errors from any of the other wrappers
            trackErrors(
                // Next up is tracking whether we're loading new results
                trackLoading(
                    // To avoid overloading the server with potentially costly requests
                    // as well as avoid wasting bandwidth while users are typing we'll
                    // only send requests a little bit after they stop typing
                    debounce(
                        // Finally we want to cancel requests that are already sent, so
                        // only the results of the last one update the UI This is the role
                        // of the next two wrappers
                        abortExisting(
                            // That last one is for demo only, to simulate server behaviours
                            // (latency, errors, filtering) on the client
                            requestSuggestions
                        ),
                        250
                    )
                )
            );

        // We can then use the function we built and adapt it to the autocomplete
        // API encapsulating the adjustments specific to rendering the 'No result
        // found' message
        function source(query, populateResults) {
            // Start by clearing the results to ensure a loading message
            // shows when a the query gets updated after results have loaded
            populateResults([])

            if (query.length >= 2) {


                makeRequest(query)
                    // Only update the results if an actual array of options get returned
                    // allowing for `makeRequest` to avoid making updates to results being
                    // already displayed by resolving to `undefined`, like when we're
                    // aborting requests
                    .then(options => options && populateResults(options))
                    // In case of errors, we need to clear the results so the accessible
                    // autocomplate show its 'No result found'
                    .catch(error => populateResults([]))
            }
        }

        // And finally we can set up our accessible autocomplete
        const element = document.getElementById("scuolaAutocomplete")
        const id = 'scuolaAutocomplete'
        new bootstrap.SelectAutocomplete(element, {

            name: 'scuolaAutocomplete',
            confirmOnBlur: false,
            showAllValues: true,
            defaultValue: '{{$referredData}}',
            autoselect: false,
            showNoOptionsFound: false,
            dropdownArrow: () => '',
            // source: (query, populateResults) => {
            //     const results = form_data[categorySelect.value]
            //     const filteredResults = results.filter(result => result.indexOf(query) !== -1)
            //     populateResults(filteredResults)
            // }
            source: source,
            onConfirm(val) {

                console.log("CONFIRM::: ", val);

                var cod = val.split("Cod:").pop();

                var scuola = scuole[cod];
                var scuolaText = document.getElementById('scuola_text');

                if (scuola) {
                    document.getElementById('scuola_id').value = scuola.id;
                    scuolaText.innerHTML = '<div>' +
                        '<span class="badge bg-primary">' +
                        scuola['tipologia_grado_istruzione'] +
                        '</span>' +
                        '</div><p>' +
                        scuola['denominazione'] + ' (Cod: ' + scuola['codice'] + ')' +
                        '<br/>' +
                        scuola['indirizzo'] +
                        '<br/>' +
                        scuola['cap'] + ' ' + scuola['comune'] + ' (' + scuola['provincia_sigla'] + ')' +
                        '</p>';
                    rimuoviScuolaButton.classList.remove('d-none');
                } else {
                    rimuoviScuola();
                }

            }
            //tNoResults: tNoResults,
        });

        rimuoviScuolaButton.addEventListener('click',function () {
            rimuoviScuola();
        })

        function rimuoviScuola() {
            var scuolaText = document.getElementById('scuola_text');
            document.getElementById('scuola_id').value = null;
            scuolaText.innerHTML = '';
            rimuoviScuolaButton.classList.add('d-none');
            document.getElementById('scuolaAutocomplete').value = null;
            // console.log("ELEEMNTTT::: ",element);
            // element.value = "";
            // element.innerText = "";
        }

        let abortController;

        function abortExisting(fn) {
            return function (...args) {
                if (abortController) {
                    abortController.abort();
                }

                abortController = new AbortController();

                return fn(...args, {signal: abortController.signal})
                    .then(result => {
                        abortController = null;
                        return result;
                    }, error => {
                        // Aborting requests will lead to `fetch` rejecting with an
                        // `AbortError` In that situation, that's something we expect, so
                        // we don't want to show a message to users
                        if (error.name !== 'AbortError') {
                            abortController = null;
                            throw error;
                        }
                    })
            }
        }

        // Debounces the given function so it only gets executed after a specific delay
        function debounce(fn, wait) {
            let timeout
            return function (...args) {
                return new Promise(resolve => {
                    clearTimeout(timeout)

                    const later = function () {
                        timeout = null
                        resolve(fn(...args))
                    }
                    timeout = setTimeout(later, wait)
                })
            }
        }


        // Tracks the loading state so we can adapt the message being displayed to the user
        function trackLoading(fn) {
            return function (...args) {
                status = 'loading';
                return fn(...args)
                    .then(result => {
                        status = null;
                        return result
                    }, error => {
                        status = null;
                        throw error
                    })
            }
        }

        // In a similar fashion, we can track errors happening, which will adjust the message
        function trackErrors(fn) {
            return function (...args) {
                return fn(...args)
                    .catch(error => {
                        status = 'error'
                        throw error
                    })
            }
        }
    });
</script>
