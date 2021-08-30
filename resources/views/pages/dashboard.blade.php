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
@endsection

{{-- TITLE --}}
@section('title', 'Dashboard')

{{-- TITLE CONTENT --}}
@section('title-content', '')

{{-- CONTENT --}}
@section('content')
    <div class="row mt-3">
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
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')
    <script>
        let selectedDevice = "undefined";
        const access = @json(auth()->user()->device_uuids);
        const keyOfState = {
            SP1 :{
                name: "Pintu 1",
                state: ["Terbuka", "Tertutup"]
            },
            SP2 :{
                name: "Pintu 2",
                state: ["Terbuka", "Tertutup"]
            },
            MAG :{
                name: "Kunci Pintu",
                state: ["Tidak Terkunci", "Terkunci"]
            },
            PROX :{
                name: "Proximity",
                state: ["Tidak aman", "Aman"]
            },
            PB :{
                name: "Emergency Button",
                state: ["Bahaya", "Aman"]
            },
            RS :{
                name: "Mesin",
                state: ["Mati", "Menyala"]
            },
            DRI :{
                name: "Driving Behaviour",
                state: ["Tidak stabil", "Stabil"]
            },
            DRO :{
                name: "Drowness",
                state: ["Mengantuk", "Tidak Mengantuk"]
            },
            TANK :{
                name: "Tutup Tangki",
                state: ["Tidak tertutup", "Tertutup"]
            }
        }
        const keyOfStateExcept = {
            LAT :{
                name: "Latitude"
            },
            LON :{
                name: "Longitude"
            },
            LC :{
                name: "Berat Kontainer"
            }
        }

        let tbodyDevices = document.querySelector('#tbodyDevices');
        let tbodyState = document.querySelector('#tbodyState');
        let tbodyEvents = document.querySelector('#tbodyEvents');
        let lastCoordinate = {
            LAT : 0,
            LON : 0
        }

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
                        selectedDevice = rowSelected.dataset.uuid;
                        axios.get("{{ route('dashboard.getDevice') }}", {
                            params: {
                                id: rowSelected.id.split('.')[1],
                            }
                        })
                        .then(res => {
                            tbodyState.innerHTML = res.data;
                        });
                    }
                });
            });

        window.Echo.channel("EveryoneChannel").listen(".EveryoneMessage", function (e) {
            let data = JSON.parse(e.message);

            // Only display uuid owned
            if (access.indexOf(data.UUID) >= 0) {
                for (const [k, v] of Object.entries(data)) {
                    if (['UUID', 'id', 'GX', 'GY', 'GZ'].indexOf(k) < 0) {
                        if (k != "LC" && k != "LAT" && k != "LON") {
                            if (data[k].isChange) {
                                if (selectedDevice !== "undefined") {
                                    if (data.UUID === selectedDevice) {
                                        if (data[k].value === "1") {
                                            document.querySelector(`#${k}`).innerHTML = `<span class="badge rounded-pill bg-success">${keyOfState[k].state[data[k].value]}</span>`;
                                        }
                                        else {
                                            document.querySelector(`#${k}`).innerHTML = `<span class="badge rounded-pill bg-danger">${keyOfState[k].state[data[k].value]}</span>`;
                                        }
                                        let row = tbodyEvents.insertRow(0);
                                        let cellDateTime = row.insertCell(0);
                                        let cellEvent = row.insertCell(1);
                                        let cellStatus = row.insertCell(2);
                                        let cellCoordinate = row.insertCell(3);
                                        row.classList.add(`${data[k].value === "1" ? "text-success" : "text-danger"}`)
                                        cellDateTime.innerHTML = moment().format("YYYY-MM-DD HH:mm:ss");
                                        cellEvent.innerHTML = keyOfState[k].name;
                                        cellStatus.innerHTML = keyOfState[k].state[data[k].value];
                                        cellCoordinate.innerHTML = `<a href="javascript:void(0)">${lastCoordinate.LAT}, ${lastCoordinate.LON}</a>`;
                                    }
                                }
                                Toast.fire({
                                    icon: data[k].value == "1" ? 'info' : 'error',
                                    title: `${keyOfState[k].name} ${keyOfState[k].state[data[k].value]}`,
                                    footer: data.UUID
                                });
                            }
                        }
                        else {
                            if (selectedDevice !== "undefined") {
                                if (data.UUID === selectedDevice) {
                                    document.querySelector(`#${k}`).innerHTML = data[k].value + `${k === 'LC' ? ' kg' : ''}`;
                                    if (k !== 'LC') {
                                        lastCoordinate[k] = data[k].value;
                                    }
                                }
                            }
                            // console.log(keyOfStateExcept[k].name + " : " + data[k].value + " : " + data[k].isChange);
                        }
                    }
                }
            }
        });

    </script>
@endsection
