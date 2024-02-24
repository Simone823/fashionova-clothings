@extends('layouts.guest')

@section('metaTitle', "Visualizza Prodotto: {$product->name}")

@section('content')
    <section id='guest-products-show'>
        <div class='container'>

            {{-- turn back --}}
            <div class="row mb-5">
                <div class="col-12">
                    <a href="{{url()->previous()}}" class="link-primary">
                        <i class="fa-solid fa-circle-chevron-left me-1"></i>
                        Torna indietro
                    </a>
                </div>
            </div>

            {{-- row prodotto --}}
            <div class="row gy-4">
                {{-- immagini prodotto --}}
                <div class="col-12 col-md-6">
                    {{-- carousel images --}}
                    @if (!empty($product->images))
                        <div id="carouselImages" class="carousel slide carousel-image-product">
                            <div class="carousel-inner">
                                @foreach (json_decode($product->images) as $key => $pathImage)
                                    <div class="carousel-item {{$key == 0 ? ' active' : ''}}">
                                        <figure class="figure-image-product">
                                            <img src="/storage/{{ $pathImage }}" class="image-product shadow-sm" alt="{{str_replace('uploads/images/products/', '', $pathImage)}}">
                                        </figure>
                                    </div>                                                    
                                @endforeach

                                {{-- badges --}}
                                <div class="wrapper-badges">
                                    @if(Carbon\Carbon::parse($product->created_at)->diffInDays() < 30)
                                        <span class="badge bg-secondary text-uppercase">New</span>
                                    @endif

                                    @if (!empty($product->discount_percent))
                                        <span class="badge bg-danger text-uppercase">Sconto</span>
                                    @endif
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif
                </div>

                {{-- dettagli prodotto --}}
                <div class="col-12 col-md-6">
                    {{-- details product --}}
                    <div class="details-product">
                        {{-- name --}}
                        <h3 class="product-name">{{$product->name}}</h3>

                        {{-- genre --}}
                        <p class="product-genre">
                            Genere: {{$product->genre->name}}
                        </p>
                        
                        {{-- price --}}
                        @if(empty($product->discount_percent))
                            <p class="product-price">
                                {{$product->price}} €
                                <span class="text-secondary">IVA inclusa</span>
                            </p>

                            @else
                                <p class="product-price-discounted">
                                    {{$product->price_discounted}} €
                                    <span class="text-secondary fw-normal">IVA inclusa</span>
                                </p>
                                <p class="product-price-normal text-secondary">
                                    Prezzo normale:
                                    <span class="text-decoration-line-through">{{$product->price}} €</span>
                                    <span class="text-danger">-{{$product->discount_percent}}%</span>
                                </p>
                        @endif
                    </div>

                    {{-- colors product --}}
                    <div class="colors-product">
                        @foreach ($product->colors->unique() as $key => $color)
                            <input {{$key == 0 ? 'checked' : ''}} type="radio" class="btn-check" id="color-{{$color->id}}" name="color_id" value="{{$color->id}}" data-color-name="{{$color->name}}" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="color-{{$color->id}}">
                                <div class="color-circle" style="background-color: {{trim(strtolower(str_replace(' ', '-', $color->name)))}};">
                                </div>
                                {{$color->name}}
                            </label>
                        @endforeach
                    </div>

                    {{-- sizes product --}}
                    <div class="sizes-product">
                        <select class="form-select" name="size_id" id="size_id">
                            <option value="" selected hidden>-- Scegli una Taglia --</option>
                            @foreach ($product->sizes as $size)
                                <option value="{{$size->id}}" data-size-name="{{$size->name}}">
                                    {{$size->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- btn actions --}}
                    <div class="actions-btn d-flex">
                        <button onclick="addItemToCart({{json_encode($product)}});" type="button" class="btn btn-primary text-uppercase flex-grow-1">
                            <i class="fa-solid fa-cart-plus me-1"></i>
                            Aggiungi al carrello
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection