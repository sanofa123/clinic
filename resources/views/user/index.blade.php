@extends('user.layouts.layout')

@section('title')
{{-- here goes the title of the page --}}
	Home Page
@endsection

@section('head')
	{{-- this is for the css of this page --}}
@endsection

@section('body')
<div class="card p-3 p-md-5 text-white bg-dark" style="background-image: url({{ asset('/user_styles/images/back.jpeg') }});  no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		height:600px;
		" >
		<div class="container">
		<div class="col-md-6 px-0">
			<h1 class="display-4 font-italic">Master Clinic</h1>
			<p class="lead my-3">A Group of dental clinics.Here you can book an appointment with a doctor , clinic , date and time from your own choice.
			You can also see all information about our clinics to see the nearest clinic to you.</p>
			@guest
				<a class="btn btn-lg btn-info" href="{{ route('login') }}" >Log in</a>
			@endguest
			<br/>
			@auth
			<a class="btn btn-lg btn-info" href="{{ route('reservations.create') }}" style="margin-top: 20px" > Make an appointment</a>
            @endauth
		</div>
		</div>
	</div>

	<!--About Us-->
	<div class="container mt-5 mb-5 text-center">
		<h1 >
			<strong> About </strong>
			<strong style="color: #3ea2b8">Us </strong>
		</h1>
		 <p>
			A Group of dental clinics.Here you can book an appointment with a doctor , clinic , date and time from your own choice.
			You can also see all information about our clinics to see the nearest clinic to you.
			We have the best doctors in Egypt,The best service ever.
		 </p>
	</div>

	<!--Statistics -->
	<div class="card" style="background-image: url({{ asset('/user_styles/images/pattern.jpg') }}); background-attachment: fixed;">
		<div class=" text-white" style="background-color: #17a2b8cc !important">
			<div class="container text-center pt-5 pb-5">
				<div class="row">
					<div class="col-sm-4">
						<i class="fa fa-building fa-3x pr-2"></i>
						<strong class="timer" style="font-size: 40px"> {{$clinics}} </strong>
						<div>
						 <strong style="font-size: 25px"> Clinics </strong>
						</div>
					</div>
					<div class="col-sm-4">
						<i class="fa fa-users fa-3x pr-2"></i>
						<strong class="timer" style="font-size: 40px" > {{$patients}} </strong>
						<div>
						 <strong style="font-size: 25px"> Clients </strong>
						</div>
					</div>
					<div class="col-sm-4">
						<i class="fa fa-heartbeat fa-3x pr-2"></i>
						<strong class="timer" style="font-size: 40px"> {{$operations}} </strong>
						<div>
						 <strong style="font-size: 25px"> Operations </strong>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--Our Services-->
		<!--Paragraph-->
	<div class="container mt-5 mb-5 text-center">
		<h1 >
			<strong> Our Best </strong>
			<strong style="color: #3ea2b8">Services</strong>
		</h1>
		 <p>
			We provide all dental services you may need. 
			Here are some of our best services.
		 </p>
	</div>

		<!-- services -->
	<div class="card-group mt-5 mb-5 mr-5 ml-5">
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Dental Fillings.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Dental Fillings</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Orthodontics.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Orthodontics</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Tooth Extraction.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Tooth Extraction</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	</div>

	<div class="card-group  mb-5 mr-5 ml-5">
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Root Canal Treatment.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Root Canal Treatment</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Teeth Whitening.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Teeth Whitening</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	  <div class="card mr-3 ml-3">
	    <img class="card-img-top" src="{{ asset('/user_styles/images/Routine Dental Exam.jpg') }}" alt="Card image cap">
	    <div class="card-body">
	      <h5 class="card-title">Routine Dental Exam</h5>
	      <p class="card-text">Lorem ipsum dolor Fusce varius euismod lacus eget feugiat rorem ipsum dolor consectetur Fusce varius [...] </p>
	      
	    </div>
	  </div>
	</div>

	<!--Our Doctors-->
		<!--Paragraph-->
	<div class="container mt-5 mb-5 text-center">
		<h1 >
			<strong> Meet Our </strong>
			<strong style="color: #3ea2b8">Doctors</strong>
		</h1>
		 <p>
			Here are contact info of our doctors.
		 </p>
	</div>

		<!-- Doctors -->
	@for($i=0 ; $i<$doc_num ; $i+=3 )
	<div class="card-group mt-5 mb-5 mr-5 ml-5">

	  <div class="card mr-3 ml-3" >
	    <img class="card-img-top" src="{{ ($doctors[$i]->image) ? Storage::disk('local')->url($doctors[$i]->image) : asset('/admin_styles/images/defualt_male.png') }}" alt="Card image cap" style="width:370px; height:370px;">
	    <div class="card-body">
	      <h5 class="card-title text-center">{{$doctors[$i]->name}}</h5>
	      <b> Email : </b>{{$doctors[$i]->email}}<br>
	      <b> Mobile : </b>{{$doctors[$i]->mobile}}<br>
	      <b> Working Hours : </b><br>
	      <b> From : </b>{{$doctors[$i]->start_day}} <b> To : </b> {{$doctors[$i]->end_day}}<br>
	      <b> From : </b>{{$doctors[$i]->start_time}} <b> To : </b> {{$doctors[$i]->end_time}}<br>
	      <b> About : </b><br>
	      {{$doctors[$i]->about}}


	      
	    </div>
	  </div>
	  
	  <div class="card mr-3 ml-3" >
	  	@if($i != $doc_num-1)
	    <img class="card-img-top" src="{{ ($doctors[$i+1]->image) ? Storage::disk('local')->url($doctors[$i+1]->image) : asset('/admin_styles/images/defualt_male.png') }}" alt="Card image cap" style="width:370px; height:370px;">
	    <div class="card-body">
	      <h5 class="card-title text-center">{{$doctors[$i+1]->name}}</h5>
	      <b> Email : </b>{{$doctors[$i+1]->email}}<br>
	      <b> Mobile : </b>{{$doctors[$i+1]->mobile}}<br>
	      <b> Working Hours : </b><br>
	      <b> From : </b>{{$doctors[$i+1]->start_day}} <b> To : </b> {{$doctors[$i+1]->end_day}}<br>
	      <b> From : </b>{{$doctors[$i+1]->start_time}} <b> To : </b> {{$doctors[$i+1]->end_time}}<br>
	      <b> About : </b><br>
	      {{$doctors[$i+1]->about}}
	      
	    </div>
	    @endif
	  </div>
	  
	  
	  <div class="card mr-3 ml-3" >
	  	@if($i < $doc_num-2)
	    <img class="card-img-top" src="{{ ($doctors[$i+2]->image) ? Storage::disk('local')->url($doctors[$i+2]->image) : asset('/admin_styles/images/defualt_male.png') }}" alt="Card image cap" style="width:370px; height:370px;">
	    <div class="card-body">
	      <h5 class="card-title text-center">{{$doctors[$i+2]->name}}</h5>
	      <b> Email : </b>{{$doctors[$i+2]->email}}<br>
	      <b> Mobile : </b>{{$doctors[$i+2]->mobile}}<br>
	      <b> Working Hours : </b><br>
	      <b> From : </b>{{$doctors[$i+2]->start_day}} <b> To : </b> {{$doctors[$i+2]->end_day}}<br>
	      <b> From : </b>{{$doctors[$i+2]->start_time}} <b> To : </b> {{$doctors[$i+2]->end_time}}<br>
	      <b> About : </b><br>
	      {{$doctors[$i+2]->about}}
	      
	    </div>
	    @endif
	  </div>

	  
	</div>
	@endfor
@endsection




@section('footer')
{{-- here goes the js of the page --}}
<script src="{{ asset('/user_styles/js/jquery.countTo.js') }}"></script>
<script>
	$('.timer').each(function(index, el) {
		$(this).countTo({from: 0, to: $(this).text()})
	});
</script>
@endsection