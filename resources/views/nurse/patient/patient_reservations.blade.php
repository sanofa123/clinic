@extends('nurse.layouts.layout')

@section('title')
    Register a new patient
@endsection

@section('css')
  {{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/nurse_styles/css/datepicker3.css') }}">
@endsection

@section('body')
  {{-- here goes content of pages --}}

<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach

      <p class="login-box-msg">Register a new patient</p>

      <form  method="post" action="{{ route('nurse.patient.add') }}">
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

        <div class="form-group has-feedback">
          <input type="text" id="datepicker" class="form-control" placeholder=" Birthday" value="{{ old('birthday') }}" name="birthday">
          <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
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
  <script src="{{ asset('/nurse_styles/js/bootstrap-datepicker.js') }}"></script>
<script>
  $(function() {
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
    });
  </script>
@endsection