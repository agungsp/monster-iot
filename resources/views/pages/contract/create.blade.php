@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Contract')

{{-- TITLE CONTENT --}}
@section('title-content', 'Contract')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('contract/store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="companies" class="form-label">Company</label>
                            <select name="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="">- PILIH -</option>
                                @foreach ($contract as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : null }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="started_at" class="form-label">Started At</label>
                                <input type="date" name="started_at" value="{{ old('started_at') }}" class="form-control @error('started_at') is-invalid @enderror"/>
                                @error('started_at') <div class="text-muted">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="expired_at" class="form-label">Expired At</label>
                                <input type="date" name="expired_at" value="{{ old('expired_at') }}" class="form-control @error('expired_at') is-invalid @enderror"/>
                                @error('expired_at') <div class="text-muted">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Devices</label>
                            <input type="number" name="jumlah" value="{{ old('jumlah') }}" placeholder="jumlah device" class="form-control @error('jumlah') is-invalid @enderror"/>
                            @error('jumlah') <div class="text-muted">{{ $message }}</div> @enderror
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

@endsection
