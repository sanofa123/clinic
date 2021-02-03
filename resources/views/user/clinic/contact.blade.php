@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	Contact Us
@endsection

@section('head')
	{{-- this is for the css of this page --}}
@endsection

@section('body')
<div class="container text-center" style="padding-top: 25px">
		<h1 >
			<strong> Contact </strong>
			<strong style="color: #3ea2b8">Us </strong>
		</h1>
	</div>
<div class="container" style="padding-top: 25px">
 @foreach($clinics as $clinic)
 <div class="card" style="margin: 25px 25px 25px 25px;">
  <h5 class="card-header">{{$clinic->name}}</h5>
  <div class="card-body">
    <b> Address : </b>{{$clinic->address}}<br>
    <b> Email : </b>{{$clinic->email}}<br>
    <b> Phone : </b>{{$clinic->telephone}}<br>
    <b> Start Time : </b>{{$clinic->start_time}}<br>
    <b> End Time : </b>{{$clinic->end_time}}<br>
  </div>
</div>
 @endforeach 
</div>
@endsection

@section('footer')

@endsection