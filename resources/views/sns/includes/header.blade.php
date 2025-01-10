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


                            @if (auth()->user())

                            <div class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle btn btn-icon" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true" data-focus-mouse="false">
                                    <span class="visually-hidden">Utente collegato:</span>
                                    <span class="rounded-icon">
                                                    <svg alt="auth()->user()->fename" class="icon icon-primary"><use href="{{Theme::url('svg/sprites.svg')}}#it-user"></use></svg>
                                              </span>

                                    <span class="txt_username text-uppercase">{{auth()->user()->fename}}</span>


                                    <svg class="icon">
                                        <use href="{{Theme::url('svg/sprites.svg')}}#it-expand"></use>
                                    </svg>

                                </button>
                                                                <div class="dropdown-menu">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="link-list-wrapper">
                                                                                <ul class="link-list">
                                                                                    @if(auth_is_admin())
                                                                                    <li><a class="dropdown-item list-item" href="/dashboard#">
                                                                                        <span class="rounded-icon">
                                                    <svg alt="auth()->user()->fename" class="icon icon-primary"><use href="{{Theme::url('svg/sprites.svg')}}#it-key"></use></svg>
                                              </span>
                                                                                            <span>Area riservata</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    @endif
                                                                                    <li><a class="dropdown-item list-item" href="/logout">
                                                                                            <span class="rounded-icon">
                                                    <svg alt="auth()->user()->fename" class="icon icon-primary"><use href="{{Theme::url('svg/sprites.svg')}}#it-logout"></use></svg>
                                              </span>
                                                                                            <span>Esci</span></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

