@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Company')

{{-- TITLE CONTENT --}}
@section('title-content', 'Company')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit Company</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('company/update', $companies->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $companies->name) }}" class="form-control @error('name') is-invalid @enderror"/>
                    @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="form-control-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $companies->email) }}" class="form-control @error('email') is-invalid @enderror"/>
                    @error('email') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="phone" class="form-control-label">Phone</label>
                    <input type="number" name="phone" value="{{ old('phone', $companies->phone) }}" class="form-control @error('phone') is-invalid @enderror"/>
                    @error('phone') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="website" class="form-control-label">Website</label>
                    <input type="text" name="website" value="{{ old('website', $companies->website) }}" class="form-control @error('website') is-invalid @enderror"/>
                    @error('website') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="address" class="form-control-label">Address</label>
                    <input type="text" name="address" value="{{ old('address', $companies->address) }}" class="form-control @error('address') is-invalid @enderror"/>
                    @error('address') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
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
