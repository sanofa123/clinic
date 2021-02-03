@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Categories
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
        Categories data
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Categories Data Table</h3>
              <a href="{{ route('admin.category.add') }}"> <button type="button" class="btn btn-success btn-flat pull-right"> ADD </button> </a>
            </div>
	        <!-- /.box-header -->
	        <div class="box-body">

	        			<table id="example1" class="table table-bordered table-striped">
	                		<thead>
			                <tr>
			                  <th>ID </th>
			                  <th>Name</th>
			                  <th>Created At</th>
			                  <th>Updated At</th>
			                  <th>Controls</th>
			                </tr>
			                </thead>
			                <tbody>
								@foreach ($categories as $category)
			                <?php $category = (object)$category; ?>
			                  <tr>
			                  	<td>{{ $category->id }}</td>
			                  	<td>{{ $category->name }}</td>
		                  	<td>{{ $category->created_at->diffForHumans() }}</td>
		                  	<td>{{ $category->updated_at->diffForHumans() }}</td>
			                  	
								<td>
									<a href="{{ route('admin.category.update',$category->id) }}"><button type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button> </a>
									
									<a 
										href="#" 
										class="btn btn-danger btn-xs"
										onclick="
			                  					event.preventDefault();
			                  					if(confirm('Are you sure you want to delete this category?')) {
			                  						$(this).siblings('form').submit();
			                  					}"
									><i class="fa fa-times"></i></a>
									<form action="{{ route('admin.category.delete',$category->id) }}" method="POST">
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
    });
  });
</script>
@endsection