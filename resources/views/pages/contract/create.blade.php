@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Contract')

{{-- TITLE CONTENT --}}
@section('title-content', 'Contract')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('contract/store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="companies" class="form-label">Company</label>
                            <select name="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="">- PILIH -</option>
                                @foreach ($contract as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : null }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="started_at" class="form-label">Started At</label>
                                <input type="date" name="started_at" value="{{ old('started_at') }}" class="form-control @error('started_at') is-invalid @enderror"/>
                                @error('started_at') <div class="text-muted">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="expired_at" class="form-label">Expired At</label>
                                <input type="date" name="expired_at" value="{{ old('expired_at') }}" class="form-control @error('expired_at') is-invalid @enderror"/>
                                @error('expired_at') <div class="text-muted">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Devices</label>
                            <input type="number" name="jumlah" value="{{ old('jumlah') }}" min="0" placeholder="jumlah device" class="form-control @error('jumlah') is-invalid @enderror"/>
                            @error('jumlah') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilihan Node</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="node_base" name="node_base" checked>
                                        <input type="hidden" id="node_base_val" name="node_base_val" value="1" class="form-control" readonly/>
                                        <label class="form-check-label" for="node_base">
                                          Base
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="node_load" name="node_load" checked>
                                        <input type="hidden" id="node_load_val" name="node_load_val" value="1" class="form-control" readonly/>
                                        <label class="form-check-label" for="node_load">
                                            Beban
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="node_door" name="node_door" checked>
                                        <input type="hidden" id="node_door_val" name="node_door_val" value="1" class="form-control" readonly/>
                                        <label class="form-check-label" for="node_door">
                                          Pintu
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="node_rfid" name="node_rfid" checked>
                                        <input type="hidden" id="node_rfid_val" name="node_rfid_val" value="1" class="form-control" readonly/>
                                        <label class="form-check-label" for="node_rfid">
                                            RFID
                                        </label>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="5">{{ old('keterangan') }}</textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit">
                                Tambah Data
                            </button>
                        </div>
                    </form>
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
        const is_base = document.querySelector('#node_base');
        const is_door = document.querySelector('#node_door');
        const is_load = document.querySelector('#node_load');
        const is_rfid = document.querySelector('#node_rfid');

        const is_base_val = document.querySelector('#node_base_val');
        const is_door_val = document.querySelector('#node_door_val');
        const is_load_val = document.querySelector('#node_load_val');
        const is_rfid_val = document.querySelector('#node_rfid_val');

        is_base.addEventListener('click', function () {
            if (this.checked) {
                is_base_val.value = '1';
            } else {
                is_base_val.value = '0';
            }
        });
        is_door.addEventListener('click', function () {
            if (this.checked) {
                is_door_val.value = '1';
            } else {
                is_door_val.value = '0';
            }
        });
        is_load.addEventListener('click', function () {
            if (this.checked) {
                is_load_val.value = '1';
            } else {
                is_load_val.value = '0';
            }
        });
        is_rfid.addEventListener('click', function () {
            if (this.checked) {
                is_rfid_val.value = '1';
            } else {
                is_rfid_val.value = '0';
            }
        });
    </script>
@endsection
