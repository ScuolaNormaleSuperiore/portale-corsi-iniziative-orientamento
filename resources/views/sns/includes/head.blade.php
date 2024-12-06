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

        .form-group-candidature {
            padding-bottom:20px;
            border-bottom: 1px solid #ccd4de;
            margin-bottom:30px;
            /*padding-top:5px;*/
        }

        .form-group-candidature.last {
            padding-bottom:0;
            border-bottom: none;
            margin-bottom:0;
            /*padding-top:5px;*/
        }

        .form-group-candidature.inTable {
            padding-bottom:5px;
            border-bottom: none;
            margin-bottom:5px;
            margin-top:10px;
        }

        .input-group-candidature {
            margin-top:10px;
            /*padding-top:5px;*/
        }
        .input-group-candidature .input-group-text {
            border: 1px solid #5d7083;
            border-radius: 4px;
            border-right: 0;
        }

        .input-group-candidature input {
            border: 1px solid #5d7083;
            border-radius: 4px;
            border-left: 0;

        }

        .input-group-candidature-voti {
            /*margin-top:10px;*/
            /*padding-top:5px;*/
        }
        .form-group-candidature textarea,
        .input-group-candidature-voti input {
            border: 1px solid #5d7083;
            border-radius: 4px;
        }

        .input-group-candidature label.active {
            padding-bottom: 5px;
            margin-left: -35px !important;
        }


        .form-group-candidature select,
        .form-group-candidature-voti select {
            border: 1px solid #5d7083;
            border-radius: 4px;
            color: #5d7083;
            font-weight:normal;

        }

        .form-group-candidature.select-wrapper label {
            padding-bottom: 5px;
        }

        .form-group-candidature select option {
            color: #5d7083;

        }

        #scuolaAutocomplete {
            border: 1px solid #5d7083;
            border-radius: 4px;
            color: #5d7083;
            font-weight:normal;
        }

        p.riepilogo-value {
            font-weight: 600;
        }
    </style>
</head>
