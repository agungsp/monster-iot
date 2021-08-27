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

{{-- CONTENT --}}
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @can('createRFID')
        <a href="{{ url('rfid/create') }}" class="btn btn-success btn-sm float-end">
            <i class="fa fa-plus"></i> Add
        </a>
    @endcan
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th class="serial">#</th>
                <th>UUID</th>
                <th>Brand</th>
                <th>Type</th>
                <th>SN</th>
                <th>Buy At</th>
                <th>KM Start</th>
                <th>KM End</th>
                <th>Is Broken</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($savedata->count() > 0)
                @foreach ( $savedata as $key => $rfid )
                    <tr>
                        <td class="serial">{{ $savedata->firstItem() + $key }}</td>
                        <td><span class="uuid">{{ $rfid->uuid }}</span></td>
                        <td><span class="brand">{{ $rfid->brand }}</span></td>
                        <td><span class="type">{{ $rfid->type }}</span></td>
                        <td><span class="sn">{{ $rfid->sn }}</span></td>
                        <td><span class="buy_at">{{ $rfid->buy_at }}</span></td>
                        <td><span class="kilometer_start">{{ $rfid->kilometer_start }}</span></td>
                        <td><span class="kilometer_end">{{ $rfid->kilometer_end }}</span></td>
                        <td><span class="is_broken">{{ $rfid->is_broken }}</span></td>
                        <td>
                            <a href="{{ url('rfid/edit/'.$rfid->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ url('rfid/destroy/'.$rfid->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
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
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script>
@endsection

