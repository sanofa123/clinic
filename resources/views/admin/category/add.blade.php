@extends('admin.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Add Category
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
      <p class="login-box-msg">Add a new category</p>

      <form  method="post" action="{{ route('admin.category.add') }}">
     	  @csrf

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Category name" value="{{ old('name') }}" name="name" required>
          <span class="form-control-feedback"><i class="fas fa-cubes"></i></span>
        </div>
     
        <button type="submit" class="btn btn-primary  btn-flat" style="">Register</button>
      </form>

    </div>
  </div>
</section>

	
@endsection

@section('js')

@endsection