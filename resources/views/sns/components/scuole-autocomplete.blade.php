<div class="row">
    <div class="col-12 col-md-6 mt-5">
        <div class="select-wrapper">
            <label for="scuolaAutocomplete">La tua scuola</label>
            <select class="form-control" id="scuolaAutocomplete" title="Scegli una scuola">
            </select>
            <input type="hidden" value="" name="scuola_id" id="scuola_id"/>
        </div>
    </div>
    <div class="col-12 col-md-6 mt-5">
        <div class="select-wrapper">
            <div class="select-wrapper form-group-candidature last register-scuola" id="register-scuola-provincia_scuola_id">
                    <label for="provincia_scuola_id">
                        Provincia della scuola
                    </label>
                <select id="provincia_scuola_id" name="provincia_scuola_id">
                        <option selected="" value="">Scegli un'opzione</option>
                        @foreach($province as $provincia)
                            <option value="{{\Illuminate\Support\Arr::get($provincia,'value')}}"
                                    @if(old('provincia_scuola_id') == \Illuminate\Support\Arr::get($provincia,'value'))
                                        selected
                                    @endif
                            >
                                {{\Illuminate\Support\Arr::get($provincia,'label')}}
                            </option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center mt-3">

        <div class="" id="scuola_text">

        </div>
        <div>
            <button type="button" class="btn d-none"
                    id="rimuoviScuola"
            >
                <svg class="icon icon-danger" aria-hidden="true">
                    <use href="{{Theme::url('svg/sprites.svg')}}#it-delete"></use>
                </svg>
            </button>
        </div>
    </div>

    <div class="col-12 mt-5 @if(isset($noEmailScuola)) d-none @endif">
        <div class="form-group" id="emailScuola">
            <input type="email" class="form-control" id="emailScuolaInput" name="emailScuolaInput" disabled>
            <label class="active" for="emailScuolaInput">Indirizzo E-mail Scuola</label>

        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        let status;

        let scuole = {};

        let rimuoviScuolaButton = document.getElementById('rimuoviScuola');

        let scuoleToArray = function () {
            console.debug("SCUOLE:::", scuole);
            var sa = [];

            for (var i in scuole) {
                var scuola = scuole[i];
                sa.push(scuola.denominazione + ' (' + scuola.provincia_sigla + ') - Cod:' + scuola.codice);
            }

            return sa;
        }

        function requestSuggestions(query, fetchArgs = {}) {
            console.debug("JSON1::: ", query);
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

                    console.debug("JSON::: ", response.data.result);

                    return scuoleToArray();
                })
                .catch(function (error) {
                    scuole = {};
                    console.debug("JSONE::: ", error);
                    var data = error.response.data;
                    // console.debug(error.response.data);
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
            minLength: 2,
            showAllValues: true,
            defaultValue: '',
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

                console.debug("CONFIRM::: ", val);

                var cod;

                if (val) {
                    cod = val.split("Cod:").pop();
                } else {
                    return;
                }


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

                document.getElementById('emailScuolaInput').value = scuole[cod] ? scuole[cod].email_riferimento : 'E-mail non trovata';
                document.getElementById('scuola_id').value = scuole[cod] ? scuole[cod].id : null;
            }
            //tNoResults: tNoResults,
        })

        rimuoviScuolaButton.addEventListener('click', function () {
            rimuoviScuola();
        })

        function rimuoviScuola() {
            var scuolaText = document.getElementById('scuola_text');
            document.getElementById('emailScuolaInput').value = null;
            document.getElementById('scuola_id').value = null;
            scuolaText.innerHTML = '';
            rimuoviScuolaButton.classList.add('d-none');
            document.getElementById('scuolaAutocomplete').value = null;
            document.getElementById('scuolaAutocomplete').blur();
            // console.debug("ELEEMNTTT::: ",element);
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
