<!-- Header -->
<header id="header" class="container position-relative">

    <div class="mx-3 px-3 mt-4 row-pill position-absolute bg-white rounded left-0 right-0 shadow-xlg">

        <!--
            TOP BAR NOTE
            add .bg-secondary if #top_bar used
        -->


        <!-- Navbar -->
        <div class="position-relative">


            <nav class="navbar navbar-expand-lg navbar-light justify-content-lg-between justify-content-md-inherit">

                <div class="align-items-start">

                    <!-- mobile menu button : show -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMainNav" aria-controls="navbarMainNav" aria-expanded="false" aria-label="Toggle navigation">
                        <svg width="25" viewBox="0 0 20 20">
                            <path d="M 19.9876 1.998 L -0.0108 1.998 L -0.0108 -0.0019 L 19.9876 -0.0019 L 19.9876 1.998 Z"></path>
                            <path d="M 19.9876 7.9979 L -0.0108 7.9979 L -0.0108 5.9979 L 19.9876 5.9979 L 19.9876 7.9979 Z"></path>
                            <path d="M 19.9876 13.9977 L -0.0108 13.9977 L -0.0108 11.9978 L 19.9876 11.9978 L 19.9876 13.9977 Z"></path>
                            <path d="M 19.9876 19.9976 L -0.0108 19.9976 L -0.0108 17.9976 L 19.9876 17.9976 L 19.9876 19.9976 Z"></path>
                        </svg>
                    </button>

                    <!--
                        Logo : height: 70px max
                    -->
                    <a class="navbar-brand" href="/">

                        <img src="{{ Theme::url('assets/images/logo/logo_dark.svg') }}" width="110" height="38" alt="...">
                    </a>

                </div>




                <!-- Menu -->
                <!--

                    Dropdown Classes (should be added to primary .dropdown-menu only, dropdown childs are also affected)
                        .dropdown-menu-dark 		- dark dropdown (desktop only, will be white on mobile)
                        .dropdown-menu-hover 		- open on hover
                        .dropdown-menu-clean 		- no background color on hover
                        .dropdown-menu-invert 		- open dropdown in oposite direction (left|right, according to RTL|LTR)
                        .dropdown-menu-uppercase 	- uppercase text (font-size is scalled down to 13px)
                        .dropdown-click-ignore 		- keep dropdown open on inside click (useful on forms inside dropdown)

                        Repositioning long dropdown childs (Example: Pages->Account)
                            .dropdown-menu-up-n100 		- open up with top: -100px
                            .dropdown-menu-up-n100 		- open up with top: -150px
                            .dropdown-menu-up-n180 		- open up with top: -180px
                            .dropdown-menu-up-n220 		- open up with top: -220px
                            .dropdown-menu-up-n250 		- open up with top: -250px
                            .dropdown-menu-up 			- open up without negative class


                        Dropdown prefix icon (optional, if enabled in variables.scss)
                            .prefix-link-icon .prefix-icon-dot 		- link prefix
                            .prefix-link-icon .prefix-icon-line 	- link prefix
                            .prefix-link-icon .prefix-icon-ico 		- link prefix
                            .prefix-link-icon .prefix-icon-arrow 	- link prefix

                        .nav-link.nav-link-caret-hide 	- no dropdown icon indicator on main link
                        .nav-item.dropdown-mega 		- required ONLY on fullwidth mega menu

                        Mobile animation - add to .navbar-collapse:
                        .navbar-animate-fadein
                    .navbar-animate-fadeinup
                        .navbar-animate-bouncein

                -->
{{--                <div class="collapse navbar-collapse navbar-animate-fadein" id="navbarMainNav">--}}


{{--                    <!-- navbar : mobile menu -->--}}
{{--                    <div class="navbar-xs d-none"><!-- .sticky-top -->--}}

