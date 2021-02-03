@extends('user.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Invoices
@endsection

@section('css')
	{{-- here goes the css of page --}}
  	<link rel="stylesheet" href="{{ asset('/admin_styles/css/dataTables.bootstrap.css') }}">

@endsection


@section('body' )  {{-- here goes content of pages --}}

<section class="container">
 <div class="box box-primary">
  <div class="box-body">
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach
      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content" style="margin-top: 100px; margin-bottom: 500px;">
      <h1 style="margin:20px;">
        Invoices
      </h1>

	        			<table id="example1" class="table table-bordered table-striped" style="margin-top:20px;">
	                		<thead>
			                <tr>
			                  <th>ID </th>
			                  <th>Doctor</th>
			                  <th>Nurse</th>
			                  <th>Clinic</th>
			                  <th>Price</th>
			                  <th>Tax</th>
			                  <th>Discount</th>
			                  <th>Date</th>
			                  <th>Print</th>
			                </tr>
			                </thead>
			                <tbody>
								@foreach ($invoices as $invoice)
			                <?php $invoice = (object)$invoice; ?>
			                  <tr>
			                  	<td>{{ $invoice->id }}</td>
			                  	<td>{{ $invoice->admin_name }}</td>
			                  	<td>{{ $invoice->nurse_name }}</td>
			                  	<td>{{ $invoice->clinic_name }}</td>
			                  	<td>{{ $invoice->total_price }}</td>
			                  	<td>{{ $invoice->tax }}</td>
			                  	<td>{{ $invoice->discount }}</td>
			                  	<td>{{ $invoice->day }}</td>
			                  	
								<td>

								    <a href="{{ route('patient.invoice.show',$invoice->id) }}"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-print"></i></button> </a>
								</td>
			                  </tr>
			              @endforeach
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th>ID </th>
			                  <th>Doctor</th>
			                  <th>Nurse</th>
			                  <th>Clinic</th>
			                  <th>Price</th>
			                  <th>Tax</th>
			                  <th>Discount</th>
			                  <th>Date</th>
			                  <th>Print</th>
			                </tr>
			                </tfoot>
	            		</table>
            		 </section>
    <!-- /.content -->
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