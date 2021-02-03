@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Edit material
@endsection

@section('css')
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
        Update material data
      </h3>
    </div>
    <div class="box-body">
      <form method="post" action="{{ route('admin.material.update', $material->id) }}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $material->name }}" placeholder="Material name" name="name" required>
          <span class="form-control-feedback"><i class="fa fa-medkit"></i></span>
        </div>


        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Cost" value="{{ $material->cost}}" name="cost" required>
          <span class="form-control-feedback"><i class="fas fa-dollar-sign"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Number" value="{{ $material->num}}" name="num" required>
          <span class="form-control-feedback"><i class="fas fa-plus-square"></i></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Minimum Number" value="{{ $material->min_num}}" name="min_num" required>
          <span class="form-control-feedback"><i class="fas fa-plus-square"></i></span>
        </div>



        <div class="form-group">
          <select class="form-control" name="clinic" required>
            <option value="">Choose Clinic</option>
              @foreach ($clinics as $clinic)
                  <option value="{{ $clinic->id }}" {{ ($material->clinic_id == $clinic->id ) ? 'selected="selected"' : ''}}>{{ $clinic->name }}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group">
          <select class="form-control" name="category" required>
            <option value="">Choose Category</option>
              @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ ($material->category_id == $category->id ) ? 'selected="selected"' : ''}}>{{ $category->name }}</option>
              @endforeach
          </select>
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