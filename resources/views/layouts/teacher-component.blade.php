<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
<head>
    <!-- Basic Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Tacher Dashboard</title>


    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

   <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('all/assets/images/favicon.svg')}}" type="image/x-icon"> <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('all/assets/fonts/tabler-icons.min.css')}}" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('all/assets/fonts/feather.css')}}" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('all/assets/fonts/fontawesome.css')}}" >
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('all/assets/fonts/material.css')}}" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('all/assets/css/style.css')}}" id="main-style-link" >
    <link rel="stylesheet" href="{{ asset('all/assets/css/style-preset.css')}}" >

</head>
    <body>
        <!-- Pre-loader -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>

            <!-- Header -->
        <header class="pc-header">
            <div class="header-wrapper">
                @include('dean.partials.header')
            </div>
        </header>

        <!-- Sidebar Navigation -->
        <nav class="pc-sidebar">
            <div class="navbar-wrapper">
                <div class="m-header">
                    <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                        <img src="{{ asset('all/assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="Logo">
                    </a>
                </div>
                @include('dean.partials.sidebar')
            </div>
        </nav>

        <!-- Main Content Area -->
        <div class="pc-container">
            <div class="pc-content">
                <!-- Page Header -->
                @if(isset($pageHeader))
                    <div class="page-header">
                        {{ $pageHeader }}
                    </div>
                @endif

                <!-- Main Slot Content -->
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <footer class="pc-footer">
            <div class="footer-wrapper container-fluid">
                @include('dean.partials.footer')
            </div>
        </footer>

        <script src="{{ asset('all/assets/js/plugins/popper.min.js') }}"></script>
        <script src="{{ asset('all/assets/js/plugins/simplebar.min.js') }}"></script>
        <script src="{{ asset('all/assets/js/plugins/bootstrap.min.js') }}"></script>
        <script src="{{ asset('all/assets/js/fonts/custom-font.js') }}"></script>
        <script src="{{ asset('all/assets/js/pcoded.js') }}"></script>
        <script src="{{ asset('all/assets/js/plugins/feather.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>

    <script>
        function logoutConfirm() {
                Swal.fire({
                    title: "Are you sure you want to logout?",
                    text: "You will be logged out of your session!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Logout"
                }).then((willLogout) => {
                    if (willLogout.isConfirmed) {
                        // If confirmed, submit the logout form
                        document.getElementById('logout-form').submit();
                    }
                });
            }
    </script>

</html>

