@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
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
                            <div class="input-group-append">
                                <input type="password" name="password" value="{{ old('password') }}" placeholder="password" id="password" class="form-control @error('password') is-invalid @enderror" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                <span class="input-group-text" onclick="password_show_hide();" style="cursor: pointer;">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
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
<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>
@endsection
