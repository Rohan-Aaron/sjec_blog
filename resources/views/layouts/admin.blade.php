<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" type="image/png" href={{ asset('images/favicon.png') }} />
    <link rel="stylesheet" href={{ asset('libs/bootstrap/dist/css/bootstrap.min.css') }} />
    <link rel="stylesheet" href={{ asset('css/styles.min.css') }} />
    @yield('css')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            @include('includes.sidebar')
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper ">
            <!--  Header Start -->

            @include('includes.header')

            <!--  Header End -->
            <div class="container" style="padding-top: 80px;">
                <div class="card shadow-lg">
                    <div class="card-body m-0 p-4">
                        <h5 class="card-title fw-semibold">@yield('title')</h5>
                        <!-- Breadcrumb starts here -->
                        @php
                            $segments = array_slice(Request::segments(),1);
                        @endphp

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard') }}">Home</a></li>
                                @foreach ($segments as $index => $segment)
                                    @php
                                        $url = url(implode('/', array_slice($segments, 0, $index + 1)));
                                        $isLast = $index == count($segments) - 1;
                                    @endphp

                                    <li class="breadcrumb-item {{ $isLast ? 'active' : '' }}"
                                        @if ($isLast) aria-current="page" @endif>
                                        @if (!$isLast)
                                            <a href="{{ $url }}">{{ ucfirst($segment) }}</a>
                                        @else
                                            {{ ucfirst($segment) }}
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        </nav>

                        <!-- Breadcrumb ends here -->
                    </div>
                </div>

                <!--  Page Content Start -->
                @yield('content')
                <!-- Page Content End-->
                <!-- Footer Start -->
                @include('includes.footer')
                <!-- Footer End -->
                @include('sweetalert::alert')

            </div>
        </div>
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
