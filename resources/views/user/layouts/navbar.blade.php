<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-info">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="{{ App\Navigation::setActive('home') }}">
                  <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                @auth


                    <li class="{{ App\Navigation::setActive('profile') }}">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>

                     <li class="{{ App\Navigation::setActive('Reservations.history') }}">
                        <a class="nav-link" href="{{ route('Reservations.history') }}">Reservations</a>
                    </li>

                    <li class="{{ App\Navigation::setActive('patient.invoice.view') }}">
                        <a class="nav-link" href="{{ route('patient.invoice.view') }}">Invoices</a>
                    </li>

                    <li class="{{ App\Navigation::setActive('send.email') }}">
                        <a class="nav-link" href="{{ route('send.email') }}">Email</a>
                    </li>

                    <li class="{{ App\Navigation::setActive('file') }}">
                        <a class="nav-link" href="{{ route('file') }}">File</a>
                    </li>
                    <li class="{{ App\Navigation::setActive('contact_us') }}">
                        <a class="nav-link" href="{{ route('contact_us') }}">Contacts</a>
                    </li>
                    @else
                    <li class="{{ App\Navigation::setActive('contact_us') }}">
                        <a class="nav-link" href="{{ route('contact_us') }}">Contacts</a>
                    </li>
                @endauth

            </ul>


            <ul class="navbar-nav ml-auto">
                              <!-- Authentication Links -->
                @guest

                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                @else
                    <li class="nav-item dropdown active">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            
                            <img src="{{ (Auth::user()->image) ? Storage::disk('local')->url(Auth::user()->image) : asset('/admin_styles/images/user4-128x128.jpg') }}"  alt="User Image" style="border-radius:50% 50% 50% 50%; width:30px; height:30px; "> {{ Auth::user()->name }} 
                        </a>
                        

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <div class="card" style="width: 11rem;">
                                <img class="card-img-top" src="{{ (Auth::user()->image) ? Storage::disk('local')->url(Auth::user()->image) : asset('/admin_styles/images/user4-128x128.jpg') }}"  alt="User Image" style="border-radius:50% 50% 50% 50%; width:150px; height:150px; margin-left: 10px">
                                 <div class="card-body">
                                     <a href="{{ route('profile') }}" class="btn btn-outline-primary btn-sm" style="margin-right: 10px">Profile</a><a  href="{{ route('logout') }}" class="btn btn-outline-primary btn-sm"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                                </div>
                            
                            
                        </div>
                    </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
