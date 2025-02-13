<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    @include('sns.includes.head')
    <body class="bg-white">

        <div class="skiplink">
            <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
            <a class="visually-hidden-focusable" href="#footer">Vai al
                footer</a>

        </div>

        @include('sns.includes.header')

        <main id="main-container">
            @yield('content-body')
        </main>

        @include('sns.includes.footer')
        @include('sns.includes.notifications')
        @include('sns.includes.scripts')
        @yield('extra-scripts')
    </body>
</html>
