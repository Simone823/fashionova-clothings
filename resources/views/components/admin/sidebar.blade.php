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

        {{-- Categorie --}}
        @can('categories_view')
            <li class="nav-item mb-2">
                <a class="nav-link @if (Route::is('admin.categories.*')) active @endif" href="{{ route('admin.categories.index') }}">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Categorie</span>
                </a>
            </li>
        @endcan

        {{-- Taglie --}}
        @can('sizes_view')
            <li class="nav-item mb-2">
                <a class="nav-link @if (Route::is('admin.sizes.*')) active @endif" href="{{ route('admin.sizes.index') }}">
                    <i class="fa-solid fa-ruler-combined"></i>
                    <span>Taglie</span>
                </a>
            </li>
        @endcan

        {{-- Colori --}}
        @can('colors_view')
            <li class="nav-item mb-2">
                <a class="nav-link @if (Route::is('admin.colors.*')) active @endif" href="{{ route('admin.colors.index') }}">
                    <i class="fa-solid fa-palette"></i>
                    <span>Colori</span>
                </a>
            </li>
        @endcan

        {{-- Prodotti --}}
        @can('products_view')
            <li class="nav-item mb-2">
                <a class="nav-link @if (Route::is('admin.products.*')) active @endif" href="{{ route('admin.products.index') }}">
                    <i class="fa-solid fa-box-archive"></i>
                    <span>Prodotti</span>
                </a>
            </li>
        @endcan

        {{-- Contatti --}}
        @can('contacts_view')
            <li class="nav-item mb-2">
                <a class="nav-link @if (Route::is('admin.contacts.*')) active @endif" href="{{ route('admin.contacts.index') }}">
                    <i class="fa-solid fa-address-book"></i>
                    <span>Contatti</span>
                </a>
            </li>
        @endcan

        {{-- Indirizzi utente --}}
        @can('user_addresses_view')
            <li class="nav-item mb-2">
                <a class="nav-link @if (Route::is('admin.userAddresses.*')) active @endif" href="{{ route('admin.userAddresses.index') }}">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Indirizzi Utente</span>
                </a>
            </li>
        @endcan

        {{-- Ruolo Admin --}}
        @hasrole('Administrator')
            <li class="nav-item accordion mb-2" id="accordionMenuSidebar">
                {{-- Users management --}}
                <div class="accordion-item">
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

        {{-- Admin tool --}}
        @can('admin_tool')
            <li class="nav-item accordion mb-2" id="accordionMenuSidebar">
                <div class="accordion-item">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fa-solid fa-wrench"></i>
                        <span class="accordion-sidebar-title">
                            Admin Tool
                        </span>
                    </button>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionMenuSidebar">
                        <div class="accordion-body">
                            {{-- cache clear all --}}
                            <a class="list-group-item list-group-item-action" href="{{ route('admin.adminTools.cacheClearAll') }}">
                                <i class="fa-solid fa-cookie"></i>
                                Svuota la Cache
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @endcan
    </ul>
</aside>