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
				<form action="{{ route('nurse.password.email') }}" method="POST">
					@csrf
					<div class="form-group">
						<label for="email">Email:</label>
						<input name="email" type="email" value="{{ old('email') }}" id="email" placeholder="Type your email" class="form-control" required>
					</div>

					<div class="form-group">
                        <button type="submit" class="btn btn-info mr-auto">
                            {{ __('Send Password Reset Link') }}
                        </button>
                        <a class="btn btn-danger pull-right" href="{{ route('nurse.login') }}">
                            {{ __('Back to login') }}
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