@extends('admin.layouts.layout')

@section('title')
    Register a new admin
@endsection

@section('css')
  {{-- here goes the css of page --}}
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

      <p class="login-box-msg">Register a new admin</p>

      <form  method="post" action="{{ route('admin.admin.add') }}">
        @csrf

        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ old('fullName') }}" placeholder="Full name" name="fullName" required>
          <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" required class="form-control" placeholder="Password" name="password">
          <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" required class="form-control" name="password_confirmation" placeholder="Confirm password">
          <span class="form-control-feedback"><i class="fa fa-lock"></i></span>
        </div>

         <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile" name="mobile">
          <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
        </div>

        <div class="form-group">
          <select class="form-control" name="role" required>
            <option value="">Choose Role</option>
            <option value="super" {{ (old('role') == 'super' ) ? 'selected="selected"' : ''}}>Owner</option>
            <option value="doctor" {{ (old('role') == 'doctor' ) ? 'selected="selected"' : ''}}>Doctor</option>
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

        <div class="form-group">
                  <label>About:</label>
                  <textarea class="form-control" rows="3" placeholder="Info , Education ....." required name="about" value="{{ old('end_time') }}"></textarea>
        </div>

        <button type="submit" class="btn btn-primary  btn-flat" style="">Register</button>
      </form>
    </div>
  </div>
</section>
@endsection

@section('js')
  {{-- here goes js files --}}

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