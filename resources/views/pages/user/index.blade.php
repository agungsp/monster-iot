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
    <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-end">
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
                                <span class="name" style="color:blue">{{ str_replace(['["','"]'], '', $user->getRoleNames()); }}</span>
                            @elseif( str_replace(['["','"]'], '', $user->getRoleNames()) == 'admin')
                                <span class="name" style="color:red">{{ str_replace(['["','"]'], '', $user->getRoleNames()); }}</span>
                            @elseif( str_replace(['["','"]'], '', $user->getRoleNames()) == 'user')
                                <span class="name" style="color:green">{{ str_replace(['["','"]'], '', $user->getRoleNames()); }}</span>
                            @endif
                            </td>
                        <td>
                            <img src="{{ empty($user->avatar) ? 'https://ui-avatars.com/api/?name='.$user->name : asset('storage/'.$user->avatar) }}" class="img-thumbnail rounded-circle">
                        </td>
                        <td>
                            <a href="{{ url('user/edit/'.$user->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ url('user/destroy/'.$user->id) }}" method="post" class="d-inline" id="deleteData">
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
        $(document).on('click', '#deleteData', function()  {
            Swal.fire(
                'Good job!',
                'Data Has Been Deleted!',
                'success'
            );
        });

        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endsection

