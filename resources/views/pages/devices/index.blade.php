@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Contact')

{{-- TITLE CONTENT --}}
@section('title-content', 'Contact')

{{-- CONTENT --}}
@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <h4 class="box-title">Daftar User </h4>
                        <a href="{{ url('devices/create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>UUID</th>
                                        <th>Alias</th>
                                        <th>Tersedia</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $devices as $device )
                                        <tr>
                                            <td class="serial">{{ $device->id }}</td>
                                            <td><span class="name">{{ $device->uuid }}</span></td>
                                            <td><span class="name">{{ $device->alias }}</span></td>
                                            @if($device->is_available == 1)
                                                <td><span class="name">Tersedia</span></td>
                                            @else
                                                <td><span class="name">Tidak Tersedia</span></td>
                                            @endif
                                            <td><span class="name">{{ $device->created_at }}</span></td>
                                            {{-- <td>
                                                <img src="{{ url($item->photo) }}">
                                            </td> --}}
                                            <td>
                                                <a href="{{ url('devices/edit/'.$device->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url('devices/delete/'.$device->id) }}" method="post" class="d-inline">
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

@endsection
