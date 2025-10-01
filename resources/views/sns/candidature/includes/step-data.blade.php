<div class="row">


    @if (count($datiStep['sections']) > 1)
        <div class="col-12 col-lg-4">
            @include('candidature.includes.navleft',['sezioni' => $datiStep['sections']])
        </div>
        <div class="col-12 col-lg-8">

            @include('candidature.includes.step-errors')

            <p>I campi contraddistinti dal simbolo asterisco (*) sono obbligatori</p>

            @foreach ($datiStep['sections'] as $sectionData)
                {{--                @dump($sectionData)--}}
                <div class="candidature" id="sezione_{{$sectionData['code']}}">
                    <div class="card no-after rounded mb-4" style="background-color:#EFF8FA;">
                        <div class="card-body">
                            <h3 class="card-title h3">{{$sectionData['title']}}</h3>
                            @if(\Illuminate\Support\Arr::get($sectionData,'subtitle'))
                                <p class="card-text text-secondary">
                                    {{$sectionData['subtitle']}}
                                </p>
                            @endif
                            <div class="card no-after rounded bg-white">
                                <div class="card-body">
                                    @include('candidature.sezioni.'.$sectionData['code'],['datiStep' => $datiStep,'sectionData' => $sectionData])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="col-12">
            @include('candidature.includes.step-errors')


            <p>I campi contraddistinti dal simbolo asterisco (*) sono obbligatori</p>
            @foreach ($datiStep['sections'] as $sectionData)
                <div class="" id="sezione_{{$sectionData['code']}}">
                    <div class="card no-after rounded mb-4" style="background-color:#EFF8FA;">
                        <div class="card-body">
                            <h3 class="card-title h3">{{$sectionData['title']}}</h3>
                            @if(\Illuminate\Support\Arr::get($sectionData,'subtitle'))
                                <p class="card-text text-secondary">
                                    {{$sectionData['subtitle']}}
                                </p>
                            @endif
                            <div class="card rounded bg-white">
                                <div class="card-body">
                                    @include('candidature.sezioni.'.$sectionData['code'],['datiStep' => $datiStep,'sectionData' => $sectionData])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

@if (in_array($step,[2,3,4]))

    <script>
        // Funzione per inviare automaticamente il form
        function autoSave() {
            var form = document.getElementById('candidaturaForm');

            // Crea l'evento personalizzato per l'auto-save
            var autoSaveEvent = new CustomEvent('autoSave', {
                detail: {message: 'Auto-save triggered'}
            });

            // Aggiungi un listener per trattare il salvataggio
            form.addEventListener('autoSave', function (e) {
                console.log(e.detail.message); // Azione per confermare l'auto-save

                let data = new FormData(form);
                let config = {
                    headers: {
                        'Authorization': 'Basic ' + '{{$basicAuth}}' + ', Bearer ' + '{{$validBt}}',
                        'Authbt': 'Bearer ' + '{{$validBt}}'
                    },
                }
                // console.log("JSON1::: ", query);
                return axios.post("{{route('candidatura.update-auto',['candidatura' => $candidatura->getKey()])}}",
                    data, config)
                    .then(function (response) {
                        // comuni = {};
                        // for (var i in response.data.result) {
                        //     var comune = response.data.result[i];
                        //     comuni[i] = comune;
                        //
                        // }

                        console.log("JSON::: ", response.data.result);

                        return;
                    })
                    .catch(function (error) {
                        //comuni = {};
                        console.log("JSONE::: ", error);
                        var data = error.response.data;
                        // console.log(error.response.data);
                    });
                // Aggiungi qui la logica per inviare il form o salvare i dati
                // Esempio: inviare dati con fetch o Ajax al server
                // fetch('/save-endpoint', { method: 'POST', body: new FormData(form) })
                //   .then(response => response.json())
                //   .then(data => console.log('Salvataggio automatico eseguito'))
                //   .catch(error => console.error('Errore:', error));
            });

            // Emetti l'evento di auto-save sul form
            form.dispatchEvent(autoSaveEvent);
        }

        // Esegui la funzione autoSave ogni 30 secondi
        setInterval(autoSave, 10000);
    </script>

@endif