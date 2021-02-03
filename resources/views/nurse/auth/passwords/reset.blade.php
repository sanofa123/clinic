@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	Nurse Reset Password
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

				@if (session('status'))
                    <div class="card-header bg-success text-white">
                        {{ session('status') }}
                    </div>
                @endif

				<h2 class="text-center">Nurse Reset Password</h2>
				<form action="{{ route('nurse.password.request') }}" method="POST">
					@csrf
					
					<input type="hidden" name="token" value="{{ $token }}">

					<div class="form-group">
						<label for="email">Email:</label>
						<input name="email" type="email" value="{{ old('email') }}" id="email" placeholder="Type your email" class="form-control" required>
					</div>

					<div class="form-group">
                        <label for="password">Password:</label>
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password:</label>
                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                    </div>


					<div class="form-group">
                        <button type="submit" class="btn btn-info mr-auto">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
				</form>
			</div>
		</div>
	</div>
@endsection




@section('footer')
{{-- here goes the js of the page --}}

@endsection