@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

{{-- TITLE --}}
@section('title', 'Edit User')

{{-- TITLE CONTENT --}}
@section('title-content', 'Edit User')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('user/update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="username" class="form-control @error('name') is-invalid @enderror" autofocus/>
                            @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="email" class="form-control @error('email') is-invalid @enderror"/>
                            @error('email') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="companmies" class="form-label">Company</label>
                            @hasrole('superadmin')
                            <select name="company_id" class="form-control @error('company_id') is-invalid @enderror">
                            @endhasrole
                            @hasrole('admin')
                            <select class="form-control @error('company_id') is-invalid @enderror" disabled>
                            @endhasrole
                                <option value="">- PILIH -</option>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('company_id', $user->company_id) == $item->id ? 'selected' : null }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @hasrole('admin')
                            <input type="hidden" id="company_id" name="company_id" value="{{ $user->company_id }}" class="form-control" readonly/>
                            @endhasrole
                            @error('company_id') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        
                        @hasrole('superadmin')
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="">- PILIH -</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->name }}"
                                            {{ old('role', $rolecurrent) == $item->name ? 'selected' : null }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role') <div class="text-muted">{{ $message }}</div> @enderror
                            </div>
                            <input type="hidden" id="role" name="rolecurrent" value="{{ old('role', $rolecurrent) }}" class="form-control @error('role') is-invalid @enderror" readonly/>
                        @endhasrole
                        <div class="mb-4">
                            <label for="photo" class="form-label">Avatar</label>
                            <input type="file" name="avatar" value="{{ old('avatar', $user->avatar) }}" accept="image/*" class="form-control @error('avatar') is-invalid @enderror">
                            @error('avatar') <div class="text-muted"> {{ $message }} </div> @enderror
                        </div>
                        @hasrole('superadmin')
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    @if($user->is_active == 1)
                                        <input class="form-check-input" type="checkbox" id="is_active" checked>
                                        <label class="form-check-label" for="is_active"><span class="badge bg-success" id="stateAktif">Aktif</span></label>
                                    @else
                                        <input class="form-check-input" type="checkbox" id="is_active">
                                        <label class="form-check-label" for="is_active"><span class="badge bg-danger" id="stateAktif">Tidak Aktif</span></label>
                                    @endif
                                </div>
                            </div>
                        @endhasrole
                        @hasrole('admin')
                            <input type="hidden" id="role" name="role" value="{{ old('role', $rolecurrent) }}" class="form-control @error('role') is-invalid @enderror" readonly/>   
                            @if($rolecurrent != "admin")
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        @if($user->is_active == 1)
                                            <input class="form-check-input" type="checkbox" id="is_active" checked>
                                            <label class="form-check-label" for="is_active"><span class="badge bg-success" id="stateAktif">Aktif</span></label>
                                        @else
                                            <input class="form-check-input" type="checkbox" id="is_active">
                                            <label class="form-check-label" for="is_active"><span class="badge bg-danger" id="stateAktif">Tidak Aktif</span></label>
                                        @endif
                                        {{-- <input type="hidden" name="is_activeVal" id="is_activeVal" value="{{ old('is_active', $user->is_active) }}"/> --}}
                                    </div>
                                </div>
                            @endif
                        @endhasrole
                        <input type="hidden" name="is_activeVal" id="is_activeVal" value="{{ old('is_active', $user->is_active) }}"/>
                        <input type="hidden" id="role" name="rolecurrent" value="{{ old('role', $rolecurrent) }}" class="form-control @error('role') is-invalid @enderror" readonly/>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.toggle-one').bootstrapToggle();
        })
    </script>
    <script>
        const is_active = document.querySelector('#is_active');
        const stateAktif = document.querySelector('#stateAktif');
        const is_activeVal = document.querySelector('#is_activeVal');

        is_active.addEventListener('click', function () {
            if (this.checked) {
                stateAktif.innerHTML = "Aktif";
                stateAktif.classList.remove('bg-danger');
                stateAktif.classList.add('bg-success');
                is_activeVal.value = '1';
            }
            else {
                stateAktif.innerHTML = "Tidak Aktif";
                stateAktif.classList.remove('bg-success');
                stateAktif.classList.add('bg-danger');
                is_activeVal.value = '0';
            }
        });
    </script>
@endsection
