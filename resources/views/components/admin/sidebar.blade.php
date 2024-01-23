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

        {{-- Ruolo Admin --}}
        @hasrole('Administrator')
            <li class="nav-item accordion mb-2" id="accordionMenuSidebar">
                {{-- Users management --}}
                <div class="accordion-item mb-2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <i class="fa-solid fa-gear"></i>
                        <span class="accordion-sidebar-title">Impostazioni</span>
                    </button>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionMenuSidebar">
                        <div class="accordion-body">
                            {{-- Permissions --}}
                            @can('permissions_view')
                                <a class="list-group-item list-group-item-action @if (Route::is('admin.permissions.*')) accordion-active-link @endif"
                                    href="{{ route('admin.permissions.index') }}">
                                    <i class="fa-solid fa-briefcase"></i>
                                    Permessi
                                </a>
                            @endcan

                            {{-- Roles --}}
                            @can('roles_view')
                                <a class="list-group-item list-group-item-action @if (Route::is('admin.roles.*')) accordion-active-link @endif"
                                    href="{{ route('admin.roles.index') }}">
                                    <i class="fa-solid fa-medal"></i>
                                    Ruoli
                                </a>
                            @endcan
                            
                            {{-- Users --}}
                            @can('users_view')
                                <a class="list-group-item list-group-item-action @if (Route::is('admin.users.*')) accordion-active-link @endif"
                                    href="{{ route('admin.users.index') }}">
                                    <i class="fa-solid fa-user"></i>
                                    Utenti
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </li>
        @endhasrole
    </ul>
</aside>