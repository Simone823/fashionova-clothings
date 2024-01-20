<div id="main-bar" class="shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        {{-- btn hamburger menu (close / open sidebar) --}}
        <button onclick="toggleCloseSidebar()" class="hamburger-btn" type="button">
            <i class="fa-solid fa-arrow-left fs-4"></i>
        </button>

        {{-- buttons --}}
        <div class="buttons-right">
            {{-- btn profile --}}
            <div class="dropdown">
                <button class="dropdown-toggle fw-semibold" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,9">
                    <i class="fa-solid fa-user me-1"></i>
                    <span>{{Auth::user()->name}} {{Auth::user()->surname}}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark animate shadow" aria-labelledby="profileDropdown">
                    {{-- User info --}}
                    <li class="dropdown-header">
                        <p class="fw-semibold">
                            <i class="fa-regular fa-user me-1"></i>
                            {{Auth::user()->name}} {{ Auth::user()->surname }}
                        </p>
                        <p class="mb-0">
                            <i class="fa-regular fa-envelope me-1"></i>
                            {{ Auth::user()->email }}
                        </p>
                    </li>
                    <li><hr class="dropdown-divider bg-secondary"></li>

                    {{-- Profile --}}
                    <li>
                        <a class="dropdown-item @if(Route::is('admin.profiles.*')) active @endif" href="{{ route('admin.profiles.show', Auth::id()) }}">
                            <i class="fa-solid fa-user-gear"></i>
                            Profilo
                        </a>
                    </li>

                    {{-- Logout --}}
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Disconnetti
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>