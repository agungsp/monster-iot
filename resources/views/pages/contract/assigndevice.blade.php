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

{{-- CONTENT --}}
@section('content')
    
    <form action="{{ url('contract/updatedevice', $savedata[$id]->id) }}" method="POST">
        @method('patch')
        @csrf
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>UUID</th>
                    <th>Alias Devices</th>
                </tr>
            </thead>
            <tbody>
                @if($savedata->count() > 0)
                    @foreach ( $savedata as $contract )
                        {{-- @dd($contract) --}}
                        <tr>
                            <td class="serial">{{ $contract->id }}</td>
                            <td><span class="name">{{ $contract->devices->uuid }}</span></td>
                            {{-- <input type="hidden" name="uuid" value="{{ old('uuid', $contract->devices->uuid) }}" class="form-control @error('uuid') is-invalid @enderror"/> --}}
                            <td>
                                <span class="alias">
                                    <input type="text" name="alias" value="{{ old('alias') }}" class="form-control @error('alias') is-invalid @enderror"/>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                     <tr>
                        <td colspan="5" class="text-center">Data Kosong</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- <input type="text" name="jumlahdevice" value="{{ $jumlahdevice }}"> --}}
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">
                Edit Data
            </button>
        </div>
    </form>
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
{{--  <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script>  --}}
@endsection

