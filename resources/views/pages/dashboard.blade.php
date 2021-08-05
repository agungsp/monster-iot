@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Dashboard')

{{-- TITLE CONTENT --}}
@section('title-content', 'Dashboard')

{{-- CONTENT --}}
@section('content')
    <div class="row">
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Pintu 1</h5>
                    <p class="fs-1 text-end">Terbuka</p>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Pintu 2</h5>
                    <p class="fs-1 text-end">Terbuka</p>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Kunci Pintu</h5>
                    <p class="fs-1 text-end">Terkunci</p>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Berat Kontainer</h5>
                    <p class="fs-1 text-end">3.245</p>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Proximity</h5>
                    <p class="fs-1 text-end">Aman</p>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Emergency Button</h5>
                    <p class="fs-1 text-end">Aman</p>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Kondisi Mesin</h5>
                    <p class="fs-1 text-end">Menyala</p>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Driving Behaviour</h5>
                    <p class="fs-1 text-end">Stabil</p>
                </div>
            </div>
        </div>
        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Drowsiness</h5>
                    <p class="fs-1 text-end">Mengantuk</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6 border p-3 me-3">
            {{--             CENTER POINT: MOJOKERTO                                 MAX: 18                           --}}
            <x-maps-leaflet :centerPoint="['lat' => -7.46316, 'long' => 112.43199]" :zoomLevel="17" :markers="[['lat' => -7.46316, 'long' => 112.43199]]"></x-maps-leaflet>
        </div>
        <div class="col-5 border p-3 ms-2">
            <h5>Control</h5>
            <div class="d-block mb-3 border p-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="toggleMesin" checked>
                    <label class="form-check-label" for="toggleMesin">Mesin <span class="badge bg-success" id="stateMesin">Menyala</span></label>
                </div>
            </div>
            <div class="d-block mb-3 border p-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="togglePintu" checked>
                    <label class="form-check-label" for="togglePintu">Pintu <span class="badge bg-success" id="statePintu">Terbuka</span></label>
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
        const toggleMesin = document.querySelector('#toggleMesin');
        const stateMesin = document.querySelector('#stateMesin');
        toggleMesin.addEventListener('click', function () {
            if (this.checked) {
                stateMesin.innerHTML = "Menyala";
                stateMesin.classList.remove('bg-danger');
                stateMesin.classList.add('bg-success');
            }
            else {
                stateMesin.innerHTML = "Mati";
                stateMesin.classList.remove('bg-success');
                stateMesin.classList.add('bg-danger');
            }
        });

        const togglePintu = document.querySelector('#togglePintu');
        const statePintu = document.querySelector('#statePintu');
        togglePintu.addEventListener('click', function () {
            if (this.checked) {
                statePintu.innerHTML = "Terbuka";
                statePintu.classList.remove('bg-danger');
                statePintu.classList.add('bg-success');
            }
            else {
                statePintu.innerHTML = "Tertutup";
                statePintu.classList.remove('bg-success');
                statePintu.classList.add('bg-danger');
            }
        });
    </script>
@endsection
