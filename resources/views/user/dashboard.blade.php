@extends('layouts.guest')

@section('metaTitle', 'User Dashboard')

@section('content')
    <section id='user-dashboard'>
        <div class='container'>

            {{-- title --}}
            <div class='row mb-5'>
                <div class='col-12'>
                    <h1 class='title-section'>Dashboard</h1>
                </div>
            </div>

            {{-- cards --}}
            <div class='row gy-5'>
                {{-- my orders --}}
                <div class='col-12 col-sm-6 col-lg-4'>
                    <a href="" class='card border-0 shadow-sm p-4 d-flex justify-content-center align-items-center gap-4'>
                        <i class="fa-solid fa-boxes-stacked fs-1"></i>
                        <p class="mb-0 fs-5 fw-bolder">I miei Ordini</p>
                    </a>
                </div>

                {{-- my cart shop --}}
                <div class='col-12 col-sm-6 col-lg-4'>
                    <a href="{{route('guest.cartShop')}}" class='card border-0 shadow-sm p-4 d-flex justify-content-center align-items-center gap-4'>
                        <i class="fa-solid fa-cart-shopping fs-1"></i>
                        <p class="mb-0 fs-5 fw-bolder">Il mio Carrello</p>
                    </a>
                </div>

                {{-- my profile --}}
                <div class='col-12 col-sm-6 col-lg-4'>
                    <a href="{{route('user.profiles.show', Auth::id())}}" class='card border-0 shadow-sm p-4 d-flex justify-content-center align-items-center gap-4'>
                        <i class="fa-solid fa-user-gear fs-1"></i>
                        <p class="mb-0 fs-5 fw-bolder">Il mio Profilo</p>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection