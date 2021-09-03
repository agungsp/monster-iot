@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Create User')

{{-- TITLE CONTENT --}}
@section('title-content', 'Create User')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('user/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="username" class="form-control @error('name') is-invalid @enderror" autofocus/>
                            @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="email" class="form-control @error('email') is-invalid @enderror"/>
                            @error('email') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" placeholder="password" data-toggle="password" class="form-control @error('password') is-invalid @enderror"/>
                            @error('password') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="companies" class="form-label">Company</label>
                            <select name="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="">- PILIH -</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('company_id') == $item->id ? 'selected' : null }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            @hasrole('superadmin')
                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="">- PILIH -</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->name }}"
                                        {{ old('role') == $item->name ? 'selected' : null }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @endhasrole
                            @hasrole('admin')
                                <input type="text" id="role" name="role" value="user" class="form-control @error('role') is-invalid @enderror" readonly/>
                            @endhasrole
                            @error('role') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="photo" class="form-label">Avatar</label>
                            <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/*" class="form-control @error('avatar') is-invalid @enderror">
                            @error('avatar') <div class="text-muted"> {{ $message }} </div> @enderror
                        </div>
                        <input type="hidden" name="is_active" value="1" class="form-control" readonly/>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit">
                                Save
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
