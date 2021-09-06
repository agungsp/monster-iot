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
    <a href="{{ route('user.trash') }}" class="btn btn-danger btn-sm float-end" title="Trash">
        <i class="fa fa-trash"></i> Trash
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($users->count() > 0)
                @foreach ( $users as $key => $user )
                    <tr>
                        <td class="serial">{{ $users->firstItem() + $key }}</td>
                        <td><span class="name">{{ $user->name }}</span></td>
                        <td><span class="name">{{ $user->email }}</span></td>
                        <td><span class="name">{{ empty($user->company_id) ? '' : $user->company->name}}</span></td>
                        <td>
                            @if( str_replace(['["','"]'], '', $user->getRoleNames()) == 'superadmin')
                                <span class="name badge bg-primary">{{ str_replace(['["','"]'], '', $user->getRoleNames()); }}</span>
                            @elseif( str_replace(['["','"]'], '', $user->getRoleNames()) == 'admin')
                                <span class="name badge bg-warning text-dark">{{ str_replace(['["','"]'], '', $user->getRoleNames()); }}</span>
                            @elseif( str_replace(['["','"]'], '', $user->getRoleNames()) == 'user')
                                <span class="name badge bg-danger">{{ str_replace(['["','"]'], '', $user->getRoleNames()); }}</span>
                            @endif
                        </td>
                        <td>
                            <img src="{{ empty($user->avatar) ? 'https://ui-avatars.com/api/?name='.$user->name : asset('storage/'.$user->avatar) }}" class="img-thumbnail rounded-circle">
                        </td>
                        <td>
                            @if ($user->is_active == 1)
                                <span class="name badge bg-success">Aktif</span>
                            @else
                                <span class="name badge bg-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            {{-- <a href="{{ url('user/edit/'.Crypt::encrypt($user->id)) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a> --}}
                            @hasrole('superadmin')
                                <a href="{{ url('user/edit/'.Crypt::encrypt($user->id)) }}" class="btn btn-primary btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger deletebtn btn-sm" value="{{ $user->id }}" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endhasrole
                            @hasrole('admin')
                                @if(str_replace(['["','"]'], '', $user->getRoleNames()) != 'admin' && Auth::user()->id != $user->id)
                                    <a href="{{ url('user/edit/'.Crypt::encrypt($user->id)) }}" class="btn btn-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger deletebtn btn-sm" value="{{ $user->id }}" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @elseif(str_replace(['["','"]'], '', $user->getRoleNames()) == 'admin' && Auth::user()->id == $user->id)
                                    <a href="{{ url('user/edit/'.Crypt::encrypt($user->id)) }}" class="btn btn-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif      
                            @endhasrole
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();

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

