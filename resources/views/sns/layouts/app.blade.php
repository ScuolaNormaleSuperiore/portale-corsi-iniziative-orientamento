<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

@include('includes.head')

<body class="">
    @include('includes.header')
    @yield('content-body')
    @include('includes.footer')
</body>
{!!  Theme::js('js/bootstrap-italia.bundle.min.js') !!}

</html>