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

                        @foreach ($corsi as $corso)
                            <li>
                                <a class="list-item" href="/info-corso/{{$corso->slug_it}}">
                                                    <span>
                                                        {{$corso->titolo}}
                                                    </span>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>
