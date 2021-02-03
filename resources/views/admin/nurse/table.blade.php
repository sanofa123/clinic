@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Nurses
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
        Nurses data
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Nurse Data Table</h3>
              <a href="{{ route('admin.nurse.add') }}"> <button type="button" class="btn btn-success btn-flat pull-right"> ADD </button> </a>
            </div>
	        <!-- /.box-header -->
	        <div class="box-body">

	        			<table id="example1" class="table table-bordered table-striped">
	                		<thead>
			                <tr>
			                  <th>ID </th>
			                  <th>Name</th>
			                  <th>Email</th>
			                  <th>Mobile</th>
			                  <th>Salary</th>
			                  <th >Gender</th>
			                  <th>Birthday</th>
			                  <th>Clinic</th>
			                  <th>Updated At</th>
			                  <th>Status</th>
			                  <th>Controls</th>
			                </tr>
			                </thead>
			                <tbody>
								@foreach ($nurses as $nurse)
			                <?php $nurse = (object)$nurse; ?>
			                  <tr>
			                  	<td>{{ $nurse->id }}</td>
			                  	<td>{{ $nurse->name }}</td>
			                  	<td>{{ $nurse->email }}</td>
			                  	<td>{{ $nurse->mobile }}</td>
			                  	<td>{{ $nurse->salary }}</td>
			                  	<td>{{ $nurse->gender }}</td>
			                  	<td>{{ $nurse->date_of_birth }}</td>
			                  	<td>{{ $nurse->clinic_name }}</td>
		                  	<td>{{ $nurse->updated_at->diffForHumans() }}</td>
			                  	<td>
		                  		@if ($nurse->status)
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
			                  		<form action="{{ route('admin.nurse.status', $nurse->id)}}" method="POST">
								        @csrf
								        {{ method_field('PATCH') }}
								    </form>
		                  	</td>
								<td>
									<a href="{{ route('admin.nurse.update',$nurse->id) }}"><button type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button> </a>
									
									<a 
										href="#" 
										class="btn btn-danger btn-xs"
										onclick="
			                  					event.preventDefault();
			                  					if(confirm('Are you sure you want to delete this account?')) {
			                  						$(this).siblings('form').submit();
			                  					}"
									><i class="fa fa-times"></i></a>
									<form action="{{ route('admin.nurse.delete',$nurse->id) }}" method="POST">
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
			                  <th>Mobile</th>
			                  <th>Salary</th>
			                  <th>Gender</th>
			                  <th>Birthday</th>
			                  <th>Clinic</th>
			                  <th>Updated At</th>
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