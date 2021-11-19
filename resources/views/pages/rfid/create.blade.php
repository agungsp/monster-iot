@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'RFID')

{{-- TITLE CONTENT --}}
@section('title-content', 'RFID')

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
                    <form action="{{ url('rfid/store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="uuid" class="form-label">UUID</label>
                            <input type="text" name="uuid" value="{{ old('uuid') }}" class="form-control @error('uuid') is-invalid @enderror"/>
                            @error('uuid') <div class="text-muted">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="companies" class="form-label">Company</label>
                            @hasrole('superadmin')
                                <select name="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                    <option value="">- PILIH -</option>
                                    @foreach ($companies as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('company_id') == $item->id ? 'selected' : null }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endhasrole
                            @hasrole('admin')
                            <select class="form-control @error('company_id') is-invalid @enderror" disabled>
                                <option value="">- PILIH -</option>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('company_id', $userCompany) == $item->id ? 'selected' : null }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" id="company_id" name="company_id" value="{{ $userCompany }}" class="form-control" readonly/>
                            @endhasrole
                            @error('company_id') <div class="text-muted">{{ $message }}</div> @enderror
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
<script>
    var cleave = new Cleave('.number0', {
        numeral: true,
        // numeralThousandsGroupStyle: 'thousand'
        numeralDecimalMark: ',',
        delimiter: '.'
    });

    var cleave = new Cleave('.number1', {
        numeral: true,
        // numeralThousandsGroupStyle: 'thousand'
        numeralDecimalMark: ',',
        delimiter: '.'
    });

    var cleave = new Cleave('.number2', {
        numeral: true,
        // numeralThousandsGroupStyle: 'thousand'
        numeralDecimalMark: ',',
        delimiter: '.'
    });
</script>
@endsection
