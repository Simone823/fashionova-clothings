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
        <div class="collapse navbar-collapse" id="navbarNav">
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
            <ul class='navbar-nav gap-4'>
                <li class='nav-item'>
                    <a href="{{ route('guest.cartShop') }}"
                        class='nav-link position-relative @if (Route::is('guest.cartShop')) active @endif'>
                        <i class="fa-solid fa-cart-shopping fs-4"></i>
                        <span class="cart-total-item position-absolute top-1 start-100 translate-middle badge rounded-pill bg-primary">
                            <span class="visually-hidden">prodotti nel carrello</span>
                        </span>
                    </a>
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