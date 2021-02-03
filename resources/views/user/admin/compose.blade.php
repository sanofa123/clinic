@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	Contact your doctors
@endsection

@section('head')
	{{-- this is for the css of this page --}}
  	<link rel="stylesheet" href="{{ asset('/user_styles/css/select2.min.css') }}">
  	<link href='{{ asset('/user_styles/css/froala_editor.min.css') }}' rel='stylesheet' />
	<link href='{{ asset('/user_styles/css/froala_style.min.css') }}' rel='stylesheet' />
  	<style>
  		.select2-container--default .select2-selection--multiple .select2-selection__choice {
			    background-color: #3c8dbc;
			    border-color: #367fa9;
			    padding: 1px 10px;
			    color: #fff;
			}
  	</style>
@endsection

@section('body')
<div class="container mb-5">

	<div class="pt-3 pb-3">
		@foreach ($errors->all() as $error)
			<div class="card-header bg-danger text-white mb-3"><i class="fa fa-times fa-lg"></i> {{ $error }}</div>
		@endforeach
	</div>

	@if (session('status'))
		<div class="pt-3 pb-3">
			<div class="card-header bg-success text-white mb-3"><i class="fa fa-check fa-lg"></i> {{ session('status') }}</div>
		</div>
	@endif

	<div class="box-body">
		<h1 class="text-center mb-5">Contact your doctors</h1>
          <form  method="post" action="{{ route('send.email') }}">
            @csrf
            <div class="form-group">
                <select name="emails[]" class="form-control select2" multiple="multiple" data-placeholder="Select your doctors" required>
                	@foreach ($doctors as $doctor)
                  		<option value="{{ $doctor->id }}">{{ $doctor->email }}</option>
                	@endforeach
                </select>
            </div>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Subject:" value="{{ old('subject') }}" name="subject" required>
            </div>
                  
            <textarea name="message" class="textarea" placeholder="Write message here..." required>{{ old('message') }}</textarea>
          <!-- /.box-body -->
          <div class="mt-3">
            <div class="pull-right">
              	<button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
            	<button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>

</div>
  
@endsection

@section('footer')
{{-- here goes the js of the page --}}
<!-- bootstrap datepicker -->
<script src="{{ asset('/user_styles/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('/user_styles/js/select2.full.min.js') }}"></script>
<!-- Include JS file. -->
<script src='{{ asset('/user_styles/js/froala_editor.min.js') }}'></script>
<script>
	$(function() {
		$(".textarea").froalaEditor();
		$(".select2").select2();
	});
</script>
@endsection