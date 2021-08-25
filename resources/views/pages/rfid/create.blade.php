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
    <div class="card">
        <div class="card-header">
            <strong>Tambah RFID</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('rfid/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="uuid" class="form-control-label">UUID</label>
                    <input type="text" name="uuid" value="{{ old('uuid') }}" class="form-control @error('uuid') is-invalid @enderror"/>
                    @error('uuid') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="brand" class="form-control-label">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}" class="form-control @error('brand') is-invalid @enderror"/>
                    @error('brand') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="type" class="form-control-label">Type</label>
                    <input type="text" name="type" value="{{ old('type') }}" class="form-control @error('type') is-invalid @enderror"/>
                    @error('type') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="sn" class="form-control-label">SN</label>
                    <input type="number" name="sn" value="{{ old('sn') }}" class="form-control @error('sn') is-invalid @enderror"/>
                    @error('sn') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="buy_at" class="form-control-label">Buy At</label>
                    <input type="date" name="buy_at" value="{{ old('buy_at') }}" class="form-control buy_at @error('buy_at') is-invalid @enderror"/>
                    @error('buy_at') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="kilometer_start" class="form-control-label">KM Start</label>
                    <input type="text" name="kilometer_start" value="{{ old('kilometer_start') }}" class="form-control @error('kilometer_start') is-invalid @enderror"/>
                    @error('kilometer_start') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="kilometer_end" class="form-control-label">KM End</label>
                    <input type="text" name="kilometer_end" value="{{ old('kilometer_end') }}" class="form-control @error('kilometer_end') is-invalid @enderror"/>
                    @error('kilometer_end') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="is_broken" class="form-control-label">Is Broken</label>
                    <input type="number" name="is_broken" value="{{ old('is_broken') }}" class="form-control @error('is_broken') is-invalid @enderror"/>
                    @error('is_broken') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Tambah Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')
<script src="{{ asset('js/cleave.min.js') }}"></script>
{{-- <script src="cleave-phone.{country}.js"></script> --}}
<script>
    var cleave = new Cleave('.number', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
</script>
@endsection
