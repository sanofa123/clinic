@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Notifications
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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Notifications</h3>
            </div>
	        <!-- /.box-header -->
	        <div class="box-body">

	        			<table id="example1" class="table table-bordered table-striped">
	                		<thead>
			                <tr>
			                	<th>Content </th>
			                    <th>Mark as Read</th>
			                    <th>Delete</th>
			                </tr>
			                </thead>
			                <tbody>
								@foreach ($notifications as $notification)
			                
			                  <tr>
			                  	<td>@if ($notification->read_at)
                        	<i class="fa fa-medkit"></i> {{$notification->data['content']}}
                        
                        @else
                <b><i class="fa fa-medkit"></i> {{$notification->data['content']}}</b>
              
                        @endif</td>
			                  	
								<td>
									<a href="{{ route('admin.notification.mark',$notification->id) }}"><button type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button> </a>
								</td>
								<td>
									<a 
										href="#" 
										class="btn btn-danger btn-xs"
										onclick="
			                  					event.preventDefault();
			                  					if(confirm('Are you sure you want to delete this notification?')) {
			                  						$(this).siblings('form').submit();
			                  					}"
									><i class="fa fa-times"></i></a>
									<form action="{{ route('admin.notification.delete',$notification->id) }}" method="POST">
								        @csrf
								        {{ method_field('DELETE') }}
								    </form>
									
								</td>
			                  </tr>
			              @endforeach
			                </tbody>
			                
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
      	"autoWidth": true
    });
  });
</script>
@endsection