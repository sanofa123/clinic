@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Edit clinic
@endsection

@section('css')
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
        Update clinic data
      </h3>
    </div>
    <div class="box-body">
      <form method="post" action="{{ route('admin.clinic.update', $clinic->id) }}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $clinic->name }}" placeholder="Clinic's name" name="name" required>
          <span class="form-control-feedback"><i class="fas fa-hospital"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" value="{{ $clinic->email }}" name="email" required>
          <span class="form-control-feedback"><i class="fas fa-envelope"></i></span>
        </div>

         <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $clinic->telephone }}" placeholder="Phone" name="phone">
          <span class="form-control-feedback"><i class="fas fa-phone"></i></span>
        </div>


        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Address" value="{{ $clinic->address }}" name="address" required>
          <span class="form-control-feedback"><i class="fas fa-map-marker"></i></span>
        </div>

      <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Start Time:</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="start_time" value="{{ $clinic->start_time }}">

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
                    <input type="text" class="form-control timepicker" name="end_time" value="{{ $clinic->end_time }}">

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
 <!-- bootstrap time picker -->
<script src="{{ asset('/admin_styles/js/bootstrap-timepicker.min.js') }}"></script>
<script>
  $(function () {
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
      format: 'hh:mm:ss'
    });
  });
</script>
@endsection