@extends('admin.layouts.layout')

@section('title')
	
	Add Clinic
@endsection

@section('css')
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
      <p class="login-box-msg">Add a new clinic</p>

      <form  method="post" action="{{ route('admin.clinic.add') }}">
     	  @csrf

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Clinic's Name" value="{{ old('name') }}" name="name" required>
          <span class="form-control-feedback"><i class="fa fa-hospital"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

         <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Phone" value="{{ old('phone') }}" name="phone">
          <span class="form-control-feedback"><i class="fas fa-phone"></i></span>
        </div>

        
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Address" value="{{ old('address') }}" name="address" required>
          <span class="form-control-feedback"><i class="fas fa-map-marker"></i></span>
        </div>

        <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Start Time:</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="start_time" value="{{ old('start_time') }}">

                    <div class="input-group-addon">
                      <i class="fas fa-clock"></i>
                    </div>
                  </div>
                </div>
        </div>

        <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>End Time:</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="end_time" value="{{ old('end_time') }}">

                    <div class="input-group-addon">
                      <i class="fas fa-clock"></i>
                    </div>
                  </div>
                </div>
        </div>
              
        <button type="submit" class="btn btn-primary  btn-flat" style="">Register</button>
      </form>

    </div>
  </div>
</section>

	
@endsection

@section('js')
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