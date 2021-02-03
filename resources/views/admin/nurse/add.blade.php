@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Add Nurse
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
      <p class="login-box-msg">Add a new nurse</p>

      <form  method="post" action="{{ route('admin.nurse.add') }}">
     	  @csrf

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Full name" value="{{ old('fullName') }}" name="fullName" required>
          <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
          <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
        </div>

         <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Mobile" value="{{ old('mobile') }}" name="mobile">
          <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder=" Birthday" value="{{ old('birthday') }}" name="birthday" id="datepicker">
          <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
        </div>
        
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Salary" value="{{ old('salary') }}" name="salary" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
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
          <label>Start Day:</label>
          <select class="form-control" name="start_day" required>
            <option value="">From</option>
              @for($i=0 ; $i<7 ; $i++)
                  <option value="{{ $week[$i] }}" {{ (old('start_day') == $week[$i] ) ? 'selected="selected"' : ''}}>{{ $week[$i] }}</option>
              @endfor
          </select>
        </div>

        <div class="form-group">
          <label>End Day:</label>
          <select class="form-control" name="end_day" required>
            <option value="">To</option>
              @for($i=0 ; $i<7 ; $i++)
                  <option value="{{ $week[$i] }}" {{ (old('end_day') == $week[$i] ) ? 'selected="selected"' : ''}}>{{ $week[$i] }}</option>
              @endfor
          </select>
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
      
        <div class="custom-control custom-radio">
          <input type="radio" value="female" id="customRadio1" name="gender" {{ (old('gender') == 'female') ? 'checked' : '' }} class="custom-control-input">
          <label class="custom-control-label" for="customRadio1">Female</label>
        </div>

        <div class="custom-control custom-radio">
          <input type="radio" value="male" name="gender" id="customRadio2" {{ (old('gender') == 'male') ? 'checked' : '' }} class="custom-control-input">
          <label class="custom-control-label" for="customRadio2">Male</label>
        </div>
              
        <button type="submit" class="btn btn-primary  btn-flat" style="">Register</button>
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