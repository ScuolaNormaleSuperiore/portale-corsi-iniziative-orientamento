<head>
    <meta charset="utf-8">


    <title>Tailwind Desktop</title>

    <meta name="description" content="Freebie 45 - Windows 11 (Tailwind) by pixelcave. Check out more at https://pixelcave.com">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicons -->

</head>


<head>
    <meta charset="UTF-8">
    <title>{!! Config::get('app.name') !!}</title>
    <meta name="description" content="{!! Config::get('app.name') !!}">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,shrink-to-fit=no">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="robots" content="noindex, nofollow">


    <meta name="crud.translations" content="{{Theme::url('it-translations.json')}}">
    <meta name="crud.env-file" content="{{Theme::url('env.json')}}">
    <meta name="crud.init" content="appInit">
    <!--
    <meta name="crud.routes" content="/crud-smarty3/routes.json">
    <meta name="crud.actions" content="/crud-smarty3/actions.json">
    -->

    <meta name="crud.env.apiKey" content="{{env('GOOGLE_MAP_KEY')}}">
{{--    <meta name="crud.env.layoutGradientColor" content="{{$layoutGradientColor}}">--}}
    <meta name="crud.env.newsPageId" content="{{env('NEWS_PAGE_ID')}}">
{{--    <meta name="crud.env.dashboardType" content="{{$dashboardType}}">--}}
{{--    <meta name="crud.env.appMenu" content='{!! json_encode($cupparisMenus)  !!}'>--}}
    <meta name="crud.env.themePath" content='{{Theme::url('')}}'>


{{--    <meta name="crud.env.mainPage" content="dashboard">--}}

    <!-- up to 10% speed up for external res -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <!-- preloading icon font is helping to speed up a little bit -->
    <link rel="preload" href="{!! Theme::url('assets/fonts/flaticon/Flaticon.woff2') !!}" as="font" type="font/woff2" crossorigin>

    <!-- non block rendering : page speed : js = polyfill for old browsers missing `preload` -->
{{--    <link rel="stylesheet" href="{!! Theme::url('assets/css/core.css') !!}">--}}
{{--    <link rel="stylesheet" href="{!! Theme::url('assets/css/vendor_bundle.min.css') !!}">--}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap">

    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="{!! Theme::url('images/logopic2.png') !!}">

{{--    <link rel="manifest" href="{!! Theme::url('assets/images/manifest/manifest.json') !!}">--}}
    <meta name="theme-color" content="#377dff">

    <!-- CUPPARIS -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{Theme::url('img/icons/desktop.png')}}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{Theme::url('build/tailkit.css')}}">

    <!-- Alpine.js -->
{{--    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>--}}

    {{-- Gestione Grafici --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.0/mapbox-gl.css' rel='stylesheet' />

{{--    <script src='/abruzzo/js/LuoghiSensibili.js'></script>--}}
{{--    <script src='/abruzzo/js/GestioneMappa.js'></script>--}}
{{--    <script src='/admin/ModelConfs/schema_colori.js'></script>--}}
{{--    <script src='/abruzzo/js/GestioneGrafici.js'></script>--}}
    <script src="{{Theme::url('appInit.js')}}"></script>
    {!!  Theme::js('dist/js/alpine.js') !!}

{{--    <script src="https://unpkg.com/http-vue-loader@1.4.2/src/httpVueLoader.js"></script>--}}
</head>


