@extends('nurse.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Add Invoice
@endsection

@section('css')
	{{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/datepicker3.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/bootstrap-timepicker.min.css') }}">
@endsection

@section('body')
	{{-- here goes content of pages --}}
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach
      <p class="login-box-msg">Add a new invoice</p>

      <form  method="post" action="{{ route('nurse.invoice.add') }}">
     	  @csrf


        <div class="form-group">
          <select class="form-control" name="patient" required>
            <option value="">Choose Patient</option>
              @foreach ($patients as $patient)
                  <option value="{{ $patient->id }}" {{ (old('patient') == $patient->id ) ? 'selected="selected"' : ''}}>{{ $patient->name }}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <select class="form-control" name="clinic" required>
            <option value="">Choose Clinic</option>
              @foreach ($clinics as $clinic)
                  <option value="{{ $clinic->id }}" {{ (old('clinic') == $clinic->id ) ? 'selected="selected"' : ''}}>{{ $clinic->name }}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <select class="form-control" name="admin" required>
            <option value="">Choose Doctor</option>
              @foreach ($admins as $admin)
                  <option value="{{ $admin->id }}" {{ (old('admin') == $admin->id ) ? 'selected="selected"' : ''}}>{{ $admin->name }}</option>
              @endforeach
          </select>
        </div>


        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Price" value="{{ old('price') }}" name="price" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Tax" value="{{ old('tax') }}" name="tax" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>


        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Discount" value="{{ old('discount') }}" name="discount" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder=" Date" value="{{ old('day') }}" name="day" id="datepicker">
          <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
        </div>

        <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Time</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="time" value="{{ old('time') }}">

                    <div class="input-group-addon">
                      <i class="fas fa-clock"></i>
                    </div>
                  </div>
                </div>
        </div>

      
        
              
        <button type="submit" class="btn btn-primary  btn-flat" style="">ADD</button>
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