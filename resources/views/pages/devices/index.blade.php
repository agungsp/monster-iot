@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custommodal_delete.css') }}">
@endsection

{{-- TITLE --}}
@section('title', 'Devices')

{{-- TITLE CONTENT --}}
@section('title-content', 'Devices')
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- CONTENT --}}
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @can('createDevices')
        <a href="{{ url('devices/create') }}" class="btn btn-success btn-sm float-end" title="Add">
            <i class="fa fa-plus"></i> Add
        </a>
    @endcan
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th class="serial">#</th>
                <th>UUID</th>
                <th>Alias</th>
                <th>Tersedia</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        {{--  <tbody>
            @forelse ( $devices as $device )
                <tr class="delete_mem{{ $device  }}">
                    <td class="serial">{{ $device->id }}</td>
                    <td><span class="name">{{ $device->uuid }}</span></td>
                    <td><span class="name">{{ $device->alias }}</span></td>
                    @if($device->is_available == 1)
                        <td><span class="name badge bg-success">Tersedia</span></td>
                    @else
                        <td><span class="name badge bg-danger">Tidak Tersedia</span></td>
                    @endif
                    <td><span class="name">{{ $device->created_at }}</span></td>
                    <td>
                        <a href="{{ url('devices/edit/'.Crypt::encrypt($device->id)) }}" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger deletebtn btn-sm" value="{{ $device->id }}" title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-5">
                        Data Tidak Tersedia
                    </td>
                </tr>
            @endforelse
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
            <form action="{{ url('devices/destroy') }}" method="POST">
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
            ajax        : "{{ url('devices/getDevices') }}",
            columns     : [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'uuid', name: 'uuid'},
                {data: 'alias', name: 'alias'},
                {data: 'statusdevice', name: 'statusdevice', type: 'html'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {
                    data: 'action',
                    name: 'action',
                    type: 'html',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(document).on('click', '.deletebtn', function() {
            var id = $(this).val();
            // alert(id);
            $('#deletemodal').modal('show');
            $('#deleting_id').val(id);
        });
    });
</script>
{{-- <script>
    // DELETE COUNTRY RECORD
    $(document).on('click', '#deleteData', function() {
        var data_id = $(this).attr('data-id');
        // var url = '<?= url("devices/destroy/'+ data_id +'") ?>';
        Swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this country',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 300,
            allowOutsideClick: false
        }).then(function(result) {
            if(result.value) {
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: "devices/destroy/"+data_id,
                    type: 'DELETE',
                    data: {
                        "id": data_id,
                        "_token": token,
                    },
                    cache: false,
                    success: function (){
                        $('#datatable').DataTable().ajax.reload(null, false);
                        // $(".delete_mem" + id).fadeOut('slow');
                        console.log("it Works");
                    }
                });
            }
        });
    });
</script> --}}
@endsection
