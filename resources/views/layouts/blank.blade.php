<!DOCTYPE html>

<html lang="en-us">

@include('layouts.frontend.head')

<body>


    <div class="">

        @yield('content')
    </div>
    @include('layouts.frontend.footer')

    <!-- # JS Plugins -->
    <script src="{{ asset('frontend_theme/') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('frontend_theme/') }}/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('frontend_theme/') }}/plugins/slick/slick.min.js"></script>
    <script src="{{ asset('frontend_theme/') }}/plugins/scrollmenu/scrollmenu.min.js"></script>

    <!-- Main Script -->
    <script src="{{ asset('frontend_theme/') }}/js/script.js"></script>
    @stack('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10"> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>
