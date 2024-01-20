<aside id="sidebar">
    {{-- nav logo --}}
    <div class="wrapper-logo w-100 mb-5">
        <a class="nav-brand" href="{{ route('guest.home') }}">
            <figure class="nav-logo">
                <img src="/storage/uploads/images/icon-black.png" alt="Logo">
            </figure>
        </a>
    </div>

    {{-- menu links --}}
    <ul class="navbar-nav">
        {{-- Home --}}
        <li class="nav-item mb-2">
            <a class="nav-link @if (Route::is('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-grip"></i>
                <span>Home</span>
            </a>
        </li>
    </ul>
</aside>