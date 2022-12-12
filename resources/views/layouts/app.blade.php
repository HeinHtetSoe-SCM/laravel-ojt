<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    <title>@yield('title')</title>
    @yield('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="{{ route('home') }}">Laravel CRUD OJT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="{{ route('posts.index') }}">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('categories.index') }}">Categories</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <a class="btn btn-outline-light mx-2 {{ auth()->check() ? 'd-none' : '' }} " href="{{ route('user.register') }}">Register</a>
                    <a class="btn btn-outline-light {{ auth()->check() ? 'd-none' : '' }} " href="{{ route('user.login') }}">Login</a>
                    <div class="flex-shrink-0 dropdown {{ auth()->check() ? '' : 'd-none' }}">
                        <a class="btn btn-light d-block link-dark text-decoration-none dropdown-toggle mx-2 " data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->check() ? auth()->user()->name : ''}}
                        </a>
                        <ul class="dropdown-menu text-small shadow">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}">Log out</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <div class="layout-container">
        @yield('content')
    </div>
</body>

</html>