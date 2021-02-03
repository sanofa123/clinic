@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Edit worker
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
        Update worker data
      </h3>
    </div>
    <div class="box-body">
      <form method="post" action="{{ route('admin.worker.update', $worker->id) }}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $worker->name }}" placeholder="Full name" name="fullName" required>
          <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        </div>


         <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $worker->mobile }}" placeholder="Mobile" name="mobile">
          <span class="form-control-feedback"><i class="fas fa-mobile-alt"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" id="datepicker" class="form-control" placeholder=" Birthday" value="{{ $worker->date_of_birth }}" name="birthday">
          <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Salary" value="{{ $worker->salary }}" name="salary" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>

        <div class="form-group">
          <select class="form-control" name="clinic" required>
            <option value="">Choose Clinic</option>
              @foreach ($clinics as $clinic)
                  <option value="{{ $clinic->id }}" {{ ($worker->clinic_id == $clinic->id ) ? 'selected="selected"' : ''}}>{{ $clinic->name }}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Position" value="{{ $worker->position }}" name="position" required>
          <span class="form-control-feedback"><i class="fas fa-briefcase"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" id="datepicker1" class="form-control" placeholder=" Start Date" value="{{ $worker->date_of_start }}" name="start_date">
          <span class="form-control-feedback"><i class="fas fa-calendar-alt"></i></span>
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
      $('#datepicker1').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
    });
  </script>
@endsection