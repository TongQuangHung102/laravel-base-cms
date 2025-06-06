<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        .nav-item .nav-link.active {
            font-weight: bold;
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                {{-- aria-label="{{ __('Toggle navigation') }}" --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                                    href="{{ route('login') }}">{{ 'Login' }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                                        href="{{ route('register') }}">{{ 'Register' }}</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('listpage') || request()->routeIs('pages.*') ? 'active' : '' }}"
                                    href="{{ route('pages.index') }}">{{ 'Page' }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}"
                                    href="{{ route('posts.index') }}">{{ 'Post' }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                    class="nav-link dropdown-toggle {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('profile') ? 'active' : '' }}"
                                            href="{{ route('profile.profile') }}">
                                            {{ 'Profile' }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('posts.my-posts') ? 'active' : '' }}"
                                            href="{{ route('profile.my-posts') }}">{{ 'Bài viết của tôi' }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ 'Logout' }}
                                        </a>
                                    </li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('pages.*') ? 'active' : '' }}"
                                    href="{{ route('pages.index') }}">{{ 'Page' }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}"
                                    href="{{ route('posts.index') }}">{{ 'Post' }}</a>
                            </li>
                            @if (Auth::check() && Auth::user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                                        href="{{ route('users.listUser') }}">{{ 'User' }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
