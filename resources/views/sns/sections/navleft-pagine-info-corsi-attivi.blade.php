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
                    @foreach ($iniziative as $iniziativa)


                        <ul class="link-list">

                            <li class="nav-item">
                                <span class=""><strong>{{$iniziativa->titolo}}</strong></span>
                                @foreach ($iniziativa->corsi as $corso)
                                    <a class="nav-link"
                                       href="/info-corso/{{$corso->getKey()}}"><span>{{$corso->titolo}}</span></a>
                                @endforeach
                            </li>


                        </ul>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</nav>
