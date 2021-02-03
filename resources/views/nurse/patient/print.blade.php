<!DOCKTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link href="https://fonts.googleapis.com/css?family=Economica:400,700&amp;subset=latin-ext" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('/user_styles/images/testlogo.png') }}" />
        <!-- CSS -->
        <link rel="shortcut icon" href="{{ asset('/user_styles/images/testlogo.png') }}" />
        <link rel="stylesheet" href="{{ asset('/user_styles/css/file.css') }}">

		<title>{{ $patient->name }}_file</title>
	</head>

	<body>
		<div class="book">
			<?php $num_pages = 0; $num_figues = 0; ?>

			@foreach ($pages as $page)
				<?php
					$prescriptions = $page[0];
					$images = $page[1];
					$comments = $page[2];
					$doctor_name = $page[3];
					$doctor_email = $page[4];
					$date = date('M d, Y',strtotime(substr($page[5], 0, 10)));
				?>
				@if ($num_pages != 0)
							</div>
							<footer class="foot">
								<img src="{{ asset('/user_styles/images/bar2.png') }}">
								<br><br>
								<p>{{ $num_pages++ }}</p>
							</footer>
						</div>    
					</div>
				@endif
				<div class='page'>
					<div class='subpage'>
						<header class="head"></header>
						<div class='content'>
				@if ($num_pages == 0)
					<h1 style="font-family: Economica', sans-serif; font-weight: bold; font-size: 30pt; margin: 0px; padding: 0px">{{ $patient->name }}</h1>
					<?php $num_pages++; $num_lines = 25; ?>
				@else
					<?php $num_lines = 27; ?>
				@endif
				<h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #666666;">Doctor: DR. {{ strtoupper($doctor_name) }}</h2>
				<h2 style="font-family: 'Economica', sans-serif; font-size: 14pt; color: #199ebc">{{ $doctor_email }}</h2>
				<img src="{{ asset('/user_styles/images/bar1.png') }}">
				<h1 style="font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 16pt;">{{ $date }}</h1>

				@if (count($prescriptions) > 0)
					<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Prescriptions</h2>

					@foreach($prescriptions as $prescription)
						@if (strpos($prescription, '<h1>') !== false || strpos($prescription, '<h2>') !== false || strpos($prescription, '<h3>') !== false)
							@if($num_lines >= 2)
								{!! $prescription !!}
								<?php $num_lines = $num_lines - 2 ?>
							@else
										</div>
										<footer class="foot">
											<img src="{{ asset('/user_styles/images/bar2.png') }}">
											<br><br>
											<p>{{ $num_pages++ }}</p>
										</footer>
									</div>    
								</div>
								<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
								<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
								{!! $prescription !!}
								<?php $num_lines = 29; ?>
							@endif
						@else
							@if($num_lines >= 1)
								{!! $prescription !!}
								<?php $num_lines--; ?>
							@else
										</div>
										<footer class="foot">
											<img src="{{ asset('/user_styles/images/bar2.png') }}">
											<br><br>
											<p>{{ $num_pages++ }}</p>
										</footer>
									</div>    
								</div>
								<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
								<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
								{!! $prescription !!}
								<?php $num_lines = 30; ?>
							@endif
						@endif
					@endforeach
				@endif

				@if ($images != null)
					@if ($num_lines >= 2)
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Photos</h2>
					@else
								</div>
								<footer class="foot">
									<img src="{{ asset('/user_styles/images/bar2.png') }}">
									<br><br>
									<p>{{ $num_pages++ }}</p>
								</footer>
							</div>    
						</div>
						<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
						<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Photos</h2>
						<?php $num_lines = 29; ?>
					@endif

					@foreach($images as $image)
						@if (($image->height + 25) > 907)
									</div>
									<footer class="foot">
										<img src="{{ asset('/user_styles/images/bar2.png') }}">
										<br><br>
										<p>{{ $num_pages++ }}</p>
									</footer>
								</div>    
							</div>
							<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
							<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>

							@if ($image->width >= 718)
								<img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: 100%;' >
							@else
								<img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: {{$image->width}}px;' >
							@endif

							@if ($image->caption != "")
								<p><strong>Figue {{ ++$num_figues . ": " . $image->caption }}</strong></p>
							@else
								<p><strong>Figue {{ ++$num_figues }}</strong></p>
							@endif
									</div>
									<footer class="foot">
										<img src="{{ asset('/user_styles/images/bar2.png') }}">
										<br><br>
										<p>{{ $num_pages++ }}</p>
									</footer>
								</div>    
							</div>
							<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
							<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
							<?php $num_lines = 31; ?>
						@elseif (($image->height + 25) > 24 * $num_lines)
									</div>
									<footer class="foot">
										<img src="{{ asset('/user_styles/images/bar2.png') }}">
										<br><br>
										<p>{{ $num_pages++ }}</p>
									</footer>
								</div>    
							</div>
							<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
							<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>

							@if ($image->width >= 718)
								<img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: 100%;' >
							@else
								<img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: {{$image->width}}px;' >
							@endif

							@if ($image->caption != "")
								<p><strong>Figue {{ ++$num_figues . ": " . $image->caption }}</strong></p>
							@else
								<p><strong>Figue {{ ++$num_figues }}</strong></p>
							@endif

							<?php $num_lines = 31 - ceil(($image->height + 25) / 24.0); ?>
						@else
							@if ($image->width >= 718)
								<img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: 100%;' >
							@else
								<img src="{{ Storage::disk('local')->url($image->image) }}" class='img-responsive' style='height: {{$image->height}}px; width: {{$image->width}}px;' >
							@endif

							@if ($image->caption != "")
								<p><strong>Figue {{ ++$num_figues . ": " . $image->caption }}</strong></p>
							@else
								<p><strong>Figue {{ ++$num_figues }}</strong></p>
							@endif

							<?php $num_lines = $num_lines - ceil(($image->height + 25) / 24.0) ?>
						@endif
					@endforeach
				@endif
				
				@if (count($comments) > 0)
					@if ($num_lines >= 2)
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Notes</h2>
					@else
								</div>
								<footer class="foot">
									<img src="{{ asset('/user_styles/images/bar2.png') }}">
									<br><br>
									<p>{{ $num_pages }}</p>
								</footer>
							</div>    
						</div>
						<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
						<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
						<h2 style="font-family: 'Open Sans', sans-serif; font-weight: bold;">Notes</h2>
						<?php $num_lines = 29; $num_pages++ ?>
					@endif

					@foreach($comments as $comment)
						@if (strpos($comment, '<h1>') !== false || strpos($comment, '<h2>') !== false || strpos($comment, '<h3>') !== false)
							@if($num_lines >= 2)
								{!! $comment !!}
								<?php $num_lines = $num_lines - 2; ?>
							@else
										</div>
										<footer calss="foot">
											<img src="{{ asset('/user_styles/images/bar2.png') }}">
											<br><br>
											<p>{{ $num_pages++ }}</p>
										</footer>
									</div>    
								</div>
								<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
								<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
								{!! $comment !!}
								<?php $num_lines = 29; $num_pages++; ?>
							@endif
						@else
							@if($num_lines >= 1)
								{!! $comment !!}
								<?php $num_lines--; ?>
							@else
										</div>
										<footer calss="foot">
											<img src="{{ asset('/user_styles/images/bar2.png') }}">
											<br><br>
											<p>{{ $num_pages++ }}</p>
										</footer>
									</div>    
								</div>
								<div class='page'><div class='subpage'><header class="head"></header><div class='content'>
								<img src="{{ asset('/user_styles/images/bar1.png') }}"><br><br>
								{!! $comment !!}
								<?php $num_lines = 30; $num_pages++; ?>
							@endif
						@endif
					@endforeach
				@endif
			@endforeach
					</div>
					<footer calss="foot">
						<img src="{{ asset('/user_styles/images/bar2.png') }}">
						<br><br>
						<p>{{ $num_pages++ }}</p>
					</footer>
				</div>    
			</div>
		</div>

        <script src="{{ asset('/user_styles/js/jquery.min.js') }}"></script>
        <script>
			$(function(){
				window.print();
				window.close();
			});
		</script>
	</body>
</html>