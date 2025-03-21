@php
    $sezioni = \Illuminate\Support\Arr::get($navleftInfo,'pagine',[]);
@endphp

<nav class="navbar it-navscroll-wrapper navbar-expand-lg it-bottom-navscroll it-left-side border-start-0"
     data-bs-navscroll>
    <div class="navbar-collapsable" id="navbarNavInfo">
        <div class="overlay"></div>
        <div class="sidebar-wrapper">

            <div class="sidebar-linklist-wrapper ">
                <div class="link-list-wrapper">
                    <h3>Iniziative e corsi attivi</h3>
                    <ul class="link-list">
                        @foreach ($iniziative as $iniziativa)

                            @if(count($iniziativa->corsi) > 0)

                                <li class="nav-item">
                                    <span class="">{{$iniziativa->titolo}}</span>
                                    <ul class="link-sublist">
                                        @foreach ($iniziativa->corsi as $corso)
                                            <li>
                                                <a class="list-item" href="/info-corso/{{$corso->slug_it}}">
                                                    <span>
                                                        {{$corso->titolo}}
                                                    </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                            @endif
                        @endforeach
                    </ul>
                    <h3>Informazioni utili</h3>
                    <ul class="link-list">

                        <li class="nav-item">
                            @foreach ($pagine as $currPagina)
                                <a class="nav-link"
                                   href="/info-corsi/{{$currPagina->slug_it}}"><span>{{$currPagina->titolo_it}}</span></a>
                            @endforeach
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>

<div class="sidebar-wrapper d-sm-block d-xs-block d-md-block d-lg-none">


    <div class="sidebar-linklist-wrapper ">
        <div class="link-list-wrapper">
            <h3>Iniziative e corsi attivi</h3>
            <ul class="link-list">
                @foreach ($iniziative as $iniziativa)

                    @if(count($iniziativa->corsi) > 0)

                        <li class="nav-item">
                            <span class="">{{$iniziativa->titolo}}</span>
                            <ul class="link-sublist">
                                @foreach ($iniziativa->corsi as $corso)
                                    <li>
                                        <a class="list-item" href="/info-corso/{{$corso->slug_it}}">
                                                    <span>
                                                        {{$corso->titolo}}
                                                    </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    @endif
                @endforeach
            </ul>
            <h3>Informazioni utili</h3>
            <ul class="link-list">

                <li class="nav-item">
                    @foreach ($pagine as $currPagina)
                        <a class="nav-link"
                           href="/info-corsi/{{$currPagina->slug_it}}"><span>{{$currPagina->titolo_it}}</span></a>
                    @endforeach
                </li>

            </ul>
        </div>
    </div>
</div>
