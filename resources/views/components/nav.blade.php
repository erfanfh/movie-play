<nav id="navbar" class="navbar navbar-expand-lg bg-body-transparent w-100">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center w-100">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('game.index') }}">Play a game!</a>
                </li>
                <li class="nav-item">
                    @auth()
                        <div class="dropdown">
                            <button class="nav-link active dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->username }}
                            </button>
                            <ul class="dropdown-menu">
                                @if(auth()->user()->is_admin)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        logout
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                            <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                                            <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endauth
                    @guest()
                        <a class="nav-link active" href="{{ route('login') }}">Login/Register</a>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
