@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Edit Device')

{{-- TITLE CONTENT --}}
@section('title-content', 'Edit Device')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <strong>Edit Device</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('devices/update', $devices->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-control-label">UUID</label>
                    @hasrole('superadmin')
                    <input type="text" name="uuid" value="{{ old('name', $devices->uuid) }}" class="form-control @error('uuid') is-invalid @enderror"/>
                    @endhasrole
                    @hasrole('admin')
                    <input type="text" name="uuid" value="{{ old('name', $devices->uuid) }}" class="form-control @error('uuid') is-invalid @enderror" readonly/>
                    @endhasrole
                    @error('uuid') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="type" class="form-control-label">Alias</label>
                    <input type="text" name="alias" value="{{ old('alias', $devices->alias) }}" class="form-control @error('alias') is-invalid @enderror"/>
                    @error('alias') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary btn-block" type="submit">
                        Edit Data
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
