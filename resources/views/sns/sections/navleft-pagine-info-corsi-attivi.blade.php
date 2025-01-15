{{--@php--}}
{{--    $sezioni = \Illuminate\Support\Arr::get($navleftInfo,'pagine',[]);--}}
{{--@endphp--}}

<nav class="navbar it-navscroll-wrapper navbar-expand-lg it-bottom-navscroll it-left-side border-start-0"
     data-bs-navscroll>
    <div class="navbar-collapsable" id="navbarNav">
        <div class="overlay"></div>
        <div class="sidebar-wrapper">


            <div class="sidebar-linklist-wrapper ">
                <div class="link-list-wrapper">
                    <h3>I corsi attivi</h3>
                    <ul class="link-list">
                        @foreach ($iniziative as $iniziativa)

                            @if(count($iniziativa->corsi) > 0)

                                <li class="nav-item">
                                    <span class="">{{$iniziativa->titolo}}</span>
                                    <ul class="link-sublist" id="collapseTwo">
                                        @foreach ($iniziativa->corsi as $corso)
                                            <li>
                                                <a class="list-item" href="/info-corso/{{$corso->getKey()}}">
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
                </div>
            </div>

        </div>
    </div>
</nav>
