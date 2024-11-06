<!doctype html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/xhtml">
@include("includes.head")

<!--
		Sticky/Reveal are not supported by this layout!
		****************************************************************************************************
			.layout-admin + .aside-focus + .layout-padded
		****************************************************************************************************
	-->
<body>
<div id="wrapper">

    <!-- light logo -->
    <a aria-label="go back" href="/"
       class="espad-main position-absolute top-0 start-0 my-2 mx-4 z-index-3 h--60 d-inline-flex align-items-center bg-white full-width">
                    <span data-gfont="Sriracha" class="fs--25 text-dark">
                                            <img src="{!! Theme::url('assets/images/gap-osservatorio-2.png') !!}"
                                                 width="150" height="50"
                                                 alt="{{env('APP_NAME')}}">
                    </span>
        {{--                <img src="{{Theme::url('assets/images/logo/logo_dark.svg')}}" width="110" alt="...">--}}
    </a>


    <div class="d-lg-flex text-white h--70 bg-white">

    </div>
    <div class="d-lg-flex text-white min-h-100vh {{$layoutGradientColor}}">

        @yield('content')

    </div>

    {{--    <div class="d-lg-flex text-dark h--100 bg-white">--}}
    {{--    </div>--}}
</div>



    {!!  Theme::css('dist/css/core.css') !!}
    {!!  Theme::css('dist/css/app.css') !!}

    {!!  Theme::js('dist/js/core.js') !!}
</body>

</html>
