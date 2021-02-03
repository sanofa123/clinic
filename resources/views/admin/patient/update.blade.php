extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Edit Patient
@endsection

@section('css')
  {{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/datepicker3.css') }}">
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
        <img src="{{ ($patient->image) ? $patient->image : asset(config('app.profile_image')) }}" style="max-width: 50px;" name="userimg" class="img-circle" /> 
        Update Patient data
      </h3>
    </div>
    <div class="box-body">
      <form method="post" action="{{ route('admin.patient.updatepatient', $patient->id) }}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $patient->name }}" placeholder="Full name" name="fullName" required>
          <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="{{ $patient->email }}" name="email" required>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

         <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $patient->mobile }}" placeholder="Mobile" name="mobile">
          <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" id="datepicker" class="form-control" placeholder=" Birthday" value="{{ $patient->date_of_birth }}" name="birthday">
          <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
        </div>

        <div class="custom-control custom-radio">
          <input type="radio" value="female" id="customRadio1" name="gender" {{ ($patient->gender == 'female') ? 'checked' : '' }} class="custom-control-input">
          <label class="custom-control-label" for="customRadio1">Female</label>
        </div>

        <div class="custom-control custom-radio">
          <input type="radio" value="male" name="gender" id="customRadio2" {{ ($patient->gender == 'male') ? 'checked' : '' }} class="custom-control-input">
          <label class="custom-control-label" for="customRadio2">Male</label>
        </div>
        
        <br>
        <button class="btn btn-primary">Update</button>
        @if ($patient->status)
          <a href="#" id="updateStatusBtn" class="btn btn-danger btn-md" onclick="
            event.preventDefault();
            if (confirm('Are you sure you want to deactivate this account?')) {
              $('form#updateStatus').submit();
            }
          ">Deactivate Account</a>
        @else
          <a href="#" id="updateStatusBtn" class="btn btn-success btn-md" onclick="
            event.preventDefault();
            if (confirm('Are you sure you want to activate this account?')) {
              $('form#updateStatus').submit();
            }
          ">Activate Account</a>
        @endif
      </form>

      <form action="{{ route('admin.patient.update.status', $patient->id)}}" method="POST" id="updateStatus">
        @csrf
        {{ method_field('PATCH') }}
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
@endsection