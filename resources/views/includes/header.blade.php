<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">
        <i class="bi bi-house-fill" style="font-size: 2rem;"></i> 
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register.form') }}">Register</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="">{{ Auth::user()->name }}</a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="GET" class="form-inline">
                    @csrf
                    <button class="btn btn-link nav-link" type="submit">Logout</button>
                </form>
            </li>
            @endguest
        </ul>
    </div>
</nav>