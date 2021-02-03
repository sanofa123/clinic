@extends('nurse.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Patients data
@endsection

@section('css')
	{{-- here goes the css of page --}}
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('/nurse_styles/css/dataTables.bootstrap.css') }}">
@endsection


@section('body' )
	{{-- here goes content of pages --}}
	@if (session('status'))
		<div class="alert alert-success">{{ session('status') }}</div>
	@endif

	        		
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Patient Data Table</h3>
              <a href="{{ route('nurse.patient.add') }}"> <button type="button" class="btn btn-success btn-flat pull-right"> ADD </button> </a>
            </div>
	        <!-- /.box-header -->
	        <div class="box-body">

	        	<table id="example1" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                  <th>ID</th>
		                  <th>Name</th>
		                  <th>Email</th>
		                  <th>Mobile</th>
		                  <th>Gender</th>
		                  <th>Birthday</th>
		                  <th>Updated at</th>
		                  <th>Status</th>
		                  <th>Controls</th>
		                </tr>
		                </thead>
		                <tbody>
							@foreach ($patients as $patient)
			                  <tr>
			                  	<td>{{ $patient->id }}</td>
			                  	<td>{{ $patient->name }}</td>
			                  	<td>{{ $patient->email }}</td>
			                  	<td>{{ $patient->mobile }}</td>
			                  	<td>{{ ucfirst($patient->gender) }}</td>
			                  	<td>{{ $patient->date_of_birth }}</td>
			                  	<td>{{ $patient->updated_at->diffForHumans() }}</td>
			                  	<td>
									@if ($patient->status)
			                  			<a 
			                  				href="#" 
			                  				class="btn btn-success btn-xs" 
			                  				onclick="
			                  					event.preventDefault();
			                  					if(confirm('Are you sure you want to deactivate this account?')) {
			                  						$(this).siblings('form').submit();
			                  					}"
			                  			>Active</a>
			                  		@else
			                  			<a 
			                  				href="#" 
			                  				class="btn btn-danger btn-xs" 
			                  				onclick="
			                  					event.preventDefault();
			                  					if(confirm('Are you sure you want to activate this account?')) {
			                  						$(this).siblings('form').submit();
			                  					}"
			                  			>Inactive</a>
			                  		@endif
			                  		<form action="{{ route('nurse.patient.update.status', $patient->id)}}" method="POST">
								        @csrf
								        {{ method_field('PATCH') }}
								    </form>
			                  	</td>
								<td>
									<a href="{{ route('nurse.patient.update',  $patient->id ) }}"  class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
									<a href="{{ route('nurse.patient.file', $patient->id) }}"  class="btn btn-warning btn-xs"><i class="fa fa-file-pdf"></i></a>
									<a 
										href="#" 
										class="btn btn-danger btn-xs"
										onclick="
			                  					event.preventDefault();
			                  					if(confirm('Are you sure you want to delete this account?')) {
			                  						$(this).siblings('form').submit();
			                  					}"
									><i class="fa fa-times"></i></a>
									<form action="{{ route('nurse.patient.delete',$patient->id) }}" method="POST">
								        @csrf
								        {{ method_field('DELETE') }}
								    </form>
								</td>
			                  </tr>
		              		@endforeach
		                </tbody>
		                <tfoot>
			                <tr>
			                  <th>ID</th>
			                  <th>Name</th>
			                  <th>Email</th>
			                  <th>Mobile</th>
			                  <th>Gender</th>
			                  <th>Birthday</th>
			                  <th>Updated at</th>
			                  <th>Status</th>
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
<script src="{{ asset('/nurse_styles/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/nurse_styles/js/dataTables.bootstrap.min.js') }}"></script>
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