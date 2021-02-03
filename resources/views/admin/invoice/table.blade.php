  
@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Invoices
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
        Invoices data
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Invoice Data Table</h3>
              <a href="{{ route('admin.invoice.add') }}"> <button type="button" class="btn btn-success btn-flat pull-right"> ADD </button> </a>
            </div>
	        <!-- /.box-header -->
	        <div class="box-body">

	        			<table id="example1" class="table table-bordered table-striped">
	                		<thead>
			                <tr>
			                  <th>ID </th>
			                  <th>Patient</th>
			                  <th>Doctor</th>
			                  <th>Nurse</th>
			                  <th>Clinic</th>
			                  <th>Price</th>
			                  <th>Tax</th>
			                  <th>Discount</th>
			                  <th>Date</th>
			                  <th>Created At</th>
			                  <th>Updated At</th>
			                  <th>Controls</th>
			                </tr>
			                </thead>
			                <tbody>
								@foreach ($invoices as $invoice)
			                <?php $invoice = (object)$invoice; ?>
			                  <tr>
			                  	<td>{{ $invoice->id }}</td>
			                  	<td>{{ $invoice->patient_name }}</td>
			                  	<td>{{ $invoice->admin_name }}</td>
			                  	<td>{{ $invoice->nurse_name }}</td>
			                  	<td>{{ $invoice->clinic_name }}</td>
			                  	<td>{{ $invoice->total_price }}</td>
			                  	<td>{{ $invoice->tax }}</td>
			                  	<td>{{ $invoice->discount }}</td>
			                  	<td>{{ $invoice->day }}</td>
		                  	<td>{{ $invoice->created_at->diffForHumans() }}</td>
		                  	<td>{{ $invoice->updated_at->diffForHumans() }}</td>
			                  	
								<td>
									<a href="{{ route('admin.invoice.update',$invoice->id) }}"><button type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button> </a>
									
									<a 
										href="#" 
										class="btn btn-danger btn-xs"
										onclick="
			                  					event.preventDefault();
			                  					if(confirm('Are you sure you want to delete this invoice?')) {
			                  						$(this).siblings('form').submit();
			                  					}"
									><i class="fa fa-times"></i></a>
									<form action="{{ route('admin.invoice.delete',$invoice->id) }}" method="POST">
								        @csrf
								        {{ method_field('DELETE') }}
								    </form>

								    <a href="{{ route('admin.invoice.show',$invoice->id) }}"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-print"></i></button> </a>
								</td>
			                  </tr>
			              @endforeach
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th>ID </th>
			                  <th>Patient</th>
			                  <th>Doctor</th>
			                  <th>Nurse</th>
			                  <th>Clinic</th>
			                  <th>Price</th>
			                  <th>Tax</th>
			                  <th>Discount</th>
			                  <th>Date</th>
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