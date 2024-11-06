<nav class="navbar it-navscroll-wrapper navbar-expand-lg it-bottom-navscroll it-left-side border-start-0" data-bs-navscroll>
    <div class="navbar-collapsable" id="navbarNav">
        <div class="overlay"></div>
        <div class="menu-wrapper">
            <div class="link-list-wrapper">
                <h3>{{\Illuminate\Support\Arr::get($navleft,'title','Contenuto')}}</h3>
                <ul class="link-list">
                    <li class="nav-item">
                        @foreach (\Illuminate\Support\Arr::get($navleft,'sezioni',[]) as $sezione)
                            <a class="nav-link @if($loop->first) active @endif" href="#"><span>{{$sezione->nome_it}}</span></a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>