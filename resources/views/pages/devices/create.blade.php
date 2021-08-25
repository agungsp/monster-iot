@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Contact')

{{-- TITLE CONTENT --}}
@section('title-content', 'Contact')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Tambah Device</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('devices/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">UUID</label>
                    <input type="text" name="uuid" value="{{ old('uuid') }}" class="form-control @error('uuid') is-invalid @enderror"/>
                    @error('uuid') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="name" class="form-control-label">Alias</label>
                    <input type="text" name="alias" value="{{ old('alias') }}" class="form-control @error('alias') is-invalid @enderror"/>
                    @error('alias') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group mt-3">
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
    
@endsection
