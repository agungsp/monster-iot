@php
    $classic = false;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        tbody {
            display:block;
            overflow:auto;
            cursor: pointer;
        }
        thead, tbody tr {
            display:table;
            width:100%;
            table-layout:fixed;
        }
        thead {
            width: calc( 100% - .5em );
        }

        th.fitwidth {
            width: 1px;
            white-space: nowrap;
        }

        /* SCROLLBAR STYLE */
        /* width */
        ::-webkit-scrollbar {
            width: .5em;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 1px var(--bs-secondary);
            background-color: var(--bs-light);
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: var(--bs-secondary);
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: var(--bs-gray-dark);
        }
    </style>
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
                            <a class="nav-link" href="{{ route('rfid.index') }}">
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
                    <div class="row mt-3 @if ($classic) d-none @endif">
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col">
                                    <div id="map" style="height: 50vh;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table class="table table-hover table-sm border">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Datetime</th>
                                                <th>Event</th>
                                                <th>Status</th>
                                                <th>Coordinate</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyEvents" style="height: 20vh;"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-3">
                                <div class="col">
                                    <table class="table table-hover border table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th style="width: 4rem;">Status</th>
                                                <th style="width: 8rem;">Last Update</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyDevices" style="height: 32vh;"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table class="table table-hover border table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyState" style="height: 31vh;"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($classic)
                        <table>
                            <tr>
                                <th>
                                    <h2>Pintu 1</h2>
                                    <p id="SP1"> terbuka
                                </th>
                                <th>
                                    <h2>Pintu 2</h2>
                                    <p id="SP2"> terbuka
                                </th>
                                <th>
                                    <h2>Kunci Pintu</h2>
                                    <p id="MAG"> terkunci
                                </th>
                                <th>
                                    <h2>Berat Kontainer</h2>
                                    <p id="LC"> 10
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <h2>Proximity</h2>
                                    <p id="PROX"> aman
                                </th>
                                <th>
                                    <h2>Emergency Button</h2>
                                    <p id="PB"> aman
                                </th>
                                <th>
                                    <h2>Kondisi Mesin</h2>
                                    <p id="RS"> Nyala
                                </th>
                                <th>
                                    <h2>Driving Behavior</h2>
                                    <p id="DRI"> Stabil
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <h2>Latitude</h2>
                                    <p id="LAT"> -7.315080
                                </th>
                                <th>
                                    <h2>Longitude</h2>
                                    <p id="LON"> 112.790820
                                </th>
                                <th>
                                    <h2>Drowsiness</h2>
                                    <p id="DRO"> tidak mengantuk
                                </th>
                                <th>
                                    <h2>Tutup Tangki</h2>
                                    <p id="TANK"> tidak Tertutup
                                </th>
                            </tr>
                        </table>
                    @endif
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
    <script src="{{ asset('js/sub.js') }}"></script>
    <script>
        createMap();
        let selectedDevice = "undefined";
        const access = @json(auth()->user()->device_uuids);
        const uuids = "{{ DeviceHelper::getUuids(Crypt::encryptString(auth()->id())) }}";
        let tbodyDevices = document.querySelector('#tbodyDevices');
        let tbodyState = document.querySelector('#tbodyState');
        // let tbodyEvents = document.querySelector('#tbodyEvents');
        // let lastCoordinate = {
        //     LAT : 0,
        //     LON : 0
        // }
        window.onload = () => {
            @if ($classic)
                MQTTconnect(uuids);
            @endif
            axios.get("{{ route('dashboard.getDevices') }}")
            .then(res => {
                tbodyDevices.innerHTML = res.data;
            })
            .then(() => {
                let cells = document.querySelectorAll('#tbodyDevices tr.itemDevice td');
                cells.forEach(cell => {
                    cell.onclick = function () {
                        tbodyState.innerHTML = '';
                        let rowId = this.parentNode.rowIndex;
                        let rowsNotSelected = document.querySelectorAll('#tbodyDevices tr.itemDevice');
                        rowsNotSelected.forEach(row => {
                            row.classList.remove('table-active');
                        });
                        let rowSelected = document.querySelectorAll('#tbodyDevices tr.itemDevice')[rowId-1];
                        rowSelected.classList.add('table-active');
                        if (rowSelected.dataset.uuid == '858771fe-15bb-4619-a36e-6a8f8094aaa1') {
                            selectedDevice = rowSelected.dataset.uuid;
                            axios.get("{{ route('dashboard.getDevice') }}", {
                                params: {
                                    id: rowSelected.id.split('.')[1],
                                }
                            })
                            .then(res => {
                                tbodyState.innerHTML = res.data;
                                @if (!$classic)
                                    // MQTTconnect(uuids);
                                @endif
                                window.addMarker('uuid 1', [-7.31513, 112.79084]);
                            });
                        }
                    }
                });
            });
        }
    </script>
    @yield('js')
</body>
</html>
