<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/"> {{config('app.name')}} </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <!-- NAV BAR RIGHT SIDE -->
            <ul class="navbar-nav mr-lg-auto">
                <li class="{{ Request::path() === 'posts' ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="/posts">Blog
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="{{ Request::path() === 'about' ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="{{ Request::path() === 'contact' ? 'nav-item active' : 'nav-item' }}">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
            </ul>

            <!-- NAV BAR LEFT SIDE -->
{{--            <ul class="navbar-nav ml-lg-auto">--}}
{{--                <li class="{{ Request::path() === 'posts/create' ? 'nav-item active' : 'nav-item' }}">--}}
{{--                    <a class="nav-link" href="/posts/create">Create Post--}}
{{--                        <span class="sr-only">(current)</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/home">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
