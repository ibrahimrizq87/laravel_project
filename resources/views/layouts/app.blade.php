<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BetterCareer</title>
    <link rel="icon" href="{{ asset('images/logoo.jpg') }}" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>

<div id="app">
    <header class="navbar navbar-expand-lg navbar-light shadow" style="background-color: #ffffff;">
        <div class="container-fluid">
            <a class="navbar-brand ms-5 text-body fw-bolder" href="/">
                <img src="{{ asset('images/logo.png') }}" width="50">
                <img src="{{ asset('images/word.jpg') }}" width="120" height="30">
            </a>
            
            @auth
            <ul class="nav nav-tabs col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-5">
                <li><a href="{{route('home')}}" class="nav-link px-2 {{ Route::currentRouteName() == 'home' ? 'active link-secondary' : 'link-dark' }}">Home</a></li>
                @if ( Auth::user()->role == 'employer')
                <li><a href="{{route('job_posts.create')}}" class="nav-link px-2 {{ Route::currentRouteName() == 'job_posts.create' ? 'active link-secondary' : 'link-dark' }}">Add Job Post</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">View Applications</a></li>
                @endif
                @if ( Auth::user()->role == 'admin')
                <li><a href="#" class="nav-link px-2 link-dark">View Applications</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Posts Acceptance</a></li>
                <li><a href="{{ route('job_posts.index') }}" class="nav-link px-2 link-dark">Not Approved Posts</a></li>
                @endif
            </ul>
            @endauth

            @guest
            <div class="collapse navbar-collapse justify-content-end ms-5" id="navbarNav">
                <ul class="navbar-nav me-5">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <button class="btn" style="background-color:#102C57; color:#ffffff">Login</button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <button class="btn" style="background-color: #eaeaea">Register</button>
                        </a>
                    </li>
                </ul>
            </div>
            @else
            <span class="me-3">
                @if(Auth::user()->role == 'admin')
                    <strong class="badge bg-danger fw-bold fs-6">{{ Auth::user()->role }}</strong>
                @elseif(Auth::user()->role == 'employer')
                    <strong class="badge bg-success fw-bold fs-6">{{ Auth::user()->role }}</strong>
                @elseif(Auth::user()->role == 'candidate')
                    <strong class="badge bg-primary fw-bold fs-6">{{ Auth::user()->role }}</strong>
                @endif
            </span>

            <div class="dropdown text-end me-5 border rounded p-2">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user()->image == null)
                    <img src="{{ asset('images/user.png') }}" alt="user image" width="32" height="32" class="rounded-circle me-2">
                    @else
                    <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="user image" width="32" height="32" class="rounded-circle me-2">
                    @endif
                    <span class="me-3"><strong>{{Auth::user()->name}}</strong></span>
                </a>

                <div class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">View Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </div>
            </div>
            @endguest
        </div>
    </header>


    @if (Auth::check() && Auth::user()->role == 'candidate' && (Route::currentRouteName() == 'home' || Route::currentRouteName() == 'home.search'))
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex align-items-center" action="{{ route('home.search') }}" method="GET">
                    <input type="search" name="key" class="form-control form-control-dark me-2" placeholder="Search..." aria-label="Search" value="{{ request()->input('key') }}">
                    <div class="input-group">
                        <select name="criteria" class="form-select" id="inputGroupSelect02">
                            <option value="job_title">Job Title</option>
                            <option value="description">Description</option>
                            <option value="required_skills">Skills</option>
                            <option value="location">Location</option>
                            <option value="work_type">Work Type</option>
                            <option value="work_from">Work From</option>
                            <option value="s_from">Salary greater than</option>
                            <option value="s_to">Salary less than</option>
                        </select>
                        <label class="input-group-text" for="inputGroupSelect02">Criteria</label>
                    </div>
                    <button type="submit" class="btn btn-primary ms-3">Search</button>
                </form>
            </div>
        </div>
    </header>
    @endif

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="text-center text-white w-100 fixed-bottom py-3" style="background-color: #030117;">
        &copy; ITI Laravel Team
    </footer>

</div>

</body>
</html>
