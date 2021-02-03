@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	User Login
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

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                <br>
            @endif
        
            <h2 class="text-center">Send Resent Password Email</h2>
            <br>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Type your email" required>
                    
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info">
                        {{ __('Send Password Reset Link') }}
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