<footer>
    <div class="container pt-5 pb-2">

        {{-- details --}}
        <div class="row mb-5 gy-4">
            {{-- logo --}}
            <div class='col-12 col-md-4'>
                <a href='/' class='logo'>
                    <img src='/storage/uploads/images/icon-black.png' />
                </a>
            </div>

            {{-- menu --}}
            <div class="col-12 col-md-4">
                <div class="title mb-4">
                    <h5 class="mb-0 text-uppercase fw-bolder">Menù</h5>
                </div>

                {{-- links --}}
                <ul class="list_link list-unstyled">
                    <li class="mb-2">
                        <a href='/' class='link-secondary'>Home</a>
                    </li>
                    <li class="mb-2">
                        <a href='/products' class='link-secondary'>Prodotti</a>
                    </li>
                    <li class="mb-2">
                        <a href='/contact-us' class='link-secondary'>Contattaci</a>
                    </li>
                    <li>
                        <a href='/cart-shop' class='link-secondary'>Carrello</a>
                    </li>
                </ul>
            </div>

            {{-- Referenze --}}
            <div class="col-12 col-md-4">
                <div class="title mb-4">
                    <h5 class="mb-0 text-uppercase fw-bolder">Contatti</h5>
                </div>

                {{-- contact --}}
                <ul class="detail_list list-unstyled">
                    <li class="mb-2">
                        <p class="fw-bolder text-secondary">
                            <i class="fa-solid fa-location-dot me-2"></i>
                            Indirizzo:
                            <span class="fw-normal ms-2">Via Esempio 10, Italia</span>
                        </p>
                    </li>
                    <li class="mb-2">
                        <p class="fw-bolder text-secondary">
                            <i class="fa-solid fa-phone me-2"></i>
                            Telefono:
                            <span class="fw-normal ms-2">000 000 0000</span>
                        </p>
                    </li>
                    <li>
                        <p class="fw-bolder text-secondary">
                            <i class="fa-solid fa-envelope me-2"></i>
                            E-mail:
                            <span class="fw-normal ms-2">fashionova@info.local</span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>

        {{-- copyright --}}
        <div class="row">
            <div class="col-12 text-center">
                <h6>
                    © Copyright {{date('Y')}} Fashionova Clothings | Tutti i diritti riservati.
                </h6>
                <h6>
                    Powered by
                    <a target='_blank' class="text-decoration-none fw-bold" href="https://simonedaglio.it"> 
                        @Simone Daglio
                    </a>
                </h6>
            </div>
        </div>

    </div>
</footer>