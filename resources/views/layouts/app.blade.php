<!DOCTYPE html>

<html lang="en-us">

@include('layouts.frontend.head')

<body>

    <!-- navigation -->
    <header class="navigation bg-tertiary">
        @include('layouts.frontend.navbar')

    </header>
    <!-- /navigation -->

    @yield('content')
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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10">
    @if (Session::has('danger'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ Session::get('danger') }}',
                type: 'error',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: 'Good job!',
                text: '{{ Session::get('success') }}',
                type: 'success',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        </script>
    @endif
</body>

</html>
