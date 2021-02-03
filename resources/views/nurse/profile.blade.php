@extends('nurse.layouts.layout')

@section('title')
	{{-- here goes the title of page --}}
	Nurse profile
@endsection

@section('css')
	{{-- here goes the css of page --}}
@endsection

@section('body')
	
<section class="content">
    <div class="row">

        <div class="pt-3 pb-3">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger"><i class="fa fa-times fa-lg"></i> {{ $error }}</div>
            @endforeach
        </div>

        @if (session('status'))
            <div class="pt-3 pb-3">
                <div class="alert alert-success"><i class="fa fa-check fa-lg"></i> {{ session('status') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="pt-3 pb-3">
                <div class="alert alert-danger"><i class="fa fa-times fa-lg"></i> {{ session('error') }}</div>
            </div>
        @endif

        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                  
                    <img class="profile-user-img img-responsive img-circle" src="{{ (Auth::user()->image) ? Storage::disk('local')->url(Auth::user()->image) : asset('/admin_styles/images/user4-128x128.jpg') }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <p class="text-muted text-center">{{ Auth::user()->role }}</p>
                    
                    <form action="{{ route('nurse.update.photo') }}" class="update-profile-picture" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="file" style="display: none" onchange="$('.update-profile-picture').submit();" name="picture" />
                        <label for="file" class="btn btn-primary btn-block">Change Profile Picture</label>
                    </form>

                  </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
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

                      <strong><i class="fa fa-building margin-r-5 text-secondary"></i> Clinic</strong>

                      <p class="text-muted">
                        {{ $clinic }}
                      </p>

                      <hr>

                      <strong><i class="fa fa-dollar-sign margin-r-5 text-warning"></i> Salary</strong>

                      <p class="text-muted">
                        {{ Auth::user()->salary }}
                      </p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#updateData" data-toggle="tab">Update Info</a></li>
                    <li><a href="#resetPassword" data-toggle="tab">Reset Password</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="updateData">
                        <form class="form-horizontal" action="{{ route('nurse.profile.update') }}" method="POST">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Full Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Full Name" name="name" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputMobile" class="col-sm-2 control-label">Mobile</label>

                                    <div class="col-sm-10">
                                        <input type="Mobile" class="form-control" id="inputMobile" placeholder="Mobile" name="mobile" value="{{ Auth::user()->mobile }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="reset" class="btn btn-default" value="Cancel" />
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>
                        <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="resetPassword">
                        <form class="form-horizontal" action="{{ route('nurse.password.update') }}" method="POST">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputOldPassword" class="col-sm-2 control-label">Old Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputOldPassword" name="oldPassword" placeholder="Old Password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputNewPassword" class="col-sm-2 control-label">New Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputNewPassword" name="newPassword" placeholder="New Password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputNewPasswordConfirm" class="col-sm-2 control-label">Confirm New Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputNewPasswordConfirm" name="passwordConfirm" placeholder="Confirm New Password" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Update Password</button>
                            </div>
                        <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
@endsection

@section('js')
	{{-- here goes js files --}}
@endsection