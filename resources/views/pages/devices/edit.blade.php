@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Tambah Device')

{{-- TITLE CONTENT --}}
@section('title-content', 'Tambah Device')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Tambah Device</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('devices/update', $devices->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">UUID</label>
                    @hasrole('superadmin')
                    <input type="text" name="uuid" value="{{ old('name', $devices->uuid) }}" class="form-control @error('uuid') is-invalid @enderror"/>
                    @endhasrole
                    @hasrole('admin')
                    <input type="text" name="uuid" value="{{ old('name', $devices->uuid) }}" class="form-control @error('uuid') is-invalid @enderror" readonly/>
                    @endhasrole
                    @error('uuid') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="type" class="form-control-label">Alias</label>
                    <input type="text" name="alias" value="{{ old('alias', $devices->alias) }}" class="form-control @error('alias') is-invalid @enderror"/>
                    @error('alias') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Edit Data
                    </button>
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
