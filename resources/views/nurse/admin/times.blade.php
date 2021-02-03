@extends('nurse.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Doctors
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

    <!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
          		<div class="box box-primary">
            		<div class="box-header">
              			<h3 class="box-title">Doctors Working Times</h3>
            		</div>
	        		<!-- /.box-header -->
	        		<div class="box-body">

		        		<table id="example1" class="table table-bordered table-striped">
		                	<thead>
				                <tr>
				                  	<th>Name</th>
				                  	<th>Start Day</th>
				                  	<th>End Day</th>
				                  	<th>Start Time</th>
				                  	<th>End Time</th>
				                </tr>
				            </thead>
				            <tbody>
								@foreach ($admins as $admin)
				                  	<tr>
				                  		<td>{{ $admin->name }}</td>
				                  		<td>{{ $admin->start_day }}</td>
				                  		<td>{{ $admin->end_day }}</td>
			                  			<td>{{ $admin->start_time }}</td>
			                  			<td>{{ $admin->end_time }}</td>
				                  </tr>
				              @endforeach
				            </tbody>
				            <tfoot>
				                <tr>
				                  	<th>Name</th>
				                  	<th>Start Day</th>
				                  	<th>End Day</th>
				                  	<th>Start Time</th>
				                  	<th>End Time</th>
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