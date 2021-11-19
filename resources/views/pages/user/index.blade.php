@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
    <style>
        .img-thumbnail{
            height: 50px !important;
            width: 50px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custommodal_delete.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

{{-- TITLE --}}
@section('title', 'Users')

{{-- TITLE CONTENT --}}
@section('title-content', 'Users')

{{-- CONTENT --}}
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-end" title="Add">
        <i class="fa fa-plus"></i> Add
    </a>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th class="serial">#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Company</th>
                <th>Role</th>
                <th>Avatar</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
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
            <form action="{{ url('user/destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="title">
                    <h4 style="margin-left: 15px;">Are you sure delete data?</h4>
                </div>
                <input type="text" id="deleting_id" name="DeleteData_ByID">
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                scrollX   : true,
                autoWidth : false,
                ajax: "{{ url('user/getUser') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'users.name'},
                    {data: 'email', name: 'email'},
                    {data: 'company', name: 'companies.name'},
                    {data: 'role', name: 'roles.name', type: 'html'},
                    {data: 'avatar', name: 'avatar', type: 'html', orderable: false, searchable: false},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {
                        data: 'action',
                        name: 'action',
                        type: 'html',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $(document).on('click', '.deletebtn', function() {
                var id = $(this).val();
                // alert(id);
                $('#deletemodal').modal('show');
                $('#deleting_id').val(id);
            });
        });

        $(function() {
            $('.toggle-one').bootstrapToggle();
        })
    </script>
@endsection

