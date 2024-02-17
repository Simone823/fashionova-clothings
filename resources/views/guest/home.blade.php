@extends('layouts.guest')

@section('metaTitle', 'Home')

@section('content')
    <section id='homepage'>
        {{-- hero --}}
        @include('components.guest.hero')

        <div class='container'>
            {{-- prodotti in sconto --}}
            @if(count($productsDiscounted) > 0)
                <div class="row gy-4 mb-5">
                    {{-- title --}}
                    <div class='col-12 col-md-5'>
                        <h3 class='title-section-products'>Prodotti in Sconto</h3>

                        {{-- link view all products discounted --}}
                        <a href="{{route('guest.products.productsDiscounted')}}" class="link-primary">Vedi tutti</a>
                    </div>

                    {{-- description --}}
                    <div class="col-12 col-md-7">
                        <p class="description-section-products">
                            Approfitta delle nostre offerte speciali su una vasta selezione di prodotti in sconto. 
                            Trova gli sconti su abbigliamento, scarpe, accessori e molto altro ancora.
                            Risparmia sui tuoi acquisti di moda oggi stesso!
                        </p>
                    </div>
                </div>

                {{-- products card --}}
                <div class="row gy-5 gx-sm-5 mb-5">
                    @foreach ($productsDiscounted as $product)
                        @include('components.guest.productCard')
                    @endforeach
                </div>
            @endif

            {{-- services --}}
            @include('components.guest.services')
        </div>
    </section>
@endsection