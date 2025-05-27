<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" style="height: 40px; max-width: 120px; object-fit: contain;">
        </a>

        {{-- Hamburger dugme --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navigacija --}}
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/cars*') ? 'active' : '' }}" href="{{ url('/admin/cars') }}">Automobili</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/rentals*') ? 'active' : '' }}" href="{{ url('/admin/rentals') }}">Iznajmljivanja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/equipment*') ? 'active' : '' }}" href="{{ url('/admin/equipment') }}">Oprema</a>
                        </li>
                    @elseif(Auth::user()->role === 'user')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Početna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Katalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontakt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('my-rentals') ? 'active' : '' }}" href="{{ route('user.rentals.index') }}">Moje rezervacije</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Početna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontakt</a>
                    </li>
                @endauth
            </ul>

            {{-- Desni meni (korisnik) --}}
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Odjava</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Prijava</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registracija</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
