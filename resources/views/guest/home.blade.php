@extends('layouts.guest')

@section('metaTitle', 'Home')

@section('content')
    <section id='homepage'>
        {{-- hero --}}
        @include('components.guest.hero')

        <div class='container'>
            {{-- prodotti in sconto --}}
            @if(count($productsDiscounted) > 0)
                <div class="row gy-5 gx-sm-5 mb-5">
                    {{-- title section --}}
                    <div class='col-12'>
                        <h1 class='title-section'>Le migliori offerte per te</h1>
                    </div>

                    @foreach ($productsDiscounted as $product)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                            <article class="card-product">
                                <a href="/">
                                    {{-- images --}}
                                    @if (!empty($product->images))
                                        <div id="carouselImages{{$product->name}}" class="carousel slide carousel-image-product">
                                            <div class="carousel-inner">
                                                @foreach (json_decode($product->images) as $key => $pathImage)
                                                    <div class="carousel-item {{$key == 0 ? ' active' : ''}}">
                                                        <figure class="image-product">
                                                            <img src="/storage/{{ $pathImage }}" class="image-product" alt="{{str_replace(' ', '', $pathImage)}}">
                                                        </figure>
                                                    </div>                                                    
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages{{$product->name}}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselImages{{$product->name}}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    @endif
                
                                    {{-- title --}}
                                    <h3 class="fs-5">{{$product->name}}</h3>
                                    <p class="text-danger fw-bolder mb-1">{{$product->getPriceDiscounted()}} €</p>
                                    <p class="text-secondary">
                                        Prima era:
                                        <span class="text-decoration-line-through">{{$product->price}} €</span>
                                        <span class="text-danger">-{{$product->discount_percent}}%</span>
                                    </p>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- services --}}
            @include('components.guest.services')
        </div>
    </section>
@endsection