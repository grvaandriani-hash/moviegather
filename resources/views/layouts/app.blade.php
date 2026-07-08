<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MovieGather</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


<style>

body{
    background:#141414;
    color:#fff;
    font-family:'Segoe UI',sans-serif;
}

.navbar{
    background:#000 !important;
    border-bottom:2px solid #E50914;
}

.navbar-brand{
    color:#E50914 !important;
    font-size:28px;
    font-weight:700;
    letter-spacing:1px;
}

.nav-link{
    color:#fff !important;
    font-weight:500;
    transition:.3s;
}

.nav-link:hover,
.nav-link.active{
    color:#E50914 !important;
}

.dropdown-menu{
    background:#1b1b1b;
    border:1px solid #333;
}

.dropdown-item{
    color:#fff;
}

.dropdown-item:hover{
    background:#E50914;
    color:#fff;
}

.card{
    background:#1b1b1b;
    border:none;
    border-radius:18px;
    overflow:hidden;
    transition:.35s;
    box-shadow:0 8px 20px rgba(0,0,0,.4);
}

.card:hover{
    transform:scale(1.04);
    box-shadow:0 15px 35px rgba(229,9,20,.45);
}

.card-img-top{
    transition:.4s;
}

.card:hover .card-img-top{
    transform:scale(1.05);
}

.card-body{
    color:#fff;
}

.card-footer{
    background:#1b1b1b !important;
    border-top:1px solid #333 !important;
}

.btn-danger,
.btn-primary{
    background:#E50914;
    border:none;
    border-radius:10px;
}

.btn-danger:hover,
.btn-primary:hover{
    background:#b20710;
}

.btn-outline-light{
    border-radius:10px;
}

.badge{
    font-size:13px;
    padding:8px 12px;
}

.form-control{
    background:#2b2b2b;
    color:#fff;
    border:1px solid #444;
}

.form-control::placeholder{
    color:#999;
}

.form-control:focus{
    background:#2b2b2b;
    color:#fff;
    border-color:#E50914;
    box-shadow:0 0 10px rgba(229,9,20,.35);
}

.alert-success{
    background:#0f5132;
    border:none;
    color:#fff;
}

.alert-secondary,
.alert-dark{
    background:#222;
    color:#fff;
    border:none;
}

hr.border-danger{
    border-top:2px solid #E50914;
    opacity:1;
}

.card-header{
    background:#1b1b1b !important;
    color:white !important;
    border-bottom:1px solid #333;
}

</style>


</head>

<body>

<div id="app">

    <nav class="navbar navbar-expand-lg navbar-dark shadow">

        <div class="container">

            <a class="navbar-brand" href="{{ route('dashboard') }}">
                🎬 MovieGather
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                @auth

                <!-- Menu -->
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           href="{{ route('dashboard') }}">

                            🏠 Dashboard

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}"
                           href="{{ route('events.index') }}">

                            📅 Event

                        </a>

                    </li>

                    @if(Auth::user()->role == 'admin')

<li class="nav-item">

    <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}"
       href="{{ route('admin.dashboard') }}">

        👑 Admin

    </a>

</li>

@endif

                </ul>

                <!-- User -->
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown">

                            👤 {{ Auth::user()->name }}

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a class="dropdown-item"
                                   href="{{ route('dashboard') }}">

                                    🏠 Dashboard

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item"
                                   href="{{ route('events.index') }}">

                                    📅 Event

                                </a>
                                
                            </li>

                            @if(Auth::user()->role == 'admin')

<li>

    <a class="dropdown-item"
       href="{{ route('admin.dashboard') }}">

        👑 Dashboard Admin

    </a>

</li>

@endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <a class="dropdown-item text-danger"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">

                                    🚪 Logout

                                </a>

                            </li>

                        </ul>

                        <form id="logout-form"
                              action="{{ route('logout') }}"
                              method="POST"
                              class="d-none">

                            @csrf

                        </form>

                    </li>

                </ul>

                @endauth

            </div>

        </div>

    </nav>

    <main class="py-4">

        @yield('content')

    </main>

</div>

</body>
</html>