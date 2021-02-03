@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Edit Category
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
        Update category data
      </h3>
    </div>
    <div class="box-body">
      <form method="post" action="{{ route('admin.category.update', $category->id) }}">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" value="{{ $category->name }}" placeholder="Category name" name="name" required>
          <span class="form-control-feedback"><i class="fas fa-cubes"></i></span>
        </div>


        
        <br>
        <button class="btn btn-primary">Update</button>
        
      </form>
    </div>
  </div>
</section>
@endsection

@section('js')
  
@endsection