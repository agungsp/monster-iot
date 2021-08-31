@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'RFID')

{{-- TITLE CONTENT --}}
@section('title-content', 'RFID')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('rfid/update', $rfid->id) }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label for="uuid" class="form-label">UUID</label>
                            @hasrole('superadmin')
                                <input type="text" name="uuid" value="{{ old('uuid', $rfid->uuid) }}" class="form-control @error('uuid') is-invalid @enderror"/>
                            @endhasrole
                            @hasrole('admin')
                                <input type="text" name="uuid" value="{{ old('uuid', $rfid->uuid) }}" class="form-control @error('uuid') is-invalid @enderror" readonly/>
                            @endhasrole
                            @error('uuid') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" name="brand" value="{{ old('brand', $rfid->brand) }}" class="form-control @error('brand') is-invalid @enderror"/>
                            @error('brand') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" value="{{ old('type', $rfid->type) }}" class="form-control @error('type') is-invalid @enderror"/>
                            @error('type') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sn" class="form-label">SN</label>
                            <input type="number" name="sn" value="{{ old('sn', $rfid->sn) }}" class="form-control @error('sn') is-invalid @enderror"/>
                            @error('sn') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="buy_at" class="form-label">Buy At</label>
                            <input type="date" name="buy_at" value="{{ Carbon\Carbon::create($rfid->buy_at)->toDateString() }}" class="form-control @error('buy_at') is-invalid @enderror"/>
                            @error('buy_at') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kilometer_start" class="form-label">KM Start</label>
                            <input type="number" name="kilometer_start" value="{{ old('kilometer_start', $rfid->kilometer_start) }}" class="form-control @error('kilometer_start') is-invalid @enderror"/>
                            @error('kilometer_start') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kilometer_end" class="form-label">KM End</label>
                            <input type="number" name="kilometer_end" value="{{ old('kilometer_end', $rfid->kilometer_end) }}" class="form-control @error('kilometer_end') is-invalid @enderror"/>
                            @error('kilometer_end') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="is_broken" class="form-label">Is Broken</label>
                            <input type="number" name="is_broken" value="{{ old('is_broken', $rfid->is_broken) }}" class="form-control @error('is_broken') is-invalid @enderror"/>
                            @error('is_broken') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit">
                                Edit Data
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

@endsection
