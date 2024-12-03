@php
    $sections = [];
    foreach ($steps as $nStep => $currStep) {
        if (!\Illuminate\Support\Arr::get($currStep,'riepilogo',false)) {
            continue;
        }
        $section = \Illuminate\Support\Arr::only($currStep,['title','code','sections']);
        $section['step'] = $nStep;
        $sections[] = $section;
    }
@endphp
<div class="row">

        <div class="col-12 col-lg-4">
            @include('candidature.includes.navleft',['sezioni' => $sections])
        </div>
        <div class="col-12 col-lg-8">

            @foreach ($sections as $sectionData)
{{--                @dump($sectionData)--}}
                <div class="" id="sezione_{{$sectionData['code']}}">
                    <div class="card no-after rounded mb-4" style="background-color:#EFF8FA;">
                        <div class="card-body">
                            <h3 class="card-title h3">{{$sectionData['title']}}</h3>
                            @foreach ($sectionData['sections'] as $subSection)
                                <div class="card rounded bg-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                        <h4 class="card-title h4 d-flex justify-content-between">
                                            <span>{{$subSection['title']}}</span>
                                        </h4>
                                            <span><a href="/candidatura/edit/{{$candidatura->getKey()}}/{{$sectionData['step']}}">Modifica</a></span>
                                        </div>
                                        <hr/>
                                        @include('candidature.sezioni_riepilogo.'.$subSection['code'],['datiStep' => $sectionData,'sectionData' => $subSection])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


</div>
