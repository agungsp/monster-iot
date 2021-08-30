@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Company')

{{-- TITLE CONTENT --}}
@section('title-content', 'Company')

{{-- CONTENT --}}
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <a href="{{ url('company/create') }}" class="btn btn-success btn-sm float-end">
        <i class="fa fa-plus"></i> Add
    </a>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th class="serial">#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($companies->count() > 0)
                @foreach ( $companies as $key => $company )
                    <tr>
                        <td class="serial">{{ $companies->firstItem() + $key }}</td>
                        <td><span class="name">{{ $company->name }}</span></td>
                        <td><span class="name">{{ $company->email }}</span></td>
                        <td><span class="name">{{ $company->phone }}</span></td>
                        <td><span class="name">{{ $company->website }}</span></td>
                        <td><span class="name">{{ $company->address }}</span></td>
                        <td>
                            <a href="{{ url('company/edit/'.Crypt::encrypt($company->id)) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ url('company/destroy/'.$company->id) }}" method="post" class="d-inline">
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
