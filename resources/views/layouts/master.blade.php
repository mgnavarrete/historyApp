<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Page for Eolic Stuff">
    <meta name="Author" content="Menta">
    <meta name="keywords" content="Adentu Eolico">

    <!-- TITLE -->
    <title> AdentuCloud </title>

    <!-- FAVICON -->
    <link rel="icon" href="https://www.adentu.cl/wp-content/uploads/2022/08/Adentu-Favicon-180x180.png" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('build/assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="{{asset('build/assets/icon-fonts/icons.css')}}" rel="stylesheet">

    <!-- APP SCSS -->
    @vite(['resources/sass/app.scss'])


    @include('layouts.components.styles')

    <!-- MAIN JS -->
    <script src="{{asset('build/assets/main.js')}}"></script>

    @yield('styles')

</head>

<body>

    <!-- SWITCHER -->

    @include('layouts.components.switcher')

    <!-- END SWITCHER -->

    <!-- LOADER -->
    <div id="loader">
        <img src="{{asset('build/assets/images/media/loader.svg')}}" alt="">
    </div>
    <!-- END LOADER -->

    <!-- PAGE -->
    <div class="page">

        <!-- HEADER -->

        @include('layouts.components.header')

        <!-- END HEADER -->

        <!-- SIDEBAR -->

        @include('layouts.components.sidebar')

        <!-- END SIDEBAR -->

        <!-- MAIN-CONTENT -->

        <div class="main-content app-content">

            @yield('content')

        </div>
        <!-- END MAIN-CONTENT -->

        <!-- SEARCH-MODAL -->

        @include('layouts.components.search-modal')

        <!-- END SEARCH-MODAL -->

        <!-- FOOTER -->

        @include('layouts.components.footer')

        <!-- END FOOTER -->

    </div>
    <!-- END PAGE-->

    <!-- SCRIPTS -->

    @include('layouts.components.scripts')

    @yield('scripts')

    <!-- STICKY JS -->
    <script src="{{asset('build/assets/sticky.js')}}"></script>

    <!-- APP JS -->
    @vite('resources/js/app.js')


    <!-- CUSTOM-SWITCHER JS -->
    @vite('resources/assets/js/custom-switcher.js')


    <!-- END SCRIPTS -->

</body>

</html>