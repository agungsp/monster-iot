@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
    
@endsection

{{-- TITLE --}}
@section('title', 'Daftar User')

{{-- TITLE CONTENT --}}
@section('title-content', 'Daftar User')

{{-- CONTENT --}}
@section('content')
    <div class="orders">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mx-3 mt-3">
                        <h4 class="box-title">User </h4>
                        <a href="{{ url('user/create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $users as $user )
                                        <tr>
                                            <td class="serial">{{ $user->id }}</td>
                                            <td><span class="name">{{ $user->name }}</span></td>
                                            <td><span class="name">{{ $user->email }}</span></td>
                                            <td><span class="name">{{ $user->created_at }}</span></td>
                                            {{-- <td>
                                                <img src="{{ url($item->photo) }}">
                                            </td> --}}
                                            <td>
                                                <a href="{{ url('user/edit/'.$user->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url('user/delete/'.$user->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-5">
                                                Data Tidak Tersedia
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

@endsection
