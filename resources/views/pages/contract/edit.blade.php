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
    <div class="card">
        <div class="card-header">
            <strong>Edit Contract</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('contract/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="company_id" class="form-control-label">Company ID</label>
                    <input type="text" name="company_id" value="{{ old('company_id', $contract->company_id) }}" class="form-control @error('company_id') is-invalid @enderror"/>
                    @error('company_id') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="started_at" class="form-control-label">Started At</label>
                    <input type="date" name="started_at" value="{{ Carbon\Carbon::create($contract->started_at)->toDateString() }}" class="form-control @error('started_at') is-invalid @enderror"/>
                    @error('started_at') <div class="text-muted">{{ $message }}</div> @enderror
                    {{-- @dd($contract) --}}
                </div>
                <div class="form-group">
                    <label for="expired_at" class="form-control-label">Expired At</label>
                    <input type="date" name="expired_at" value="{{ Carbon\Carbon::create($contract->started_at)->toDateString() }}" class="form-control @error('expired_at') is-invalid @enderror"/>
                    @error('expired_at') <div class="text-muted">{{ $message }}</div> @enderror
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
