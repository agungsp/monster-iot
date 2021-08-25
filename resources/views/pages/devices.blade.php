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
  <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>UUID</th>
            <th>Pintu 1</th>
            <th>Pintu 2</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($devices as $device)
        <tr>
            <td>{{ $device->uuid }}</td>
            <td>{{ $device->door1_state }}</td>
            <td>{{ $device->door2_state }}</td>
            <td>
                <a href="/pegawai/edit/{{ $device->id }}" class="btn btn-warning">Edit</a>
                <a href="/pegawai/hapus/{{ $device->id }}" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="text-left">
    {!! $devices->links() !!}
  </div>
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')

@endsection