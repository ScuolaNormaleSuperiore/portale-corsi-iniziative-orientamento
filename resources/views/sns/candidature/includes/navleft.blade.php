<nav class="navbar it-navscroll-wrapper navbar-expand-lg it-bottom-navscroll it-left-side border-start-0"
     data-bs-navscroll>
    <div class="navbar-collapsable" id="navbarNav">
        <div class="overlay"></div>
        <div class="sidebar-wrapper">

            @if(count($sezioni) > 0)

                <div class="sidebar-linklist-wrapper ">
                    <div class="link-list-wrapper">
                        <h3>Informazioni richieste</h3>
                        <ul class="link-list">

                            <li class="nav-item">
                                @foreach ($sezioni as $sezione)
                                    <a class="nav-link"
                                       href="#sezione_{{$sezione['code']}}"><span>{{$sezione['title']}}</span></a>
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
                <h3>Informazioni richieste</h3>
                <ul class="link-list">

                    <li class="nav-item">
                        @foreach ($sezioni as $sezione)
                            <a class="nav-link"
                               href="#sezione_{{$sezione['code']}}"><span>{{$sezione['title']}}</span></a>
                        @endforeach
                    </li>

                </ul>
            </div>
        </div>
    @endif

</div>

