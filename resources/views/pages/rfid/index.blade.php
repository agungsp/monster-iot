@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custommodal_delete.css') }}">
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
    <a href="{{ url('rfid/create') }}" class="btn btn-success btn-sm float-end" title="Add">
        <i class="fa fa-plus"></i> Add
    </a>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th class="serial">#</th>
                <th>UUID</th>
                <th>Brand</th>
                <th>Type</th>
                <th>SN</th>
                <th>Buy At</th>
                <th>Expired At</th>
                <th>KM Start</th>
                <th>KM End</th>
                <th>Kondisi</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        {{--  <tbody>
            @if($savedata->count() > 0)
                @foreach ( $savedata as $key => $rfid )
                    <tr>
                        <td class="serial">{{ $savedata->firstItem() + $key }}</td>
                        <td><span class="uuid">{{ $rfid->uuid }}</span></td>
                        <td><span class="brand">{{ $rfid->brand }}</span></td>
                        <td><span class="type">{{ $rfid->type }}</span></td>
                        <td><span class="sn">{{ $rfid->sn }}</span></td>
                        <td><span class="buy_at">{{ $rfid->buy_at }}</span></td>
                        ----------------------------------
                        <td>
                            @if(now() >= $rfid->expired_at)
                                <span class="expired_at" style="background-color: red;">{{ $rfid->expired_at }}</span>
                            @elseif(now() >= $expired_at && now() < $rfid->expired_at )
                                <span class="expired_at" style="background-color: yellow;">{{ $rfid->expired_at }}</span>
                            @else
                                <span class="expired_at">{{ $rfid->expired_at }}</span>
                            @endif
                        </td>
                        ----------------------------------
                        <td><span class="expired_at">{{ $rfid->expired_at }}</span></td>
                        <td><span class="kilometer_start">{{ $rfid->kilometer_start }}</span></td>
                        <td><span class="kilometer_end">{{ $rfid->kilometer_end }}</span></td>
                        <td><span class="is_broken">{{ $rfid->is_broken }}</span></td>
                        <td>
                            <a href="{{ url('rfid/edit/'.Crypt::encrypt($rfid->id)) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger deletebtn btn-sm" value="{{ $rfid->id }}" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="11" class="text-center">Data Kosong</td>
                </tr>
            @endif
        </tbody>  --}}
    </table>
@endsection

{{-- MODAL --}}
@section('modal')
    {{-- Delete Modal --}}
    <div class="modal" id="deletemodal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('rfid/destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="title">
                    <h4 style="margin-left: 15px;">Are you sure delete data?</h4>
                </div>
                <input type="hidden" id="deleting_id" name="DeleteData_ByID">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete Data</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
    {{-- End Delete Modal --}}
@endsection

{{-- JS --}}
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>  --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing  : true,
            serverSide  : true,
            ajax        : "{{ url('rfid/getRfid') }}",
            columns     : [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'uuid', name: 'uuid'},
                {data: 'brand', name: 'brand'},
                {data: 'type', name: 'type'},
                {data: 'sn', name: 'sn'},
                {data: 'buy_at', name: 'buy_at'},
                {data: 'expired_at', name: 'expired_at', type: 'html'},
                {data: 'kilometer_start', name: 'kilometer_start'},
                {data: 'kilometer_end', name: 'kilometer_end'},
                {data: 'is_broken', name: 'is_broken'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {
                    data: 'action',
                    name: 'action',
                    type: 'html',
                    orderable: false,
                    searchable: false,
                },
            ],
            // "createdRow": function( row, data, index ) {
            //     if ( data.kilometer_end > "10" ) {
            //         $(row).addClass( 'redRow' );
            //     }
            // },
            // "createdRow": function ( row, data, index ) {
            //     if ( data[5].replace(/[\$,]/g, '') * 1 > 10 ) {
            //         $('td', row).eq(5).addClass('highlight');
            //     }
            // }
        });

        $(document).on('click', '.deletebtn', function() {
            var id = $(this).val();
            // alert(id);
            $('#deletemodal').modal('show');
            $('#deleting_id').val(id);
        });
    } );
</script>
@endsection

