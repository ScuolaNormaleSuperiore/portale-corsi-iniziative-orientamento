<head>
    <meta charset="UTF-8">
    <title>SNS - Orientamenti</title>
    <meta name="description" content="...">

    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    {!! \Igaster\LaravelTheme\Facades\Theme::css('css/bootstrap-italia.min.css') !!}
    <link media="all" type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@3.0.1/dist/cookieconsent.css">

    @include('includes/fonts')
    <!-- favicon -->
    <link rel="shortcut icon" href="{!! \Igaster\LaravelTheme\Facades\Theme::url('favicon.ico') !!}">

    <style>
        .card-body.card-orientamento,
        .card.card-orientamento,
        .card-orientamento {
            background: url('{!! \Igaster\LaravelTheme\Facades\Theme::url('images/card-1x.png') !!}') no-repeat right bottom;
            height: 128px;
        }
    </style>
</head>
