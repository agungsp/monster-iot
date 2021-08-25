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
@section('title-content', 'User')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Tambah User</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('user/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">Username</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"/>
                    @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="type" class="form-control-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"/>
                    @error('email') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="form-control-label">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror"/>
                    @error('password') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="photo" class="form-control-label">Avatar</label>
                    <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/*" class="form-control @error('avatar') is-invalid @enderror">
                    @error('avatar') <div class="text-muted"> {{ $message }} </div> @enderror
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

@endsection
