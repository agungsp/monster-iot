@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custommodal_delete.css') }}">
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
    <a href="{{ url('company/create') }}" class="btn btn-success btn-sm float-end" title="Add">
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
                        <td><span class="name"> <a href="{{ $company->website }}" target="_blank"> {{ $company->website }} </a></span></td>
                        <td><span class="name">{{ $company->address }}</span></td>
                        <td>
                            <a href="{{ url('company/edit/'.Crypt::encrypt($company->id)) }}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger deletebtn btn-sm" value="{{ $company->id }}" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
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
            <form action="{{ url('company/destroy') }}" method="POST">
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();

        $(document).on('click', '.deletebtn', function() {
            var id = $(this).val();
            // alert(id);
            $('#deletemodal').modal('show');
            $('#deleting_id').val(id);
        });
    } );
</script>
@endsection
