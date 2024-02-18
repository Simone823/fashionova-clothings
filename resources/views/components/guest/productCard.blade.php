<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
    <article class="card-product">
        <a href="/">
            {{-- images --}}
            @if (!empty($product->images))
                <div id="carouselImages{{$product->code}}" class="carousel slide carousel-image-product">
                    <div class="carousel-inner">
                        @foreach (json_decode($product->images) as $key => $pathImage)
                            <div class="carousel-item {{$key == 0 ? ' active' : ''}}">
                                <figure class="image-product">
                                    <img src="/storage/{{ $pathImage }}" class="image-product" alt="{{str_replace(' ', '', $pathImage)}}">
                                    
                                    {{-- badges --}}
                                    <div class="wrapper-badges">
                                        @if (!empty($product->discount_percent))
                                            <span class="badge bg-danger text-uppercase">Sconto</span>
                                        @endif
                                    </div>
                                </figure>
                            </div>                                                    
                        @endforeach

                        <span class="badge bg-danger">Sconto</span>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages{{$product->code}}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImages{{$product->code}}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif

            {{-- details --}}
            <div class="details-product">
                <h3 class="product-title">{{$product->name}}</h3>
                <div class="colors mb-2">
                    <span>Colori:</span>
                    @foreach ($product->colors->unique() as $color)
                        <div class="color-circle" style="background-color: {{trim(strtolower(str_replace(' ', '', $color->name)))}};"></div>
                    @endforeach
                </div>
                @if(!empty($product->discount_percent))
                    <p class="text-danger fw-bolder mb-1">{{$product->getPriceDiscounted()}} €</p>
                    <p class="text-secondary mb-0">
                        Prima era:
                        <span class="text-decoration-line-through">{{$product->price}} €</span>
                        <span class="text-danger">-{{$product->discount_percent}}%</span>
                    </p>

                    @else
                        <p class="mb-0">{{$product->price}} €</p>
                @endif
            </div>
        </a>
    </article>
</div>