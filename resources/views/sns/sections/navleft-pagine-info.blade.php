@php
    $sezioni = \Illuminate\Support\Arr::get($navleftInfo,'pagine',[]);
@endphp

<nav class="navbar it-navscroll-wrapper navbar-expand-lg it-bottom-navscroll it-left-side border-start-0"
     data-bs-navscroll>
    <div class="navbar-collapsable" id="navbarNav">
        <div class="overlay"></div>
        <div class="sidebar-wrapper">

            @if(count($pagine) > 0)

                <div class="sidebar-linklist-wrapper ">
                    <div class="link-list-wrapper">
                        <h3>Indice dei contenuti</h3>
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
            @endif

        </div>
    </div>
</nav>
