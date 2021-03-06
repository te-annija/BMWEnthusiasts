<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <x-application-logo height="50" class="block w-auto p-1" />
                    {{ config('app.name', 'BMW Enthusiasts') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                 <a class="nav-link" href="{{ action([App\Http\Controllers\PostsController::class, 'index'])}}">{{ __('messages.blog') }}</a>
                            </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="{{ action([App\Http\Controllers\EventsController::class, 'index'])}}">{{ __('messages.events') }}</a>
                            </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="{{ action([App\Http\Controllers\PostsController::class, 'showSearch'])}}">{{ __('messages.search') }}</a>
                            </li>

                        @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ action([App\Http\Controllers\ProfilesController::class, 'show'], Auth::user()->id) }}">{{ __('messages.profile') }}</a>
                                    @can('viewBlocked', App\Models\Profile::class)
                                        <a class="dropdown-item" href="{{ action([App\Http\Controllers\AdminController::class, 'index'])}}">{{ __('messages.blocked_users') }}</a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <a class="nav-link" href="/language/lv"> LV </a>
                        <a class="nav-link" href="/language/en"> EN </a>
                    </ul>
                </div>
            </div>
        </nav>
