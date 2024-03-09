@extends('layouts.guest')

@section('metaTitle', 'Carrello')

@section('content')
    <section id='guest-cart-shop'>
        <div class='container'>

            {{-- carrello non vuoto --}}
            <div id="row-card-shop-not-empty" class='row gy-5 d-none'>
                {{-- card shop --}}
                <div class='col-12 col-md-8'>
                    <div class="card card-shop">
                        <h1 class="fs-4 mb-5 fw-bold">Carrello</h1>

                        {{-- lista prodotti --}}
                        <ul class="list-products">
                            {{-- js --}}
                        </ul>
                    </div>
                </div>

                {{-- card totale --}}
                <div class="col-12 col-md-4">
                    <div class="card card-total">
                        <h1 class="fs-4 mb-5 fw-bold">Totale</h1>

                        <p class="subtotal d-flex justify-content-between">
                            Subtotale
                            <span>0.00 €</span>
                        </p>

                        <p class="shipping d-flex justify-content-between">
                            Spedizione
                            <span>0.00 €</span>
                        </p>

                        <p class="total fw-bold d-flex justify-content-between">
                            Totale (IVA inclusa)
                            <span>0.00 €</span>
                        </p>

                        <a class="btn btn-primary text-uppercase w-100" href="{{route('guest.cartShop.checkout')}}">
                            Procedi
                        </a>
                    </div>
                </div>
            </div>

            {{-- carrello vuoto --}}
            <div id="row-card-shop-empty" class="row d-none">
                <div class="col-12">
                    <div class='card card-empty-shop shadow-sm'>
                        {{-- icon bag --}}
                        <figure class='icon-bag'>
                            <img src='/storage/uploads/images/icon-bag-black.svg' alt='Icon bag' />
                        </figure>

                        <p class='mb-0 fw-bold fs-4'>Nessun articolo nel carrello.</p>

                        {{-- btn go to shop --}}
                        <a href="{{route('guest.products.shop')}}" class="btn btn-primary text-uppercase">
                            Vai allo shop
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection