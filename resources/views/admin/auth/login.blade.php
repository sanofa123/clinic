@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	Admin Login
@endsection

@section('head')
	{{-- this is for the css of this page --}}
	<style>
		.pull-right {
			float: right;
		}
	</style>
@endsection

@section('body')
	<div class="container">
		<div class="row full-height align-items-center">
			<div class="col-md-6 ml-auto mr-auto mt-3 mb-3">

				@foreach ($errors->all() as $error)
					<div class="card-header bg-danger text-white">{{ $error }}</div>
				@endforeach

				<h2 class="text-center">Admin Login</h2>
				<form action="{{ route('admin.login') }}" method="POST">
					@csrf
					<div class="form-group">
						<label for="email">Email:</label>
						<input required name="email" type="email" value="{{ old('email') }}" id="email" placeholder="Type your email" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input required type="password" value="{{ old('password') }}" name="password" id="password" placeholder="Type your password" class="form-control">
					</div>
					

                    <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>
                            </div>
                    </div>

					<div class="form-group">
                        <button type="submit" class="btn btn-info mr-auto">
                            {{ __('Login') }}
                        </button>
                        <a class="btn btn-link pull-right" href="{{ route('admin.password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
				</form>
			</div>
		</div>
	</div>
@endsection




@section('footer')
{{-- here goes the js of the page --}}

@endsection