{{--                        <!-- mobile menu button : close -->--}}
{{--                        <button class="navbar-toggler pt-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMainNav" aria-controls="navbarMainNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                            <svg width="20" viewBox="0 0 20 20">--}}
{{--                                <path d="M 20.7895 0.977 L 19.3752 -0.4364 L 10.081 8.8522 L 0.7869 -0.4364 L -0.6274 0.977 L 8.6668 10.2656 L -0.6274 19.5542 L 0.7869 20.9676 L 10.081 11.679 L 19.3752 20.9676 L 20.7895 19.5542 L 11.4953 10.2656 L 20.7895 0.977 Z"></path>--}}
{{--                            </svg>--}}
{{--                        </button>--}}

{{--                        <!----}}
{{--                            Mobile Menu Logo--}}
{{--                            Logo : height: 70px max--}}
{{--                        -->--}}
{{--                        <a class="navbar-brand" href="index.html">--}}
{{--                            <img src="assets/images/logo/logo_dark.svg" width="110" height="38" alt="...">--}}
{{--                        </a>--}}

{{--                    </div>--}}
{{--                    <!-- /navbar : mobile menu -->--}}



{{--                    <!-- navbar : navigation -->--}}
{{--                    <ul class="navbar-nav">--}}

{{--                        <!-- mobile only image + simple search (d-block d-sm-none) -->--}}
{{--                        <li class="nav-item d-block d-sm-none">--}}

{{--                            <!-- image -->--}}
{{--                            <div class="mb-4">--}}
{{--                                <img width="600" height="600" class="img-fluid" src="demo.files/svg/artworks/people_crossbrowser.svg" alt="...">--}}
{{--                            </div>--}}

{{--                            <!-- search -->--}}
{{--                            <form method="get" action="#!search" class="input-group-over mb-4 bg-light p-2 form-control-pill">--}}
{{--                                <input type="text" name="keyword" value="" placeholder="Quick search..." class="form-control border-dashed">--}}
{{--                                <button class="btn btn-sm fi fi-search mx-3"></button>--}}
{{--                            </form>--}}

{{--                        </li>--}}


{{--                        <!-- Hosting -->--}}
{{--                        <li class="nav-item dropdown">--}}

{{--                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mainNavHosting">--}}
{{--                                Hosting--}}
{{--                            </a>--}}

{{--                            <ul class="prefix-link-icon prefix-icon-dot dropdown-menu dropdown-menu-clean dropdown-menu-hover" aria-labelledby="mainNavHosting">--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Web Hosting</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Wordpress Pro Hosting</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Magento Pro Hosting</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">eCart Pro Hosting</a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}

{{--                        </li>--}}


{{--                        <!-- Domains -->--}}
{{--                        <li class="nav-item dropdown">--}}

{{--                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mainNavDomains">--}}
{{--                                Domains--}}
{{--                            </a>--}}

{{--                            <ul class="prefix-link-icon prefix-icon-dot dropdown-menu dropdown-menu-clean dropdown-menu-hover" aria-labelledby="mainNavDomains">--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Domain name search</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Domain name transfer</a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}

{{--                        </li>--}}



{{--                        <!-- SSL -->--}}
{{--                        <li class="nav-item dropdown">--}}

{{--                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mainNavSSL">--}}
{{--                                SSL--}}
{{--                            </a>--}}

{{--                            <ul class="prefix-link-icon prefix-icon-dot dropdown-menu dropdown-menu-clean dropdown-menu-hover" aria-labelledby="mainNavSSL">--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Domain validation SSL</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Business validation SSL</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Extended validation SSL</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Wildcard SSL Certificates</a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}

{{--                        </li>--}}



{{--                        <!-- Servers -->--}}
{{--                        <li class="nav-item dropdown">--}}

{{--                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mainNavServers">--}}
{{--                                Servers--}}
{{--                            </a>--}}

{{--                            <ul class="prefix-link-icon prefix-icon-dot dropdown-menu dropdown-menu-clean dropdown-menu-hover" aria-labelledby="mainNavServers">--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Managed VPS with cPanel</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Self Managed</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Bare metal</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Colocation</a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}

{{--                        </li>--}}



{{--                        <!-- Reseller -->--}}
{{--                        <li class="nav-item dropdown">--}}

{{--                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mainNavReseller">--}}
{{--                                Reseller--}}
{{--                            </a>--}}

{{--                            <ul class="prefix-link-icon prefix-icon-dot dropdown-menu dropdown-menu-clean dropdown-menu-hover" aria-labelledby="mainNavReseller">--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Reseller Hosting</a>--}}
{{--                                </li>--}}

{{--                                <li class="dropdown-item">--}}
{{--                                    <a class="dropdown-link" href="#">Reseller Cloud</a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}

{{--                        </li>--}}



{{--                        <!-- Contact -->--}}
{{--                        <li class="nav-item">--}}

{{--                            <a href="#" class="nav-link">--}}
{{--                                Contact--}}
{{--                            </a>--}}

{{--                        </li>--}}


{{--                        <!-- social icons : mobile only -->--}}
{{--                        <li class="nav-item d-block d-sm-none text-center mb-4">--}}

{{--                            <h3 class="h6 text-muted">Follow Us</h3>--}}

{{--                            <a href="#" class="btn btn-sm btn-facebook transition-hover-top mb-2 rounded-circle text-white" rel="noopener">--}}
{{--                                <i class="fi fi-social-facebook"></i>--}}
{{--                            </a>--}}

{{--                            <a href="#" class="btn btn-sm btn-twitter transition-hover-top mb-2 rounded-circle text-white" rel="noopener">--}}
{{--                                <i class="fi fi-social-twitter"></i>--}}
{{--                            </a>--}}

{{--                            <a href="#" class="btn btn-sm btn-linkedin transition-hover-top mb-2 rounded-circle text-white" rel="noopener">--}}
{{--                                <i class="fi fi-social-linkedin"></i>--}}
{{--                            </a>--}}

{{--                            <a href="#" class="btn btn-sm btn-youtube transition-hover-top mb-2 rounded-circle text-white" rel="noopener">--}}
{{--                                <i class="fi fi-social-youtube"></i>--}}
{{--                            </a>--}}

{{--                        </li>--}}



{{--                        <!-- Get Smarty : mobile only (d-block d-sm-none)-->--}}
{{--                        <li class="nav-item d-block d-sm-none">--}}
{{--                            <a target="_blank" href="https://wrapbootstrap.com/theme/smarty-website-admin-rtl-WB02DSN1B" class="btn w-100 btn-primary shadow-none text-white m-0">--}}
{{--                                Get Smarty--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                    </ul>--}}
{{--                    <!-- /navbar : navigation -->--}}


{{--                </div>--}}





                <!-- OPTIONS -->
                <ul class="list-inline list-unstyled mb-0 d-flex align-items-end">

                    <li class="list-inline-item float-start">
                        <a href="#" class="btn btn-sm btn-primary btn-pill transition-hover-start m-0">

                            <i class="fi fi-users m-0-xs"></i>

                            <!-- hide text on mobile, keep the icon (space issue reason) -->
                            <span class="d-none d-lg-inline-block">My Account</span>
                        </a>
                    </li>

                </ul>
                <!-- /OPTIONS -->



            </nav>

        </div>
        <!-- /Navbar -->

    </div>
</header>
<!-- /Header -->
