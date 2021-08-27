@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Device')

{{-- TITLE CONTENT --}}
@section('title-content', 'Device')

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('devices/update', $devices->id) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">UUID</label>
                        <input type="text" name="uuid" value="{{ old('name', $devices->uuid) }}" placeholder="uuid" class="form-control @error('uuid') is-invalid @enderror"/>
                        @error('uuid') <div class="text-muted">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Alias</label>
                        <input type="text" name="alias" value="{{ old('alias', $devices->alias) }}" placeholder="alias" class="form-control @error('alias') is-invalid @enderror"/>
                        @error('alias') <div class="text-muted">{{ $message }}</div> @enderror
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
