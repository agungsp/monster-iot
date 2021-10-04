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
        body {
            overflow-x: hidden;
        }
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

        .overlay-wrapper {
            position: absolute;
            z-index: 1030;
            background-color: #fff;
            padding: .25rem;
        }

        .right-panel {
            width: 20rem;
            height: 32rem;
            right: 0;
            transition: width .5s;
        }

        .bottom-panel {
            width: 68rem;
            height: 12rem;
            bottom: 0;
            left: .5rem;
            transition: height .5s;
        }

        .right-panel.hide {
            width: 0;
        }

        .right-panel.hide table {
            display: none;
        }

        .bottom-panel.hide {
            height: 0;
        }

        .bottom-panel.hide table {
            display: none;
        }

        .right-panel .control {
            position: absolute;
            background: rgb(237,237,237);
            background: linear-gradient(270deg, rgba(237,237,237,1) 0%, rgba(217,217,217,1) 100%);
            border: 1px solid rgb(217,217,217);
            padding: 3rem .25rem 3rem .25rem;
            border-radius: 3rem 0 0 3rem;
            top: 12rem;
            left: -.7rem;
            cursor: pointer;
        }

        .bottom-panel .control {
            position: absolute;
            background: rgb(237,237,237);
            background: linear-gradient(270deg, rgba(237,237,237,1) 0%, rgba(217,217,217,1) 100%);
            border: 1px solid rgb(217,217,217);
            padding: 0 3rem 0 3rem;
            border-radius: 3rem 3rem 0 0;
            cursor: pointer;
            top: -1.3rem;
            left: 45%;
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
            <div class="container-fluid position-relative">
                <div class="overlay-wrapper right-panel hide shadow">
                    <div class="control">
                        <i class="fas fa-caret-left"></i>
                    </div>
                    <table class="mb-3 table table-hover border table-sm">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 1rem;">#</th>
                                <th style="width: 8rem;">Name</th>
                                <th style="width: 4rem;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDevices" style="height: 32vh;"></tbody>
                    </table>
                    <table class="mb-3 table table-hover border table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Attribute</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyState" style="height: 31vh;"></tbody>
                    </table>
                </div>
                <div class="overlay-wrapper bottom-panel hide shadow">
                    <div class="control">
                        <i class="fas fa-caret-up"></i>
                    </div>
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
                <div class="row mt-3">
                    <div class="col">
                        <div class="row mb-3">
                            <div class="col">
                                <div id="map" style="height: 75vh"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        let rightSide = document.querySelector('.right-panel');
        let rightSideControl = document.querySelector('.right-panel .control');
        let bottomSide = document.querySelector('.bottom-panel');
        let bottomSideControl = document.querySelector('.bottom-panel .control');
        rightSideControl.addEventListener('click', () => {
            rightSide.classList.toggle('hide');
        });
        bottomSideControl.addEventListener('click', () => {
            bottomSide.classList.toggle('hide');
        });

        let devices = [];
        createMap(17, null, [
            {
                name: "Kantor",
                latlng: [-7.31513, 112.79084],
                radius: 100
            }
        ]);

        const access = @json(auth()->user()->device_uuids);
        // const uuids = "{{ DeviceHelper::getUuids(Crypt::encryptString(auth()->id())) }}";
        let tbodyDevices = document.querySelector('#tbodyDevices');
        let tbodyState = document.querySelector('#tbodyState');
        window.onload = () => {
            axios.get("{{ route('dashboard.getDevices') }}")
            .then(res => {
                tbodyDevices.innerHTML = res.data.html;
                devices = res.data.json;
                devices.forEach(device => {
                    addMarker(device.uuid, device.latlng, 'truck');
                    addTooltipToMarker(device.uuid, device.uuid);
                });
            })
            .then(() => {
                let cells = document.querySelectorAll('#tbodyDevices tr.itemDevice td input[type=checkbox]');
                cells.forEach(cell => {
                    cell.onclick = function () {
                        tbodyState.innerHTML = '';
                        let rowsNotSelected = document.querySelectorAll('#tbodyDevices tr.itemDevice');
                        rowsNotSelected.forEach(row => {
                            row.classList.remove('table-active');
                        });

                        let rowId = this.parentNode.parentNode.rowIndex;
                        let rowSelected = document.querySelectorAll('#tbodyDevices tr.itemDevice')[rowId-1];
                        devices.forEach(device => {
                            if (device.uuid == this.getAttribute('data-uuid')) {
                                device.selected = this.checked;
                                rowSelected.classList.add('table-active');
                                if (device.uuid == '858771fe-15bb-4619-a36e-6a8f8094aaa1') {
                                    axios.get("{{ route('dashboard.getDevice') }}", {
                                        params: {
                                            id: rowSelected.id.split('.')[1],
                                        }
                                    })
                                    .then(res => {
                                        tbodyState.innerHTML = res.data;
                                        MQTTconnect();
                                    });
                                }
                            }
                        });
                    }
                });
            });
        }
    </script>
    @yield('js')
</body>
</html>
