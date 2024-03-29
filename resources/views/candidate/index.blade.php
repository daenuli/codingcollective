@extends('layouts.app')

@push('styles')
	<link rel="stylesheet" href="{{asset('AdminLTE-2.4.15/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('AdminLTE-2.4.15/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('AdminLTE-2.4.15/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
    var table;
    $(function() {
        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{$ajax}}',
            order: [[6,'desc']],
            columns: [
                { data: 'id', searchable: false, orderable: false},
                { data: 'name', searchable: true, orderable: false},
                { data: 'email', searchable: true, orderable: false},
                { data: 'age', searchable: true, orderable: false},
                { data: 'applied_position', searchable: true, orderable: false},
                { data: 'resume', searchable: false, orderable: false},
                { data: 'created_at', searchable: true, orderable: true},
                { data: 'action', searchable: false, orderable: false}
            ],
            columnDefs: [{
                "targets": 0,
                "data": null,
                "render": function (data, type, full, meta) {
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            }],
        });
    });
    $(document).on('click', '.delete', function () {
		if (!confirm("Do you want to delete")){
	        return false;
	    }
	});
    </script>
@endpush

@section('content')

@if (session()->has('success'))
<div class="callout callout-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{!!session('success')!!}</p>
</div>
@endif

@if (session()->has('error'))
<div class="callout callout-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{!!session('error')!!}</p>
</div>
@endif

<div class="box">
	<div class="box-header with-border">
    @if(auth()->user()->role == 'senior_hrd')
        <a href="{{$create}}" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Create</a>
	@endif
    </div>
	<div class="box-body">
	  	<table id="dataTable" class="table table-bordered table-hover">
            <thead>
	            <tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Age</th>
					<th>Applied Position</th>
					<th>Resume</th>
					<th>Created At</th>
					<th>Action</th>
	            </tr>
            </thead>
            <tbody>
	        </tbody>
	    </table>
	</div>
</div>
@endsection