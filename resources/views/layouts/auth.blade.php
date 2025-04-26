<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/png" href={{ asset('images/favicon.png') }} />
    <link rel="stylesheet" href={{ asset('libs/bootstrap/dist/css/bootstrap.min.css') }} />
    <link rel="stylesheet" href={{ asset('css/styles.min.css') }} />
    @yield('css')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @yield('content')
    </div>
    @yield('js')
    <script src={{ asset('libs/jquery/dist/jquery.min.js') }}></script>
    <script src={{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('js/sidebarmenu.js') }}></script>
    <script src={{ asset('js/app.min.js') }}></script>
    <script src={{ asset('libs/apexcharts/dist/apexcharts.min.js') }}></script>
    <script src={{ asset('libs/simplebar/dist/simplebar.js') }}></script>
</body>

</html>
