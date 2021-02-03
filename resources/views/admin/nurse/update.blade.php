@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Edit nurse
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
        <img src="{{ ($nurse->image) ? $nurse->image : asset(config('app.profile_image')) }}" style="max-width: 50px;" name="userimg" class="img-circle" /> 
        Update nurse data
      </h3>
    </div>
    <div class="box-body">
      <form method="post" action="{{ route('admin.nurse.update', $nurse->id) }}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $nurse->name }}" placeholder="Full name" name="fullName" required>
          <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="{{ $nurse->email }}" name="email" required>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

         <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $nurse->mobile }}" placeholder="Mobile" name="mobile">
          <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" id="datepicker" class="form-control" placeholder=" Birthday" value="{{ $nurse->date_of_birth }}" name="birthday">
          <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Salary" value="{{ $nurse->salary }}" name="salary" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>

        <div class="form-group">
          <select class="form-control" name="clinic" required>
            <option value="">Choose Clinic</option>
              @foreach ($clinics as $clinic)
                  <option value="{{ $clinic->id }}" {{ ($nurse->clinic_id == $clinic->id ) ? 'selected="selected"' : ''}}>{{ $clinic->name }}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Start Day:</label>
          <select class="form-control" name="start_day" required>
            <option value="">From</option>
              @for($i=0 ; $i<7 ; $i++)
                  <option value="{{ $week[$i] }}" {{ ($nurse->start_day == $week[$i] ) ? 'selected="selected"' : ''}}>{{ $week[$i] }}</option>
              @endfor
          </select>
        </div>

        <div class="form-group">
          <label>End Day:</label>
          <select class="form-control" name="end_day" required>
            <option value="">To</option>
              @for($i=0 ; $i<7 ; $i++)
                  <option value="{{ $week[$i] }}" {{ ($nurse->end_day == $week[$i] ) ? 'selected="selected"' : ''}}>{{ $week[$i] }}</option>
              @endfor
          </select>
        </div>


        <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Start Time:</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="start_time" value="{{ $nurse->start_time }}">

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
                    <input type="text" class="form-control timepicker" name="end_time" value="{{ $nurse->end_time }}">

                    <div class="input-group-addon">
                      <i class="fas fa-clock"></i>
                    </div>
                  </div>
                </div>
        </div>

        <div class="custom-control custom-radio">
          <input type="radio" value="female" id="customRadio1" name="gender" {{ ($nurse->gender == 'female') ? 'checked' : '' }} class="custom-control-input">
          <label class="custom-control-label" for="customRadio1">Female</label>
        </div>

        <div class="custom-control custom-radio">
          <input type="radio" value="male" name="gender" id="customRadio2" {{ ($nurse->gender == 'male') ? 'checked' : '' }} class="custom-control-input">
          <label class="custom-control-label" for="customRadio2">Male</label>
        </div>
        
        <br>
        <button class="btn btn-primary">Update</button>
        @if ($nurse->status)
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

      <form action="{{ route('admin.nurse.status', $nurse->id)}}" method="POST" id="updateStatus">
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