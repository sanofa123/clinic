@extends('user.layouts.layout')
@section('title')
Reservations
@endsection

@section('head')
  {{-- here goes the css of page --}}
  <link rel="stylesheet" href="{{ asset('/user_styles/css/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ asset('/user_styles/css/bootstrap-timepicker.min.css') }}">
@endsection

@section('body')
  {{-- here goes content of pages --}}


  


<section class="container">
 <div class="box box-primary">
  <div class="box-body">
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach
      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif
 <p class="login-box-msg h3" style="text-align:center; margin:70px; margin-top:100px ">Make a Reservation</p>

  <form  method="post" action="{{ route('reservations.create') }}">
  @csrf
<div class="form-row">
   <div class="input-group-prepend col-md-6">
    <label class="input-group-text" for="inputGroupSelect01">Doctor</label>
  <select class="form-control" id="inputGroupSelect01" name="admin" required>
            <option value="">Choose Doctor</option>
             @foreach ($admins as $admin)
                  <option value="{{ $admin->id }}" {{
                   (old('admin') == $admin->id ) ? 'selected="selected"' : ''}}>{{ $admin->name }}</option>
              @endforeach
  </select>
</div>

   <div class="input-group-prepend col-md-6">
    <label class="input-group-text" for="inputGroupSelect01">Clinic</label>
    <select class="form-control" id="inputGroupSelect01" name="clinic" required>
          <option value="">Choose Clinic</option>
              @foreach ($clinics as $clinic)
                  <option value="{{ $clinic->id }}" {{ (old('clinic') == $clinic->id ) ? 'selected="selected"' : ''}}>{{ $clinic->name }}</option>
              @endforeach
  </select>
</div>

</div>
  <br/>  
  <br/>
        <div class="form-group has-feedback">
          <input type="text" id="datepicker" class="form-control " placeholder=" Reservation Date" value="{{ old('Reservationdate') }}" name="date" required>
        </div>

       <br/>
      <div class="form-group row">
        <div class="col-12">
          <input class="form-control" type="time" id="example-time-input" name="time" value="{{ old('time') }}" placeholder="Reservation time" required>
        </div>
      </div>

       <br/>
      <button type="submit" class="btn btn-info  btn-flat" style="margin-bottom: 20px">Confirm</button>

 </form>
</div>
</div>
</section>

@endsection

@section('footer')
  {{-- here goes js files --}}
  <script src="{{ asset('/user_styles/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('/user_styles/js/bootstrap-timepicker.min.js') }}"></script>

<script>
   $(function() {
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
      $("#timepicker").timepicker({
        autoclose: true,
        format: 'h:i A',
      });
    });
    //Timepicker
    </script>
@endsection