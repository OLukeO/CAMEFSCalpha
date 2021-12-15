<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            {{ config('app.name', 'Navigation Bar Demo') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-navbar-collapse"
            aria-controls="#app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <!--<li class="nav-item active">
                        <a class="nav-link" href="http://127.0.0.1/travel2/public/places">Home <span class="sr-only">(current)</span></a>
                    </li>-->
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('登入') }}</a>
                </li>
                @endif
                @if (Route::has('register'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('註冊') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                <li class="nav-item active">

                    <a class="nav-link" href="{{ url('home') }}">回到登入頁面</a>

                </li>
        </div>
        </li>
        @endif

        </ul>

    </div>
    </div>
</nav>
