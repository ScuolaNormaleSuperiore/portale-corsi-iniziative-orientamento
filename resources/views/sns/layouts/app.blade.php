<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    @include('sns.includes.head')
    <body class="bg-white">
        @include('sns.includes.header')
        @yield('content-body')
        @include('sns.includes.footer')
        @include('sns.includes.notifications')
        @include('sns.includes.scripts')
        @yield('extra-scripts')
    </body>
</html>
