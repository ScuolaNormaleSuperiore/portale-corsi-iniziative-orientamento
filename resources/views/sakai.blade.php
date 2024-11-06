<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-93461466-1"></script>--}}
{{--    <script>window.dataLayer = window.dataLayer || [];--}}

{{--        function gtag() {--}}
{{--            dataLayer.push(arguments);--}}
{{--        }--}}

{{--        gtag('js', new Date());--}}
{{--    </script>--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="/sakai-vue/favicon.ico">
    <title>Sakai Vue</title>
    <link id="theme-link" rel="stylesheet" href="/sakai-vue/themes/lara-light-indigo/theme.css">
    <link href="/sakai-vue/css/chunk-07dc2ca1.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-357c8d54.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-3a07ef1e.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-3cfcfa4a.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-576645dc.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-5cd8f9c1.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-5d29634a.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-6763c173.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-7dd32043.css" rel="prefetch">
    <link href="/sakai-vue/css/chunk-c5fe4c50.css" rel="prefetch">
    <link href="/sakai-vue/js/chunk-065ba332.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-07dc2ca1.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-0c601934.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0a4459.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0ab7e0.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0b66d7.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0b9063.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0ba880.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0bdce8.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0c1949.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0c4a74.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0cc0a5.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0cf131.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0d67ea.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0d6e85.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0d7a73.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0d9f47.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0daf02.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d0e5830.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d213562.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d213e5a.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d21a7b4.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d21e38c.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d224d2e.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d225664.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d2257c7.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d226192.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d2263c1.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d22bd51.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d22bf23.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d22d5b6.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2d238085.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-2f72ddba.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-357c8d54.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-3744da60.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-3782aa9f.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-3a07ef1e.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-3cfcfa4a.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-4163e010.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-576645dc.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-5cd8f9c1.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-5d29634a.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-6763c173.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-7dd32043.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-c5fe4c50.js" rel="prefetch">
    <link href="/sakai-vue/js/chunk-ef30cfc2.js" rel="prefetch">
    <link href="/sakai-vue/css/app.css" rel="preload" as="style">
    <link href="/sakai-vue/css/chunk-vendors.css" rel="preload" as="style">
    <link href="/sakai-vue/js/app.js" rel="preload" as="script">
    <link href="/sakai-vue/js/chunk-vendors.js" rel="preload" as="script">
    <link href="/sakai-vue/css/chunk-vendors.css" rel="stylesheet">
    <link href="/sakai-vue/css/app.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="preloader">
        <div class="preloader-content"></div>
    </div>
</div>
<script src="/sakai-vue/js/chunk-vendors.js"></script>
<script src="/sakai-vue/js/app.js"></script>
</body>
</html>
