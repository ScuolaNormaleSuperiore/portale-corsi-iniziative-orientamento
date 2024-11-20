<div class="row">
    <div class="col-12 mt-5">
        <div class="select-wrapper">
            <label for="scuolaAutocomplete">La tua scuola</label>
            <select class="form-control" id="scuolaAutocomplete" title="Scegli una scuola">
            </select>
            <input type="hidden" value="" name="idScuola" id="idScuola"/>
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
        // Sending requests to a server means that when the autocomplete has no
        // result it may not be because there are no results, but because these
        // results are being fetched, or because an error happened. We can use the
        // function for internationalising the 'No results found' message to
        // provide a little more context to users.
        //
        // It'll rely on a `status` variable updated by the wrappers of the
        // function making the request (see thereafter)
        let status;

        let scuole = {};

        let scuoleToArray = function () {
            console.log("SCUOLE:::", scuole);
            var sa = [];

            for (var i in scuole) {
                var scuola = scuole[i];
                sa.push(scuola.denominazione + ' (' + scuola.provincia_sigla + ') - Cod:' + scuola.codice);
            }

            return sa;
        }

        // The aim being to load suggestions from a server, we'll need a function
        // that does just that. This one uses `fetch`, but you could also use
        // XMLHttpRequest or whichever library is the most suitable to your
        // project
        //
        // For lack of a actual server able of doing computation our endpoint will
        // return the whole list of countries and we'll simulate the work of the
        // server client-side
        function requestSuggestions(query, fetchArgs = {}) {
            console.log("JSON1::: ", query);
            return axios.post('/api/scuole-suggest', {
                value: query,
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

        // And finally we can set up our accessible autocomplete
        const element = document.getElementById("scuolaAutocomplete")
        const id = 'scuolaAutocomplete'
        new bootstrap.SelectAutocomplete(element, {

            name: 'scuolaAutocomplete',
            confirmOnBlur: false,
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

                console.log("CONFIRM::: ", val);

                var cod = val.split("Cod:").pop();

                document.getElementById('emailScuolaInput').value = scuole[cod] ? scuole[cod].email_riferimento : 'E-mail non trovata';
                document.getElementById('idScuola').value = scuole[cod] ? scuole[cod].id : null;
            }
            //tNoResults: tNoResults,
        })

        ////
        // INTERNAL DETAILS
        ////

        // Technically, it'd be the server doing the filtering but for lack of
        // server, we're requesting the whole list and filter client-side.
        // Similarly, we'll use a specific query to trigger error for demo
        // purpose, which will be easier than going in the devtools and making the
        // request error We'll also simulate that the server takes a little time
        // to respond to make things more visible in the UI
        const SERVER_LATENCY = 2500;

        // Debouncing limits the number of requests being sent
        // but does not guarantee the order in which the responses come in
        // Due to network and server latency, a response to an earlier request
        // may come back after a response to a later request
        // This keeps track of the AbortController of the last request sent
        // so it can be cancelled before sending a new one
        //
        // NOTE: If you're using `XMLHttpRequest`s or a custom library,
        // they'll have a different mechanism for aborting. You can either:
        // - adapt this function to store whatever object lets you abort in-flight requests
        // - or adapt your version of `requestSuggestion` to listen to the `signal`
        //   that this function passes to the wrapped function and trigger
        //   whichever API for aborting you have available
        //   See: https://developer.mozilla.org/en-US/docs/Web/API/AbortSignal#events
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
