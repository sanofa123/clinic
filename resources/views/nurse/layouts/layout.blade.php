<!DOCTYPE html>
<html lang="en">
	@include('nurse.layouts.head')
<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		@include('nurse.layouts.navbar')
		@include('nurse.layouts.sidenavbar')
		<div class="content-wrapper">
			@section('body')
				@show
		</div>
		@include('nurse.layouts.footer')
	</div>
		@include('nurse.layouts.js')
</body>
</html>