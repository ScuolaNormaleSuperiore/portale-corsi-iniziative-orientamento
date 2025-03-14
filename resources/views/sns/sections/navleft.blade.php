@php
    $sezioni = \Illuminate\Support\Arr::get($navleft,'sezioni',[]);
    $luogoEvento = \Illuminate\Support\Arr::get($navleft, 'luogo_evento');
    $dataNews = \Illuminate\Support\Arr::get($navleft, 'data_news');
    $dataEvento = \Illuminate\Support\Arr::get($navleft, 'data_evento');
    $orarioEvento = \Illuminate\Support\Arr::get($navleft, 'orario_evento');
    $dataFineEvento = \Illuminate\Support\Arr::get($navleft, 'data_fine_evento');
    $allegati = \Illuminate\Support\Arr::get($navleft, 'allegati', []);
    $navTitle = $navTitle ?? ((count($allegati) + count($sezioni) > 0) ? 'Contenuto' : '');
@endphp

<nav class="navbar it-navscroll-wrapper navbar-expand-lg it-bottom-navscroll it-left-side border-start-0"
     data-bs-navscroll>
    <div class="navbar-collapsable" id="navbarNav">
        <div class="overlay"></div>
        <div class="sidebar-wrapper">

                <div class="sidebar-linklist-wrapper ">
                    <div class="link-list-wrapper">
                        <h3>{{$navTitle}}</h3>
                        <ul class="link-list">

                            <li class="nav-item">
                                @foreach ($sezioni as $sezione)
                                    @if($sezione->nome_it)
                                    <a class="nav-link"
                                       href="#sezione_{{$loop->index}}"><span>{{$sezione->nome_it}}</span></a>
                                    @endif
                                @endforeach
                            </li>

                        </ul>
                    </div>
                </div>

            @if(count($allegati) > 0)
                <div class="sidebar-linklist-wrapper ">
                    <div class="link-list-wrapper">
                        <h3>Allegati</h3>
                        <ul class="link-list">
                            <li class="nav-item">
                                @foreach ($allegati as $allegato)
                                    <a class="nav-link"
                                       href="/{{$allegato->getUrl()}}">
                                        <svg class="icon icon-primary">
                                            <use href="{{Theme::url('svg/sprites.svg')}}#it-download"></use>
                                        </svg>
                                        <span>{{$allegato->nome}}</span>
                                    </a>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>


<div class="sidebar-wrapper d-sm-block d-xs-block d-md-block d-lg-none">

    @if(count($sezioni) > 0)

        <div class="sidebar-linklist-wrapper ">
            <div class="link-list-wrapper">
                <h3>Contenuto</h3>
                <ul class="link-list">

                    <li class="nav-item">
                        @foreach ($sezioni as $sezione)
                            <a class="nav-link"
                               href="#sezione_{{$loop->index}}"><span>{{$sezione->nome_it}}</span></a>
                        @endforeach
                    </li>

                </ul>
            </div>
        </div>
    @endif

    @if(count($allegati) > 0)
        <div class="sidebar-linklist-wrapper ">
            <div class="link-list-wrapper">
                <h3>Allegati</h3>
                <ul class="link-list">
                    <li class="nav-item">
                        @foreach ($allegati as $allegato)
                            <a class="nav-link"
                               href="/{{$allegato->getUrl()}}">
                                <svg class="icon icon-primary">
                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-download"></use>
                                </svg>
                                <span>{{$allegato->nome}}</span>
                            </a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>

