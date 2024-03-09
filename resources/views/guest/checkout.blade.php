@extends('layouts.guest')

@section('metaTitle', 'Checkout')

@section('content')
    <section id="guest-checkout">
        <div class="container">

            <div class="row mb-4">
                {{-- details address --}}
                <div class="col-12 col-md-6">
                    <h4 class="fw-semibold text-uppercase mb-4">Indirizzo di consegna</h4>

                    @if(count($user->addresses) > 0)
                        @foreach($user->addresses as $address)
                            <div class="detail-address mb-3">
                                <input {{$address->is_primary == 1 || old('selected_address') == $address->id ? 'checked' : ''}} type="radio" name="selected_address" value="{{$address->id}}">

                                {{-- name & surname --}}
                                <p class="mb-1">{{$user->name}} {{$user->surname}}</p>
                                <p class="mb-1">{{$address->address}} {{$address->house_number}}</p>
                                <p class="mb-1">{{$address->cap}} {{$address->city->name}} ({{$address->province->sigle}})</p>
                                <p class="mb-0">{{$address->nation->name}}</p>
                            </div>
                        @endforeach
                    @endif
                </div> 

                {{-- method payment --}}
                <div class="col-12 col-md-6">
                    <h4 class="fw-semibold text-uppercase mb-4">Metodo di pagamento</h4>

                </div>
            </div>

        </div>
    </section>
@endsection