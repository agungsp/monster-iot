<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title', 'Title') | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light shadow-sm">
        <a class="navbar-brand ps-3" href="#">
            <img src="{{ asset('images/logo-group.png') }}" alt="Monster Group Logo" height="40">
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu pt-4">
                    <div class="nav">
                        @can('viewDashboard')
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                        @endcan
                        @can('viewUsers')
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <div class="sb-nav-link-icon"><i class="far fa-user"></i></div>
                                Users
                            </a>
                        @endcan
                        @can('viewCompanies')
                            <a class="nav-link" href="{{ route('company.index') }}">
                                <div class="sb-nav-link-icon"><i class="far fa-building"></i></div>
                                Companies
                            </a>
                        @endcan
                        @can('viewContracts')
                            <a class="nav-link" href="{{ route('contract.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-contract"></i></div>
                                Contracts
                            </a>
                        @endcan
                        @can('viewDevices')
                            <a class="nav-link" href="{{ route('devices.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-satellite-dish"></i></div>
                                Devices
                            </a>
                        @endcan
                        @can('viewRFID')
                            <a class="nav-link" href="{{ route('truck-monitoring.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-record-vinyl"></i></div>
                                RFID
                            </a>
                        @endcan
                        @can('viewContact')
                            <a class="nav-link" href="{{ route('contact') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                                Contact
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="sb-sidenav-footer row">
                    <div class="col text-truncate">
                        <div class="small d-block">Logged in as:</div>
                        {{ auth()->user()->name ?? '(null)' }}
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-danger rounded-circle" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off" style="padding-top: 0.4rem; padding-bottom: 0.4rem;"></i>
                        </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h4 class="mt-4">@yield('title-content', 'Title')</h4>
                    <hr>
                    @yield('content', 'This is content')
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; {{ config('app.name') }} {{ now()->year }}</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @yield('modal')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')

</body>
</html>
