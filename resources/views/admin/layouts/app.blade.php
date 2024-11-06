<!DOCTYPE html>
<html>
@include("includes.head")

<!--
    Sticky/Reveal are not supported by this layout!
    ****************************************************************************************************
        .layout-admin + .aside-focus + .layout-padded
    ****************************************************************************************************
-->
<body class="layout-admin aside-sticky layout-padded">
    <div id="wrapper" class="d-flex align-items-stretch flex-column">
        @include('includes.header')
        <div id="wrapper_content" class="d-flex flex-fill">
        @include('includes.sidebar')

        <!-- MIDDLE -->
            <div id="middle" class="flex-fill">
                @yield('content')
            </div>
            <!-- /MIDDLE -->
        </div>
        @include('includes.footer')
    </div>
    <!-- configurazione modelli -->
    @foreach (Cupparis::get('modelconfs.files',[]) as $modelConf)
        {!! Theme::js(Cupparis::get('modelconfs.rootJsDir','ModelConfs').'/'.$modelConf)  !!}
    @endforeach

    {!! Theme::js('CsvConfs.js')  !!}

    @yield('extra_scripts')

{{--    <script type="text/javascript" src="/crud-vue-smarty3/assets/js/core.min.js"></script>--}}


{{--    <script src="/crud-vue-smarty3/dist/js/app.js"></script>--}}
{{--    <script src="/crud-vue-smarty3/dist/js/chunk-vendors.js"></script>--}}

{{--    <script src="/crud-vue-smarty3/dist/js/core.js"></script>--}}
{{--    <script src="/crud-vue-smarty3/dist/js/vendor_bundle.min.js"></script>--}}




    {!!  Theme::css('dist/css/core.css') !!}
    {!!  Theme::css('dist/css/app.css') !!}
    {!!  Theme::css('assets/css/cupgeo.css') !!}

    {!!  Theme::js('dist/js/app.js') !!}
    {!!  Theme::js('dist/js/chunk-vendors.js') !!}

    {!!  Theme::js('dist/js/core.js') !!}
    {!!  Theme::js('dist/js/vendor_bundle.min.js') !!}

</body>

</html>
