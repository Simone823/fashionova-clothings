@extends('layouts.guest')

@section('metaTitle', "Profilo Utente {$user->name} {$user->surname}")

@section('content')
    <section id='user-profiles-show'>
        <div class='container'>

            {{-- title --}}
            <div class='row mb-5'>
                <div class='col-12'>
                    <h1 class='title-section'>Visualizza Profilo</h1>
                </div>
            </div>

            {{-- card profile --}}
            <div class='row'>
                <div class='col-12'>
                    <div class='card bg-body-secondary border-0 shadow-sm p-4'>

                        {{-- user details --}}
                        <div class='row mb-4'>
                            {{-- buttons --}}
                            <div class="col-12 d-flex flex-wrap gap-3 mb-4">
                                {{-- btn edit --}}
                                <a href="{{route('user.profiles.edit', Auth::id())}}" class="btn btn-primary text-uppercase">
                                    Modifica
                                </a>

                                {{-- btn modal change password --}}
                                @include('user.profiles.changePasswordModal')

                                {{-- btn modal create address --}}
                                @include('user.profiles.createAddressModal')

                                {{-- btn modal delete --}}
                                @include('user.profiles.deleteModal')
                            </div>
                            
                            {{-- verify email --}}
                            <div class="col-12 mb-5">
                                @if ($user->email_verified_at == null)
                                    <p class="mb-0">
                                        La tua email non è stata verificata. 
                                        <a href="{{ route('verification.notice') }}">
                                            Clicca qui per richiedere una nuova email di verifica
                                        </a>
                                    </p>

                                    @else
                                        <p class="mb-0">
                                            <i class="fa-solid fa-circle-check text-success fs-5"></i>
                                            Email verificata
                                        </p>
                                @endif
                            </div>

                            {{-- title --}}
                            <div class="col-12 mb-4">
                                <h4 class="fw-semibold mb-0">Dettagli Utente</h4>
                            </div>

                            {{-- name --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Il tuo nome" readonly>
                            </div>

                            {{-- surname --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="surname" class="form-label">Cognome</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}" placeholder="Il tuo cognome" readonly>
                            </div>

                            {{-- email --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="Il tuo indirizzo email" readonly>
                            </div>
                        </div>

                        {{-- user addresses --}}
                        <div class="row">
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
                                                <label class="form-check-label" for="is_primary">
                                                    Indirizzo primario
                                                </label>
                                                <input {{$address->is_primary == 1 ? 'checked' : ''}} class="form-check-input" type="checkbox" role="switch" id="is_primary" name="is_primary" readonly disabled>
                                            </div>
                                        </div>

                                        {{-- nation id --}}
                                        <div class="col-12 col-md-6 mb-4 form-group">
                                            <label for="nation_id" class="form-label">Nazione</label>
                                            <select class="form-select @error('nation_id') is-invalid @enderror" name="nation_id" id="nation_id" readonly disabled>
                                                <option value="" selected hidden>-- Seleziona una Nazione --</option>
                                                <option selected value="{{App\Nation::where('name', 'Italia')->pluck('id')->first()}}">{{App\Nation::where('name', 'Italia')->pluck('name')->first()}}</option>
                                            </select>

                                            @error('nation_id')
                                                <div class="text-danger mt-1">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- region_id --}}
                                        <div class="col-12 col-md-6 mb-4 form-group">
                                            <label for="region_id" class="form-label">Regione</label>
                                            <select onchange="filterProvinceByRegionId(event)" class="form-select" name="region_id" id="region_id" readonly disabled>
                                                <option value="" selected hidden>-- Seleziona una Regione --</option>
                                                @foreach (App\Region::orderBy('name', 'asc')->get() as $region)
                                                    <option {{$address->region_id == $region->id ? 'selected' : ''}} value="{{$region->id}}">{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- province_id --}}
                                        <div class="col-12 col-md-6 mb-4 form-group">
                                            <label for="province_id" class="form-label">Provincia</label>
                                            <select class="form-select" name="province_id" id="province_id" readonly disabled>
                                                <option value="">-- Seleziona una Provincia --</option>
                                                @foreach (App\Province::orderBy('name', 'asc')->get() as $province)
                                                    <option {{$address->province_id == $province->id ? 'selected' : ''}} data-region-id="{{$province->region_id}}" value="{{$province->id}}">{{$province->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- city_id --}}
                                        <div class="col-12 col-md-6 mb-4 form-group">
                                            <label for="city_id" class="form-label">Comune</label>
                                            <select class="form-select" name="city_id" id="city_id" readonly disabled>
                                                <option value="" selected hidden>-- Seleziona un Comune --</option>
                                                @foreach (App\City::orderBy('name', 'asc')->get() as $city)
                                                    <option {{$address->city_id == $city->id ? 'selected' : ''}} data-province-id="{{$city->province_id}}" value="{{$city->id}}">{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- cap --}}
                                        <div class="col-12 col-md-6 mb-4 form-group">
                                            <label for="cap" class="form-label">Cap</label>
                                            <input type="number" class="form-control" id="cap" name="cap" value="{{$address->cap}}" placeholder="Cap" readonly>
                                        </div>

                                        {{-- address --}}
                                        <div class="col-12 col-md-6 mb-4 form-group">
                                            <label for="address" class="form-label">Indirizzo</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{$address->address}}" placeholder="Via / Piazza" readonly>
                                        </div>

                                        {{-- house number --}}
                                        <div class="col-12 col-md-6 mb-4 form-group">
                                            <label for="house_number" class="form-label">Numero Civico</label>
                                            <input type="text" class="form-control" id="house_number" name="house_number" value="{{$address->house_number}}" placeholder="Numero civico" readonly>
                                        </div>

                                        {{-- btn delete --}}
                                        <div class="col-12 mb-4">
                                            <form action="{{route('user.profiles.deleteAddress', [$address->id, $user->id])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="link-danger bg-transparent border-0">
                                                    <i class="fa-solid fa-arrow-up"></i>
                                                    Elimina indirizzo
                                                </button>
                                            </form>
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
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection