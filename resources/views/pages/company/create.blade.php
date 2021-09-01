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
@section('title-content', 'Company')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('company/store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="name" class="form-control @error('name') is-invalid @enderror"/>
                            @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="email" class="form-control @error('email') is-invalid @enderror"/>
                            @error('email') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" name="phone" value="{{ old('phone') }}" placeholder="phone" class="form-control phone @error('phone') is-invalid @enderror"/>
                            @error('phone') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" name="website" value="{{ old('website') }}" placeholder="website" class="form-control @error('website') is-invalid @enderror"/>
                            @error('website') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" placeholder="address" class="form-control @error('address') is-invalid @enderror"/>
                            @error('address') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit">
                                Tambah Data
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
<script src="{{ asset('js/cleave.min.js') }}"></script>
<script src="cleave-phone.{ID}.js"></script>
<script>
    // import "cleave.js/dist/addons/cleave-phone.your-country-here";
    // import Cleave from 'cleave.js/react';
    // var cleave = new Cleave('.phone', {
    //     phone: true,
    //     phoneRegionCode: 'ID'
    // });
</script>
@endsection
