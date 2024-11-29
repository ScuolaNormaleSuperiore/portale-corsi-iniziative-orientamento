<div class="row">


    @if (count($datiStep['sections']) > 1)
        <div class="col-12 col-lg-4">
            @include('candidature.includes.navleft',['sezioni' => $datiStep['sections']])
        </div>
        <div class="col-12 col-lg-8">

            @include('candidature.includes.step-errors')

            <p>I campi contraddistinti dal simbolo asterisco (*) sono obbligatori</p>

            @foreach ($datiStep['sections'] as $sectionData)
                @dump($sectionData)
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
