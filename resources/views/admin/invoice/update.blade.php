@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Edit Invoice
@endsection

@section('css')
  {{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/datepicker3.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/bootstrap-timepicker.min.css') }}">
@endsection

@section('body')
  {{-- here goes content of pages --}}
@foreach ($errors->all() as $error)
  <div class="alert alert-danger">{{ $error }}</div>
@endforeach

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif
<section class="content">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title"> 
        Update Invoice data
      </h3>
    </div>
    <div class="box-body">
      <form method="post" action="{{ route('admin.invoice.update', $invoice->id) }}">
        @csrf
        {{ method_field('PATCH') }}
        
         <div class="form-group">
          <select class="form-control" name="patient" required>
            <option value="">Choose Patient</option>
              @foreach ($patients as $patient)
                  <option value="{{ $patient->id }}" {{ ($invoice->patient_id == $patient->id ) ? 'selected="selected"' : ''}}>{{ $patient->name }}</option>
              @endforeach
          </select>
        </div>

         <div class="form-group">
          <select class="form-control" name="clinic" required>
            <option value="">Choose Clinic</option>
              @foreach ($clinics as $clinic)
                  <option value="{{ $clinic->id }}" {{ ($invoice->clinic_id == $clinic->id ) ? 'selected="selected"' : ''}}>{{ $clinic->name }}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <select class="form-control" name="admin" required>
            <option value="">Choose Doctor</option>
              @foreach ($admins as $admin)
                  <option value="{{ $admin->id }}" {{ ($invoice->admin_id == $admin->id ) ? 'selected="selected"' : ''}}>{{ $admin->name }}</option>
              @endforeach
          </select>
        </div>


        <div class="form-group">
          <select class="form-control" name="nurse" required>
            <option value="">Choose Nurse</option>
              @foreach ($nurses as $nurse)
                  <option value="{{ $nurse->id }}" {{ ($invoice->nurse_id == $nurse->id ) ? 'selected="selected"' : ''}}>{{ $nurse->name }}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Price" value="{{ $invoice->total_price }}" name="price" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Tax" value="{{ $invoice->tax }}" name="tax" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Discount" value="{{ $invoice->discount }}" name="discount" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>


        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder=" Date" value="{{ $invoice->date }}" name="day" id="datepicker">
          <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
        </div>


        <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Time</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="time" value="{{ $invoice->time }}">

                    <div class="input-group-addon">
                      <i class="fas fa-clock"></i>
                    </div>
                  </div>
                </div>
        </div>


        
        <br>
        <button class="btn btn-primary">Update</button>
        
      </form>
    </div>
  </div>
</section>
@endsection

@section('js')
  {{-- here goes js files --}}
    <script src="{{ asset('/admin_styles/js/bootstrap-datepicker.js') }}"></script>
<script>
  $(function() {
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
      
    });
  </script>
  <!-- bootstrap time picker -->
<script src="{{ asset('/admin_styles/js/bootstrap-timepicker.min.js') }}"></script>
<script>
  $(function () {
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
@endsection