<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">

        {{-- logo --}}
        <a class="navbar-brand" href="/">
            <img src='/storage/uploads/images/icon-black.png' alt='Logo' />
        </a>

        {{-- btn mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- menu --}}
        <div class="collapse navbar-collapse align-items-center" id="navbarNav">
            {{-- nav link --}}
            <ul class="navbar-nav flex-grow-1 justify-content-center gap-4 pt-5 pt-md-0 mb-4 mb-md-0">
                <li class="nav-item">
                    <a href="{{ route('guest.home') }}" class="nav-link text-uppercase @if (Route::is('guest.home')) active @endif">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/products" class='nav-link text-uppercase'>
                        Prodotti
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guest.contactUs') }}" class="nav-link text-uppercase @if (Route::is('guest.contactUs')) active @endif">
                        Contattaci
                    </a>
                </li>
            </ul>

            {{-- buttons --}}
            <ul class='navbar-nav gap-4 align-items-md-center'>
                {{-- Cart shop --}}
                <li class='nav-item'>
                    <a href="{{ route('guest.cartShop') }}" class='nav-link position-relative @if (Route::is('guest.cartShop')) active @endif'>
                        <i class="fa-solid fa-cart-shopping fs-4"></i>
                        <span class="cart-total-item position-absolute top-1 start-100 translate-middle badge rounded-pill bg-primary">
                            <span class="visually-hidden">prodotti nel carrello</span>
                        </span>
                    </a>
                </li>

                {{-- User --}}
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="bg-transparent text-secondary border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user fs-4"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end bg-body-secondary shadow-md">
                            {{-- guest --}}
                            @guest 
                                <li class="px-1">
                                    <a class="btn btn-primary w-100 text-uppercase fw-bolder px-5 mb-2" href="{{route('login')}}">Accedi</a>
                                    <p class="mb-0 text-center">
                                        Nuovo Cliente?
                                        <a href="{{route('register')}}" class="fw-bold">
                                            Registrati ora
                                        </a>
                                    </p>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endguest

                            {{-- Auth --}}
                            @auth
                                <li class="px-1">
                                    <a class="btn btn-primary w-100 text-uppercase fw-bolder px-5" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        Esci
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item @if(Route::is('user.dashboard')) active @endif" href="{{route('user.dashboard')}}">
                                        <i class="fa-solid fa-grip"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item @if(Route::is('user.profiles.*')) active @endif" href="{{route('user.profiles.show', Auth::id())}}">
                                        <i class="fa-solid fa-user-gear"></i>
                                        Profilo
                                    </a>
                                </li>
                            @endauth
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</nav>


{{-- JS --}}
<script type="module">
    // Totale prodotti nel carrello
    document.querySelector('.cart-total-item').innerText = getTotalItemToCart();
</script>