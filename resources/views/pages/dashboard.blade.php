@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
    <style>
        .vh-75 {
            height: 75vh !important;
        }
        .vh-50 {
            height: 50vh !important;
        }
        .tabel {
            height: 250px;
        }
        table {
            width: 716px; /* 140px * 5 column + 16px scrollbar width */
            border-spacing: 0;
        }

        tbody, thead tr { display: block; }

        tbody {
            height: 20vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        tbody td, thead th {
            width: 140px;
            font-size: 10pt;
        }

        thead th:last-child {
            width: 156px; /* 140px + 16px scrollbar width */
        }

    </style>
@endsection

{{-- TITLE --}}
@section('title', 'Dashboard')

{{-- TITLE CONTENT --}}
@section('title-content', '')

{{-- CONTENT --}}
@section('content')
    <div class="row justify-content-start">
        {{-- maps --}}
        <div class="col-md-8 vh-50">
            <x-maps-leaflet
                :centerPoint="['lat' => -7.315018, 'long' => 112.790827]"
                :zoomLevel="18"
                :markers="[
                    ['lat' => -7.315018, 'long' => 112.790827, 'icon' => asset('images/truck.png'), 'iconSizeX' => 60, 'iconSizeY' => 25 ],
                ]"
                class="vh-50">
            </x-maps-leaflet>

            <div class="mt-3" style="height: 150px;">
                <table class="table table-hover border table-sm">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Device Name</th>
                            <th>Status</th>
                            <th>Geofence</th>
                            <th>Maintenance</th>
                            <th>Last Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 50; $i++)
                            <tr>
                                <td>25-08-2021 13:15:00</td>
                                <td>RI 1</td>
                                <td>Online</td>
                                <td></td>
                                <td></td>
                                <td>0 minutes</td>
                            </tr>
                        @endfor
                    </tbody>

                </table>
            </div>
        </div>
        <div class="col-md-4 px-0">
            <table class="table table-hover d-block border table-sm">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Last Update</th>
                    </tr>
                </thead>
                <tbody style="height: 32vh;">
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td>RI 1</td>
                            <td>Online</td>
                            <td>0 minutes</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <table class="table table-hover border table-sm">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Last Update</th>
                    </tr>
                </thead>
                <tbody style="height: 32.5vh;">
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td>L 123 AA</td>
                            <td>Offline</td>
                            <td>13 minutes</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        {{-- <div class="col-md-5 overflow-auto vh-75 border">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Pintu 1</h5>
                            <p id="SP1" class="fs-5 text-end">Terbuka</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Pintu 2</h5>
                            <p id="SP2" class="fs-5 text-end">Terbuka</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Kunci Pintu</h5>
                            <p id="MAG" class="fs-5 text-end">Terkunci</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Berat Kontainer</h5>
                            <p id="LC" class="fs-5 text-end">3.245</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Proximity</h5>
                            <p id="PROX" class="fs-5 text-end">Aman</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Emergency Button</h5>
                            <p id="PB" class="fs-5 text-end">Aman</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Kondisi Mesin</h5>
                            <p id="RS" class="fs-5 text-end">Menyala</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Driving Behaviour</h5>
                            <p id="DRI" class="fs-5 text-end">Stabil</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Latitude</h5>
                            <p id="LAT" class="fs-5 text-end">-7.315018</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Longitude</h5>
                            <p id="LON" class="fs-5 text-end">112.790827</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Drowsiness</h5>
                            <p id="DRO" class="fs-5 text-end">Mengantuk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    {{-- <div class="row p-3">
        <div class="col-auto border p-3 me-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="toggleMesin" checked>
                <label class="form-check-label" for="toggleMesin">Mesin <span class="badge bg-success" id="stateMesin">Menyala</span></label>
            </div>
        </div>
        <div class="col-auto border p-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="togglePintu" checked>
                <label class="form-check-label" for="togglePintu">Pintu <span class="badge bg-success" id="statePintu">Terbuka</span></label>
            </div>
        </div>
    </div> --}}
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')
    <script>
        mqtt.connect();
        (function () {
            /* =============================
             *  DOM Section
             * =============================
             */

            const toggleMesin = document.querySelector('#toggleMesin');
            const stateMesin = document.querySelector('#stateMesin');

            /* =============================
             *  End DOM Section
             * =============================
             */




            /* =============================
             *  Global Variable Section
             * =============================
             */

            /* =============================
             *  End Global Variable Section
             * =============================
             */



            /* =============================
             *  Event Section
             * =============================
             */

            toggleMesin.addEventListener('click', function () {
                if (this.checked) {
                    engineOnpub();
                    stateMesin.innerHTML = "Menyala";
                    stateMesin.classList.remove('bg-danger');
                    stateMesin.classList.add('bg-success');
                }
                else {
                    engineOffpub();
                    stateMesin.innerHTML = "Mati";
                    stateMesin.classList.remove('bg-success');
                    stateMesin.classList.add('bg-danger');
                }
            });

            togglePintu.addEventListener('click', function () {
                if (this.checked) {
                    unlockPintu();
                    statePintu.innerHTML = "Terbuka";
                    statePintu.classList.remove('bg-danger');
                    statePintu.classList.add('bg-success');
                }
                else {
                    lockPintu();
                    statePintu.innerHTML = "Tertutup";
                    statePintu.classList.remove('bg-success');
                    statePintu.classList.add('bg-danger');
                }
            });

            /* =============================
             *  End Event Section
             * =============================
             */
        })();
    </script>
@endsection
