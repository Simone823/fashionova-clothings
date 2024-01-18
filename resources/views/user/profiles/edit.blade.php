@extends('layouts.guest')

@section('metaTitle', "Modifica Profilo Utente {$user->name} {$user->surname}")

@section('content')
    <section id='user-profiles-edit'>
        <div class='container'>

            {{-- title --}}
            <div class='row mb-5'>
                <div class='col-12'>
                    <h1 class='title-section'>Modifica Profilo</h1>
                </div>
            </div>

            {{-- turn back --}}
            <div class="row mb-4">
                <div class="col-12">
                    <a href="{{url()->previous()}}">
                        <i class="fa-solid fa-arrow-left"></i>
                        Torna indietro
                    </a>
                </div>
            </div>

            {{-- card profile --}}
            <div class='row'>
                <div class='col-12'>
                    <div class='card bg-body-secondary border-0 shadow-sm p-4'>
                        <form action="{{route('user.profiles.update', $user->id)}}" method="POST" class='row'>
                            @csrf

                            {{-- details user --}}
                            <div class="row mb-4">
                                {{-- title --}}
                                <div class="col-12 mb-4">
                                    <h4 class="fw-semibold mb-0">Dettagli Utente</h4>
                                </div>

                                {{-- name --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="name" class="form-label">Nome*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $user->name)}}" placeholder="Il tuo nome" >

                                    @error('name')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                {{-- surname --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="surname" class="form-label">Cognome*</label>
                                    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{old('surname', $user->surname)}}" placeholder="Il tuo cognome" >

                                    @error('surname')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                {{-- email --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $user->email)}}" placeholder="Il tuo indirizzo email" >

                                    @error('email')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- user addresses --}}
                            <div class="row mb-5">
                                {{-- title --}}
                                <div class="col-12 mb-4">
                                    <h4 class="fw-semibold mb-0">Dettagli Indirizzi</h4>
                                </div>

                                @if(count($user->addresses) > 0)
                                    @foreach($user->addresses as $address)
                                        <div class="row mb-4">
                                            {{-- is primary --}}
                                            <div class="col-12 mb-4">
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" for="user_address_{{ $address->id }}_is_primary">
                                                        Indirizzo primario
                                                    </label>
                                                    <input {{ $address->is_primary == 1 || old("user_addresses.{$address->id}.is_primary") == 'on' ? 'checked' : '' }}  class="form-check-input @error("user_addresses.{$address->id}.is_primary") is-invalid @enderror" type="checkbox" role="switch" name="user_addresses[{{ $address->id }}][is_primary]" id="user_address_{{ $address->id }}_is_primary">
                                                
                                                    @error("user_addresses.{$address->id}.is_primary")
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- nation id --}}
                                            <div class="col-12 col-md-6 mb-4 form-group">
                                                <label for="user_address_{{ $address->id }}_nation_id" class="form-label">Nazione</label>
                                                <select class="form-select @error("user_addresses.{$address->id}.nation_id") is-invalid @enderror" name="user_addresses[{{ $address->id }}][nation_id]" id="user_address_{{ $address->id }}_nation_id" required>
                                                    <option value="" selected hidden>-- Seleziona una Nazione --</option>
                                                    <option {{ $address->nation_id == $nation->id || old("user_addresses.{$address->id}.nation_id") == $nation->id ? 'selected' : '' }}  value="{{$nation->id}}">
                                                        {{ $nation->name }}
                                                    </option>
                                                </select>

                                                @error("user_addresses.{$address->id}.nation_id")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- region_id --}}
                                            <div class="col-12 col-md-6 mb-4 form-group">
                                                <label for="user_address_{{ $address->id }}_region_id" class="form-label">Regione</label>
                                                <select onchange="filterProvinceByRegionId(event)" class="form-select @error("user_addresses.{$address->id}.region_id") is-invalid @enderror" name="user_addresses[{{ $address->id }}][region_id]" id="user_address_{{ $address->id }}_region_id" required>
                                                    <option value="" selected hidden>-- Seleziona una Regione --</option>
                                                    @foreach ($regions as $region)
                                                        <option {{ $address->region_id == $region->id || old("user_addresses.{$address->id}.region_id") == $region->id ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->name }}</option>
                                                    @endforeach
                                                </select>
                                            
                                                @error("user_addresses.{$address->id}.region_id")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- province_id --}}
                                            <div class="col-12 col-md-6 mb-4 form-group">
                                                <label for="province_id" class="form-label">Provincia</label>
                                                <select class="form-select @error("user_addresses.{$address->id}.province_id") is-invalid @enderror" name="user_addresses[{{ $address->id }}][province_id]" id="user_address_{{ $address->id }}_province_id" required>
                                                    <option value="">-- Seleziona una Provincia --</option>
                                                    @foreach ($provinces as $province)
                                                        <option {{$address->province_id == $province->id || old("user_addresses.{$address->id}.province_id") == $province->id ? 'selected' : ''}} data-region-id="{{$province->region_id}}" value="{{$province->id}}">{{$province->name}}</option>
                                                    @endforeach
                                                </select>
                                            
                                                @error("user_addresses.{$address->id}.province_id")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- city_id --}}
                                            <div class="col-12 col-md-6 mb-4 form-group">
                                                <label for="city_id" class="form-label">Comune</label>
                                                <select class="form-select @error("user_addresses.{$address->id}.city_id") is-invalid @enderror" name="user_addresses[{{ $address->id }}][city_id]" id="user_address_{{ $address->id }}_city_id" required>
                                                    <option value="" selected hidden>-- Seleziona un Comune --</option>
                                                    @foreach ($cities as $city)
                                                        <option {{$address->city_id == $city->id || old("user_addresses.{$address->id}.city") == $city->id  ? 'selected' : ''}} data-province-id="{{$city->province_id}}" value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                            
                                                @error("user_addresses.{$address->id}.city_id")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- cap --}}
                                            <div class="col-12 col-md-6 mb-4 form-group">
                                                <label for="cap" class="form-label">Cap</label>
                                                <input type="number" class="form-control @error("user_addresses.{$address->id}.cap") is-invalid @enderror" name="user_addresses[{{ $address->id }}][cap]" id="user_address_{{ $address->id }}_cap" value="{{old("user_addresses.{$address->id}.cap", $address->cap)}}" placeholder="Cap" required>
                                            
                                                @error("user_addresses.{$address->id}.cap")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- address --}}
                                            <div class="col-12 col-md-6 mb-4 form-group">
                                                <label for="address" class="form-label">Indirizzo</label>
                                                <input type="text" class="form-control @error("user_addresses.{$address->id}.address") is-invalid @enderror" name="user_addresses[{{ $address->id }}][address]" id="user_address_{{ $address->id }}_address" value="{{old("user_addresses.{$address->id}.address", $address->address)}}" placeholder="Via / Piazza">
                                            
                                                @error("user_addresses.{$address->id}.address")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- house number --}}
                                            <div class="col-12 col-md-6 mb-4 form-group">
                                                <label for="house_number" class="form-label">Numero Civico</label>
                                                <input type="text" class="form-control @error("user_addresses.{$address->id}.house_number") is-invalid @enderror" name="user_addresses[{{ $address->id }}][house_number]" id="user_address_{{ $address->id }}_house_number" value="{{old("user_addresses.{$address->id}.house_number", $address->house_number)}}" placeholder="Numero civico" >
                                            
                                                @error("user_addresses.{$address->id}.house_number")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- line divider --}}
                                            <div class="col-12">
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @else
                                        <div class="col-12 col-md-6">
                                            <div class="alert alert-primary" role="alert">
                                                Nessun Indirizzo presente.
                                            </div>
                                        </div>
                                @endif
                            </div>
                            

                            {{-- btn submit --}}
                            <div class="row">
                                <div class='col-12'>
                                    <button type='submit' class='btn btn-primary text-uppercase px-5'>
                                        Salva modifica
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection