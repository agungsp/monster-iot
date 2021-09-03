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
                    <form action="{{ url('contract/update', $contract->id) }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label for="companmies" class="form-label">Company</label>
                            <select name="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="">- PILIH -</option>
                                @foreach ($company as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('company_id', $contract->company_id) == $item->id ? 'selected' : null }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="started_at" class="form-label">Started At</label>
                            <input type="date" name="started_at" value="{{ Carbon\Carbon::create($contract->started_at)->toDateString() }}" class="form-control @error('started_at') is-invalid @enderror"/>
                            @error('started_at') <div class="text-muted">{{ $message }}</div> @enderror
                            {{-- @dd($contract) --}}
                        </div>
                        <div class="mb-3">
                            <label for="expired_at" class="form-label">Expired At</label>
                            <input type="date" name="expired_at" value="{{ Carbon\Carbon::create($contract->expired_at)->toDateString() }}" class="form-control @error('expired_at') is-invalid @enderror"/>
                            @error('expired_at') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Devices</label>
                            <input type="number" name="jumlah" value="{{ old('jumlah', $contract->jumlah) }}" class="form-control @error('jumlah') is-invalid @enderror"/>
                            @error('jumlah') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="5">{{ old('keterangan') }}</textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit">
                                Edit Data
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
