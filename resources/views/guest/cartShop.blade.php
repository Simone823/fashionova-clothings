@extends('layouts.guest')

@section('metaTitle', 'Carrello')

@section('content')
    <section id='cart-shop'>
        <div class='container'>

            <div class='row'>
                <div class='col-12'>
                    <div class='card card-empty-shop shadow-sm'>
                        {{-- icon bag --}}
                        <figure class='icon-bag'>
                            <img src='/storage/uploads/images/icon-bag-black.svg' alt='Icon bag' />
                        </figure>

                        <p class='mb-0 fw-bold fs-4'>Nessun articolo nel carrello.</p>
                    </div>
                </div>
            </div>

            {{-- {cart.length == 0 ? (
            
        ) : (
            <div class='row'>
                cart products
            </div>
        )} --}}

        </div>
    </section>
@endsection