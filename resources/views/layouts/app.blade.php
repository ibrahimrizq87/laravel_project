<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BetterCareer</title>
    <link rel="icon" href="{{ asset('images/job.png') }}" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <header class="navbar navbar-expand-lg navbar-light shadow" style="background-color: #f2f2f2;">
        <div class="container-fluid">
            <a class="navbar-brand ms-5 text-body border rounded p-1" href="/">
                <img src="{{ asset('images/job.png') }}" width="50">  
                BetterCareer
            </a>
            
            @auth
            <ul class="nav nav-tabs  col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-5">

                <li><a href="{{route('home')}}" class="nav-link px-2  {{ Route::currentRouteName() == 'home' ? 'active  link-secondary' : 'link-dark' }}">home</a></li>
                @if ( Auth::user()->role == 'employer')
                <li><a href="{{route('job_posts.create')}}" class="nav-link px-2  {{ Route::currentRouteName() == 'job_posts.create' ? 'active  link-secondary' : 'link-dark' }}">Add Jop Post</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">View Applications</a></li>

                @endif
                @if ( Auth::user()->role == 'admin')
                <li><a href="#" class="nav-link px-2 link-dark">View Applications</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Posts Acceptance</a></li>
                @endif
            </ul>
            @endauth
            @guest
            <div class="collapse navbar-collapse justify-content-end ms-5" id="navbarNav">
                <ul class="navbar-nav me-5">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <button class="btn btn-info">Login</button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <button class="btn btn-light">Register</button>
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
        <!-- <strong class="badge bg-secondary">{{ Auth::user()->role }}</strong> -->
        <!-- {{ Auth::user()->role == 'admin' ? 'border-danger text-danger' : (Auth::user()->role == 'employer' ? 'border-success text-success' : (Auth::user()->role == 'candidate' ? 'border-primary text-primary' : 'border-secondary text-secondary')) }} -->

    
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

                <div class="dropdown-menu text-small " aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{route('users.show' , $user->id)}}">View Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </div>
            </div>
            
            @endguest
        </div>
    </header>
  
    @if (Auth::check() && Auth::user()->role == 'candidate')
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex align-items-center">
                    <input type="search" class="form-control form-control-dark me-2" placeholder="Search..." aria-label="Search">
                    <div class="input-group">
                        <select class="form-select" id="inputGroupSelect02">
                            <option value="location">Location</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label class="input-group-text" for="inputGroupSelect02">Criteria</label>
                    </div>
                </form>
            </div>
        </div>
    </header>
    @endif


    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
