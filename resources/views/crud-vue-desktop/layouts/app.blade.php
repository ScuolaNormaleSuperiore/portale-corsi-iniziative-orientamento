
<!DOCTYPE html>
<html lang="en">
    @include('includes.head')
<body>
    @yield('content')
</body>

    <!-- configurazione modelli -->
{{--    @foreach (Cupparis::get('modelconfs.files',[]) as $modelConf)--}}
{{--        {!! Theme::js(Cupparis::get('modelconfs.rootJsDir','ModelConfs').'/'.$modelConf)  !!}--}}
{{--    @endforeach--}}

    {!! Theme::js('CsvConfs.js')  !!}

    @yield('extra_scripts')

    {!!  Theme::css('dist/css/tailwind.css') !!}
    {!!  Theme::css('dist/css/app.css') !!}
    {!!  Theme::css('dist/css/chunk-vendors.css') !!}

    {!!  Theme::js('dist/js/app.js') !!}
    {!!  Theme::js('dist/js/chunk-vendors.js') !!}

</html>
