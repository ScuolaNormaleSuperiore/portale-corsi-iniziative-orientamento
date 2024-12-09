<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

@include('includes.head')

<body class="bg-white">
    @include('includes.header')
    @yield('content-body')
    @include('includes.footer')
    @include('includes.notifications')

    @include('includes.scripts')
</body>


</html>