{{--                                <div class="dropdown-menu" style="">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-12">--}}
{{--                                            <div class="link-list-wrapper">--}}
{{--                                                <ul class="link-list">--}}
{{--                                                    <li role="none presentation">--}}
{{--                                                        <a class="a-js-hide-action" href="/rwe2/user_console.jsp?ELANG=it&amp;IATL=it"><svg class="svg-inline--fa fa-star fa-fw" aria-hidden="true" focusable="false" data-prefix="far" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"></path></svg><!-- <span class="fa fa-star-o fa-fw"></span> Font Awesome fontawesome.com -->Le mie richieste</a>--}}
{{--                                                    </li>--}}

{{--                                                    <li class="d-none d-sd-flex">--}}
{{--                                                        <ul>--}}
{{--                                                            <li>--}}
{{--                                                                <a class="a-js-hide-action" href="/rwe2/user_faq_list.jsp?&amp;NEW=true&amp;ELANG=it&amp;IATL=it"><svg class="svg-inline--fa fa-comment fa-lg fa-fw" aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 32C114.6 32 .0272 125.1 .0272 240c0 47.63 19.91 91.25 52.91 126.2c-14.88 39.5-45.87 72.88-46.37 73.25c-6.625 7-8.375 17.25-4.625 26C5.818 474.2 14.38 480 24 480c61.5 0 109.1-25.75 139.1-46.25C191.1 442.8 223.3 448 256 448c141.4 0 255.1-93.13 255.1-208S397.4 32 256 32zM256.1 400c-26.75 0-53.12-4.125-78.38-12.12l-22.75-7.125l-19.5 13.75c-14.25 10.12-33.88 21.38-57.5 29c7.375-12.12 14.37-25.75 19.88-40.25l10.62-28l-20.62-21.87C69.82 314.1 48.07 282.2 48.07 240c0-88.25 93.25-160 208-160s208 71.75 208 160S370.8 400 256.1 400z"></path></svg><!-- <span class="fa fa-comment-o fa-lg fa-fw"></span> Font Awesome fontawesome.com -->hai bisogno di aiuto?</a>--}}
{{--                                                            </li>--}}

{{--                                                        </ul>--}}
{{--                                                    </li>--}}
{{--                                                    <li role="none presentation">--}}
{{--                                                        <a class="a-js-hide-action" href="/rwe2/user_changepassword.jsp?ELANG=it&amp;IATL=it"><svg class="svg-inline--fa fa-key fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="key" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z"></path></svg><!-- <span class="fa fa-key fa-fw"></span> Font Awesome fontawesome.com -->Modifica password</a>--}}
{{--                                                    </li>--}}
{{--                                                    <li role="none presentation">--}}
{{--                                                        <a href="https://docs.elixforms.it/elixDocs/user_console.jsp" target="_blank"><svg class="svg-inline--fa fa-circle-question fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-question" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 400c-18 0-32-14-32-32s13.1-32 32-32c17.1 0 32 14 32 32S273.1 400 256 400zM325.1 258L280 286V288c0 13-11 24-24 24S232 301 232 288V272c0-8 4-16 12-21l57-34C308 213 312 206 312 198C312 186 301.1 176 289.1 176h-51.1C225.1 176 216 186 216 198c0 13-11 24-24 24s-24-11-24-24C168 159 199 128 237.1 128h51.1C329 128 360 159 360 198C360 222 347 245 325.1 258z"></path></svg><!-- <span class="fa fa-question-circle fa-fw"></span> Font Awesome fontawesome.com -->Consulta il manuale</a>--}}
{{--                                                    </li>--}}
{{--                                                    <li role="none presentation">--}}
{{--                                                        <a class="a-js-hide-action" href="/rwe2/user_deleteaccount.jsp?&amp;ELANG=it&amp;IATL=it"><svg class="svg-inline--fa fa-user-xmark fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM577.9 223.1l47.03-47.03c9.375-9.375 9.375-24.56 0-33.94s-24.56-9.375-33.94 0L544 190.1l-47.03-47.03c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l47.03 47.03l-47.03 47.03c-9.375 9.375-9.375 24.56 0 33.94c9.373 9.373 24.56 9.381 33.94 0L544 257.9l47.03 47.03c9.373 9.373 24.56 9.381 33.94 0c9.375-9.375 9.375-24.56 0-33.94L577.9 223.1z"></path></svg><!-- <span class="fa fa-user-times fa-fw"></span> Font Awesome fontawesome.com -->Elimina utente</a>--}}
{{--                                                    </li>--}}
{{--                                                    <li role="none presentation">--}}
{{--                                                        <a class="a-js-hide-action" href="/rwe2/logout.jsp"><svg class="svg-inline--fa fa-power-off fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="power-off" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M288 256C288 273.7 273.7 288 256 288C238.3 288 224 273.7 224 256V32C224 14.33 238.3 0 256 0C273.7 0 288 14.33 288 32V256zM80 256C80 353.2 158.8 432 256 432C353.2 432 432 353.2 432 256C432 201.6 407.3 152.9 368.5 120.6C354.9 109.3 353 89.13 364.3 75.54C375.6 61.95 395.8 60.1 409.4 71.4C462.2 115.4 496 181.8 496 255.1C496 388.5 388.5 496 256 496C123.5 496 16 388.5 16 255.1C16 181.8 49.75 115.4 102.6 71.4C116.2 60.1 136.4 61.95 147.7 75.54C158.1 89.13 157.1 109.3 143.5 120.6C104.7 152.9 80 201.6 80 256z"></path></svg><!-- <span class="fa fa-power-off fa-fw"></span> Font Awesome fontawesome.com -->Esci</a>--}}
{{--                                                    </li>--}}

{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>

                                @else



                            <a href="/login" class="btn btn-primary btn-icon btn-full">
              <span class="rounded-icon">
                <svg class="icon icon-primary">
                  <use href="{{Theme::url('svg/sprites.svg')}}#it-user"></use>
                </svg>
              </span>
                                <span class="d-none d-lg-block">Accedi all'area personale</span>
                            </a>
                            @endif

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

                                    <img class="icon" src="{{Theme::url('svg/logo-primary.svg')}}"
                                         alt="SNS orientamenti"/>

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
                                                <a class="nav-link" href="/orientamento"
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
                                            <li class="nav-item">
                                                <a class="nav-link" href="/info-corsi"
                                                   data-element="all-services">
                                                    <span>Info sui corsi</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/candidature"
                                                   data-element="all-services">
                                                    <span>Per candidarsi</span>
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
                                                <a class="nav-link" href="/sportello-studenti">Sportello da Studente a
                                                    Studente</a>
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
