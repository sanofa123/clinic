@extends('admin.layouts.layout')

@section('title')
	Clinics
@endsection

@section('css')
	{{-- here goes the css of page --}}
  	<link rel="stylesheet" href="{{ asset('/admin_styles/css/dataTables.bootstrap.css') }}">

@endsection


@section('body' )
	{{-- here goes content of pages --}}
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

		<section class="content-header">
      <h1>
        Clinics data
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Clinics Data Table</h3>
              <a href="{{ route('admin.clinic.add') }}"> <button type="button" class="btn btn-success btn-flat pull-right"> ADD </button> </a>
            </div>
	        <!-- /.box-header -->
	        <div class="box-body">

	        			<table id="example1" class="table table-bordered table-striped">
	                		<thead>
			                <tr>
			                  <th>ID </th>
			                  <th>Name</th>
			                  <th>Email</th>
			                  <th>Phone</th>
			                  <th>Address</th>
			                  <th>Start Time</th>
			                  <th>End Time</th>
			                  <th>Created At</th>
			                  <th>Updated At</th>
			                  <th>Controls</th>
			                </tr>
			                </thead>
			                <tbody>
								@foreach ($clinics as $clinic)
			                <?php $clinic = (object)$clinic; ?>
			                  <tr>
			                  	<td>{{ $clinic->id }}</td>
			                  	<td>{{ $clinic->name }}</td>
			                  	<td>{{ $clinic->email }}</td>
			                  	<td>{{ $clinic->telephone }}</td>
			                  	<td>{{ $clinic->address }}</td>
			                  	<td>{{ $clinic->start_time }}</td>
			                  	<td>{{ $clinic->end_time }}</td>
			                  	<td>{{ $clinic->created_at->diffForHumans() }}</td>
		                  	<td>{{ $clinic->updated_at->diffForHumans() }}</td>
			                  	
								<td>
									<a href="{{ route('admin.clinic.update',$clinic->id) }}"><button type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button> </a>
									
									<a 
										href="#" 
										class="btn btn-danger btn-xs"
										onclick="
			                  					event.preventDefault();
			                  					if(confirm('Are you sure you want to delete this clinic?')) {
			                  						$(this).siblings('form').submit();
			                  					}"
									><i class="fa fa-times"></i></a>
									<form action="{{ route('admin.clinic.delete',$clinic->id) }}" method="POST">
								        @csrf
								        {{ method_field('DELETE') }}
								    </form>
								</td>
			                  </tr>
			              @endforeach
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th>ID </th>
			                  <th>Name</th>
			                  <th>Email</th>
			                  <th>Phone</th>
			                  <th>Address</th>
			                  <th>Start Time</th>
			                  <th>End Time</th>
			                  <th>Created At</th>
			                  <th>Updated At</th>
			                  <th>Controls</th>
			                </tr>
			                </tfoot>
	            		</table>
            		</div>
            	</div>
            </div>
        </div>
    </section>



@endsection

@section('js')
	{{-- here goes js files --}}
	<!-- DataTables -->
<script src="{{ asset('/admin_styles/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin_styles/js/dataTables.bootstrap.min.js') }}"></script>
<!-- page script -->
<script>
  $(function () {
    
    $('#example1').DataTable({
      	"paging": true,
      	"lengthChange": true,
      	"searching": true,
      	"ordering": true,
      	"info": false,
      	"autoWidth": false,
      	"order": [[ 0, "desc" ]]
    });
  });
</script>
@endsection