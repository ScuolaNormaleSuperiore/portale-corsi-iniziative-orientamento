<!-- Header -->
<header id="header" class="it-header-wrapper" data-bs-target="#header-nav-wrapper">

    <!-- TOP HEADER -->
    <div class="it-header-slim-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="d-lg-block navbar-brand" href="/">Scuola Normale Superiore</a>
                        <div class="it-header-slim-right-zone">
                            <div class="nav-item dropdown">
{{--                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"--}}
{{--                                   aria-expanded="false">--}}
{{--                                    <span class="visually-hidden">Selezione lingua: lingua selezionata</span>--}}
{{--                                    <span>ITA</span>--}}
{{--                                    <svg class="icon d-none d-lg-block">--}}
{{--                                        <use href="{{Theme::url('svg/sprites.svg')}}#it-expand"></use>--}}
{{--                                    </svg>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-12">--}}
{{--                                            <div class="link-list-wrapper">--}}
{{--                                                <ul class="link-list">--}}
{{--                                                    <li><a class="dropdown-item list-item" href="#"><span>ITA <span--}}
{{--                                                                        class="visually-hidden">selezionata</span></span></a>--}}
{{--                                                    </li>--}}
{{--                                                    <li><a class="dropdown-item list-item" href="#"><span>ENG</span></a>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <a href="/login" class="btn btn-primary btn-icon btn-full">
              <span class="rounded-icon">
                <svg class="icon icon-primary">
                  <use href="{{Theme::url('svg/sprites.svg')}}#it-user"></use>
                </svg>
              </span>
                                <span class="d-none d-lg-block">Accedi all'area personale</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="it-nav-wrapper">

        <!-- HEADER CENTRALE -->
        <div class="it-header-center-wrapper theme-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <div class="it-brand-wrapper">
                                <a href="/">

                                    <img class="icon" src="{{Theme::url('svg/logo-primary.svg')}}" alt="SNS orientamenti"/>

                                    {{--                                <svg class="icon" aria-hidden="true">--}}
                                    {{--                                    --}}
                                    {{--                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-pa"></use>--}}
                                    {{--                                </svg>--}}
                                    <div class="it-brand-text">
                                        <div class="it-brand-title">OrientaMenti</div>
                                        <div class="it-brand-tagline d-none d-md-block">Corsi di orientamento della
                                            Scuola Normale Superiore
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="it-right-zone">
                                <div class="it-socials d-none d-md-flex">
                                    <span>Seguici su</span>
                                    <ul>
                                        <li>
                                            <a href="#" aria-label="Facebook" target="_blank">
                                                <svg class="icon">
                                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" aria-label="Instagram" target="_blank">
                                                <svg class="icon">
                                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-instagram"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" aria-label="Twitter" target="_blank">
                                                <svg class="icon">
                                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
{{--                                <div class="it-search-wrapper">--}}
{{--                                    <span class="d-none d-md-block">Cerca</span>--}}
{{--                                    <a class="search-link rounded-icon" aria-label="Cerca nel sito" href="#">--}}
{{--                                        <svg class="icon">--}}
{{--                                            <use href="{{Theme::url('svg/sprites.svg')}}#it-search"></use>--}}
{{--                                        </svg>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENU -->
        <div class="it-header-navbar-wrapper theme-light-desk" id="header-nav-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!--start nav-->
                        <div class="navbar navbar-expand-lg has-megamenu bg-none">
                            <button class="custom-navbar-toggler" type="button" aria-controls="nav4"
                                    aria-expanded="false" aria-label="Mostra/Nascondi la navigazione"
                                    data-bs-target="#nav4" data-bs-toggle="navbarcollapsible">
                                <svg class="icon">
                                    <use href="{{Theme::url('svg/sprites.svg')}}#it-burger"></use>
                                </svg>
                            </button>
                            <div class="navbar-collapsable" id="nav4">
                                <div class="overlay" style="display: none;"></div>
                                <div class="close-div">
                                    <button class="btn close-menu" type="button">
                                        <span class="visually-hidden">Nascondi la navigazione</span>
                                        <svg class="icon">
                                            <use href="{{Theme::url('svg/sprites.svg')}}#it-close-big"></use>
                                        </svg>
                                    </button>
                                </div>
                                <div class="menu-wrapper">
                                    <a href="#" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true">
                                            <use href="{{Theme::url('svg/logo.svg')}}"></use>
                                        </svg>
                                        <div class="it-brand-text">
                                            <div class="it-brand-title">OrientaMenti</div>
                                        </div>
                                    </a>
                                    <nav aria-label="Principale">
                                        <ul class="navbar-nav navbar-secondary" data-element="main-navigation">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"
                                                   data-element="management">
                                                    Orientamento
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/archivio-news" data-element="news">
                                                    <span>Notizie</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/archivio-eventi"
                                                   data-element="all-services">
                                                    <span>Eventi</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <nav aria-label="Secondaria">
                                        <ul class="navbar-nav navbar-secondary">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Parla con noi</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/sportello-studenti">Sportello da Studente a Studente</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="it-socials">
                                        <span>Seguici su</span>
                                        <ul>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="{{Theme::url('svg/sprites.svg')}}#it-facebook"></use>
                                                    </svg>
                                                    <span class="visually-hidden">Facebook</span></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="{{Theme::url('svg/sprites.svg')}}#it-instagram"></use>
                                                    </svg>
                                                    <span class="visually-hidden">Instagram</span></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="{{Theme::url('svg/sprites.svg')}}#it-twitter"></use>
                                                    </svg>
                                                    <span class="visually-hidden">Twitter</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<!-- /Header -->
