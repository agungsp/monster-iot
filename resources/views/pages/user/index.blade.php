@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

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
                        <td>
                            <img src="{{ empty($user->avatar) ? 'https://ui-avatars.com/api/?name='.$user->name : asset('storage/'.$user->avatar) }}" class="img-thumbnail" width="50px;">
                        </td>
                        <td>
                            <a href="{{ url('user/edit/'.$user->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ url('user/destroy/'.$user->id) }}" method="post" class="d-inline">
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
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        );
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endsection

