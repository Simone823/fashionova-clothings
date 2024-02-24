@extends('layouts.guest')

@section('metaTitle', $titlePage ?? 'Shop')

@section('content')
    <section id='guest-products-shop'>
        <div class='container'>
            {{-- title --}}
            <div class="row mb-5">
                <div class="col-12">
                    <h1 class="mb-0 fw-bold">{{ $titlePage ?? 'Shop' }}</h1>
                </div>
            </div>

            {{-- liste filtri --}}
            <div class="row mb-4">
                <form class="col-12" action="{{ route("guest.products.{$controllerMethodName}") }}" method="GET">
                    {{-- submit o reset filtri --}}
                    <input type="hidden" name="action_submit" id="action_submit" value="0">
                    <input type="hidden" name="action_reset" id="action_reset" value="0">

                    {{-- filtri --}}
                    <div class="filters">
                        {{-- filtro genere --}}
                        @if ($controllerMethodName != 'productsWoman' && $controllerMethodName != 'productsMan')
                            <div class="dropdown-filter-genres">
                                <button class="btn btn-outline-secondary dropdown-toggle fs-5" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    Genere
                                    <span>
                                        @if (count(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.genres', [])) > 0)
                                            ({{ count(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.genres')) }})
                                        @endif
                                    </span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($genres as $genre)
                                        <li class="px-2 mb-2">
                                            <input
                                                {{ in_array($genre->id, session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.genres', [])) ? 'checked' : '' }} type="checkbox" class="btn-check" id="genres-{{ $genre->id }}" name="genres[]" value="{{ $genre->id }}">
                                            <label class="btn btn-outline-dark" for="genres-{{ $genre->id }}">
                                                {{ $genre->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>

                                @error('genres.*')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                        {{-- filtro categorie --}}
                        <div class="dropdown-filter-categories">
                            <button class="btn btn-outline-secondary dropdown-toggle fs-5" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                Categorie
                                <span>
                                    @if (count(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.categories', [])) > 0)
                                        ({{ count(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.categories')) }})
                                    @endif
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($categories as $category)
                                    <li class="px-2 mb-2">
                                        <input
                                            {{ in_array($category->id, session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.categories', [])) ? 'checked' : '' }} type="checkbox" class="btn-check" id="categories-{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                                        <label class="btn btn-outline-dark" for="categories-{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>

                            @error('categories.*')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- filtro taglie --}}
                        <div class="dropdown-filter-sizes">
                            <button class="btn btn-outline-secondary dropdown-toggle fs-5" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                Taglie
                                <span>
                                    @if (count(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.sizes', [])) > 0)
                                        ({{ count(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.sizes')) }})
                                    @endif
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($sizes as $size)
                                    <li class="px-2 mb-2">
                                        <input
                                            {{ in_array($size->id, session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.sizes', [])) ? 'checked' : '' }} type="checkbox" class="btn-check" id="sizes-{{ $size->id }}" name="sizes[]" value="{{ $size->id }}">
                                        <label class="btn btn-outline-dark" for="sizes-{{ $size->id }}">
                                            {{ $size->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>

                            @error('sizes.*')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- filtro colori --}}
                        <div class="dropdown-filter-colors">
                            <button class="btn btn-outline-secondary dropdown-toggle fs-5" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                Colori
                                <span>
                                    @if (count(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.colors', [])) > 0)
                                        ({{ count(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.colors')) }})
                                    @endif
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($colors as $color)
                                    <li class="px-2 mb-2">
                                        <input
                                            {{ in_array($color->id, session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.colors', [])) ? 'checked' : '' }} type="checkbox" class="btn-check" id="colors-{{ $color->id }}" name="colors[]" value="{{ $color->id }}">
                                        <label class="btn btn-outline-dark" for="colors-{{ $color->id }}">
                                            <div class="color-circle d-inline-block" style="background-color: {{ trim(strtolower(str_replace(' ', '', $color->name))) }};">
                                            </div>
                                            {{ $color->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>

                            @error('colors.*')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- ordina per --}}
                        <div class="dropdown-filter-order-by">
                            <button class="btn btn-outline-secondary dropdown-toggle fs-5" type="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                Ordina per
                                <span>
                                    @if (!empty(session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.order_by', '')))
                                        (1)
                                    @endif
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="px-2 mb-2">
                                    <input
                                        {{ session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.order_by', '') == 'price-asc' ? 'checked' : '' }} type="radio" class="btn-check" name="order_by" id="price-asc" value="price-asc" autocomplete="off">
                                    <label class="btn btn-outline-dark" for="price-asc">Prezzo crescente</label>
                                </li>
                                <li class="px-2 mb-2">
                                    <input
                                        {{ session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.order_by', '') == 'price-desc' ? 'checked' : '' }} type="radio" class="btn-check" name="order_by" id="price-desc" value="price-desc" autocomplete="off">
                                    <label class="btn btn btn-outline-dark" for="price-desc">Prezzo descrescente</label>
                                </li>
                                <li class="px-2 mb-2">
                                    <input
                                        {{ session()->get('filters.' . str_replace('/products/', '', request()->server('PATH_INFO')) . '.order_by', '') == 'discount_percent-desc' ? 'checked' : '' }} type="radio" class="btn-check" name="order_by" id="discount_percent-desc" value="discount_percent-desc" autocomplete="off">
                                    <label class="btn btn btn-outline-dark" for="discount_percent-desc">Offerte</label>
                                </li>
                            </ul>

                            @error('order_by')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- btn actions --}}
                    <div class="actions">
                        <button onclick="submitFormFiltersProducts(event);" type="submit" class="btn btn-primary text-uppercase px-4">
                            Applica filtri
                        </button>
                        <button onclick="submitFormFiltersProducts(event);" type="reset" class="btn btn-secondary text-uppercase px-4">
                            Resetta filtri
                        </button>
                    </div>

                    {{-- total products --}}
                    <div class="count-products">
                        <p class="mb-0 text-secondary">
                            {{ $products->total() }} prodotti
                        </p>
                    </div>
                </form>
            </div>

            {{-- list products --}}
            <div class="row gy-5 gx-sm-4">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        @include('components.guest.productCard')
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="bg-info bg-opacity-75 p-3">
                            <strong>Info!</strong>
                            Nessun Prodotto
                        </div>
                    </div>
                @endif
            </div>

            {{-- Paginate --}}
            @if (count($products) > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        {!! $products->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection