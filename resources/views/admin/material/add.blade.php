@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Add Material
@endsection

@section('css')
@endsection

@section('body')
	{{-- here goes content of pages --}}
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
      @endforeach
      <p class="login-box-msg">Add a new material</p>

      <form  method="post" action="{{ route('admin.material.add') }}">
     	  @csrf

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Material name" value="{{ old('name') }}" name="name" required>
          <span class="form-control-feedback"><i class="fa fa-medkit"></i></span>
        </div>

        
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Cost" value="{{ old('cost') }}" name="cost" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Number" value="{{ old('num') }}" name="num" required>
          <span class="form-control-feedback"><i class="fas fa-plus-square"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Minimum Number" value="{{ old('min_num') }}" name="min_num" required>
          <span class="form-control-feedback"><i class="fas fa-plus-square"></i></span>
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
          <select class="form-control" name="category" required>
            <option value="">Choose Category</option>
              @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ (old('category') == $category->id ) ? 'selected="selected"' : ''}}>{{ $category->name }}</option>
              @endforeach
          </select>
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
      $('#datepicker1').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
    });
  </script>
@endsection