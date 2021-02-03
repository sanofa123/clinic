<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        @guest
        @else
        @if ( count(Auth::user()->unreadNotifications->where('type','App\Notifications\MaterialsNotifications')) )
            ({{ count(Auth::user()->unreadNotifications) }})
        @endif
        @endguest
        @yield('title')
    </title>
    <link rel="shortcut icon" href="{{ asset('/user_styles/images/testlogo.png') }}" />
    <!-- CSS -->
    <link rel="shortcut icon" href="{{ asset('/user_styles/images/testlogo.png') }}" />
    <link rel="stylesheet" href="{{ asset('/user_styles/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/user_styles/css/bootstrap.min.css') }}">
    
	@yield('head')

</head>