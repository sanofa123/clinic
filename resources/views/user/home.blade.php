@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	My Profile
@endsection

@section('head')
	{{-- this is for the css of this page --}}
	<link rel="stylesheet" href="{{ asset('/user_styles/css/datepicker3.css') }}">
	<style>
		.img-circle {
			border-radius: 100%;
		}
		.img-responsive {
			max-width: 100%;
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

	@if (session('error'))
		<div class="pt-3 pb-3">
			<div class="card-header bg-danger text-white mb-3"><i class="fa fa-times fa-lg"></i> {{ session('error') }}</div>
		</div>
	@endif

    <!-- Main content -->
    <section class="pt-5">

      <div class="row">
        <div class="col-md-3 mb-3">

          <!-- Profile Image -->
          <div class="card">
            <div class="text-center">
              <img class="mt-3 mb-3 img-responsive img-circle" src="{{ (Auth::user()->image) ? Storage::disk('local')->url(Auth::user()->image) : asset('/admin_styles/images/user4-128x128.jpg') }}" alt="User profile picture">

              <p class="profile-username text-center">{{ Auth::user()->name }}</p>

              <form action="{{ url('patient/photo') }}" method="POST" enctype="multipart/form-data">
              <a href="#" class="btn btn-info btn-block" id="profileImage"><b>Change profile photo</b></a>
            	{{ csrf_field() }}
              	<input type="file" name="file" style="display: none" id="fileImage" accept="image/*" />
              </form>
            </div>
          </div>

          <!-- About Me Box -->
          <div class="card mt-3 p-3	">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-envelope margin-r-5 text-success"></i> Email</strong>

              <p class="text-muted">
                {{ Auth::user()->email }}
              </p>

              <hr>
              
              <strong><i class="fa fa-mobile margin-r-5 text-info"></i> Mobile</strong>

              <p class="text-muted">
                {{ Auth::user()->mobile }}
              </p>

              <hr>

              <strong><i class="fa fa-user margin-r-5 text-secondary"></i> Gender</strong>

              <p class="text-muted">
                {{ Auth::user()->gender }}
              </p>

              <hr>

              <strong><i class="far fa-clock margin-r-5 text-danger"></i> Date of birth</strong>

              <p class="text-muted">{{ Auth::user()->date_of_birth }}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
        	<div class="p-3 card">
	          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Settings</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Change password</a>
				  </li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
				  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					<form action="{{ route('patient.profile') }}" method="POST">
						@csrf
						{{ method_field('PATCH') }}
	                  <div class="form-group">
	                    <label for="inputName" class="control-label">Name</label>

	                      <input type="text" value="{{ Auth::user()->name }}" class="form-control" id="inputName" name="name" placeholder="Name" required>
	                  </div>
	                  <div class="form-group">
	                    <label for="inputEmail" class="control-label">Email</label>

	                      <input type="email" class="form-control" value="{{ Auth::user()->email }}" required id="inputEmail" name="email" placeholder="Email">
	                  </div>
	                  <div class="form-group">
	                    <label for="inputMobile" class="control-label">Mobile</label>

	                      <input type="text" class="form-control" value="{{ Auth::user()->mobile }}" required id="inputMobile" name="mobile" placeholder="Mobile">
	                  </div>
	                  <div class="form-group">
		                <label>Date of birth</label>

		                <div class="input-group date">
		                  <input type="text" class="form-control" value="{{ Auth::user()->date_of_birth }}" name="date" id="datepicker" placeholder="Date of birth" required>
		                </div>
		                <!-- /.input group -->
		              </div>
	                  <div class="form-group">
	                  	<label for="">Gender</label>
	                  	<div class="custom-control custom-radio">
						  <input type="radio" id="customRadio1" name="gender" class="custom-control-input" value="male" {{ (Auth::user()->gender == 'male') ? 'checked' : '' }}>
						  <label class="custom-control-label" for="customRadio1">Male</label>
						</div>
						<div class="custom-control custom-radio">
						  <input type="radio" id="customRadio2" name="gender" value="female" class="custom-control-input" {{ (Auth::user()->gender == 'female') ? 'checked' : '' }}>
						  <label class="custom-control-label" for="customRadio2">Female</label>
						</div>
	                  </div>
	                  <div class="form-group">
	                    <div class="col-sm-offset-2 col-sm-10">
	                      <button type="submit" class="btn btn-info">Submit</button>
	                    </div>
	                  </div>
	                </form>
				  </div>
				  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				  	<form action="{{ route('patient.password.update') }}" method="POST">
				  		@csrf
				  		{{ method_field('PATCH') }}
				  		<div class="form-group">
				  			<label for="oldPassword">Old Password</label>
				  			<input type="password" placeholder="Enter old password" name="oldPassword" class="form-control" required>
				  		</div>
				  		<div class="form-group">
				  			<label for="newPassword">New Password</label>
				  			<input type="password" name="newPassword" placeholder="Enter new password" class="form-control">
				  		</div>
				  		<div class="form-group">
				  			<label for="passwordConfirm">Confirm new Password</label>
				  			<input type="password" placeholder="Enter new password again" name="passwordConfirm" class="form-control">
				  		</div>
				  		<button class="btn btn-info">Change Password</button>
				  	</form>
				  </div>
				</div>
			</div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  
@endsection




@section('footer')
{{-- here goes the js of the page --}}
<!-- bootstrap datepicker -->
<script src="{{ asset('/user_styles/js/bootstrap-datepicker.js') }}"></script>
<script>
	$(function() {
	    var wrapper = $('<div/>').css({height:0,width:0,'overflow':'hidden'});
		var fileInput = $('input:file').wrap(wrapper);
		$('#fileImage').on("change", function() {
		    $(this).parents("form").submit();
		});
		$('#profileImage').click(function(){
		    fileInput.click();
		}).show();
		//Date picker
	    $('#datepicker').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd'
	    });
	});
</script>
@endsection