@extends('layouts.admin')

@section('metaTitle', "Visualizza Utente: {$user->name} {$user->surname}")

@section('content')
    <section id="admin-users-show">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-user fs-4"></i>
                        Visualizza Utente
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                {{-- Actions btn --}}
                <div class="row mb-5">
                    <div class="col-12 d-flex flex-wrap gap-3">
                        {{-- back --}}
                        <a href="{{url()->previous()}}" class="btn btn-primary text-uppercase">
                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Indietro
                        </a>

                        {{-- edit --}}
                        @can('users_edit')
                            <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-pen-to-square me-1"></i>
                                Modifica
                            </a>
                        @endcan

                        {{-- delete --}}
                        @can('users_delete')
                            <form action="{{route('admin.users.delete', $user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button {{$user->hasRole('Administrator') ? 'disabled' : ''}} type="submit" class="btn btn-danger text-uppercase">
                                    <i class="fa-solid fa-trash me-1"></i>
                                    Elimina
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

                {{-- detail user --}}
                <div class="row gy-4 mb-5">
                    {{-- subtitle --}}
                    <div class="col-12">
                        <h5 class="fw-semibold mb-0">Dettagli Utente</h5>
                    </div>

                    {{-- name --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" readonly>
                    </div>

                    {{-- surname --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}" readonly>
                    </div>

                    {{-- email --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" readonly>
                    </div>
                </div>

                {{-- detail roles --}}
                <div class="row gy-4 mb-5">
                    {{-- subtitle --}}
                    <div class="col-12">
                        <h5 class="fw-semibold mb-0">Dettagli Ruoli</h5>
                    </div>

                    <div class="col-12 form-group">
                        @foreach ($user->roles as $key => $role)    
                            <input {{$user->roles->contains($role) ? 'checked' : ''}} type="checkbox" class="btn-check" id="roles-{{$role->id}}" name="roles[]" value="{{$role->id}}" readonly disabled>
                            <label class="btn btn-outline-dark" for="roles-{{$role->id}}">
                                {{$role->name}}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- detail user addresses --}}
                <div class="row gy-4 mb-5">
                    {{-- subtitle --}}
                    <div class="col-12">
                        <h5 class="fw-semibold mb-0">Dettagli Indirizzi</h5>
                    </div>

                    @if(count($user->addresses) > 0)
                        @foreach($user->addresses as $address)
                            <div class="col-12">
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
                                            <option selected value="{{$nation->id}}">{{$nation->name}}</option>
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
                                            @foreach ($regions as $region)
                                                <option {{$address->region_id == $region->id ? 'selected' : ''}} value="{{$region->id}}">{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    {{-- province_id --}}
                                    <div class="col-12 col-md-6 mb-4 form-group">
                                        <label for="province_id" class="form-label">Provincia</label>
                                        <select class="form-select" name="province_id" id="province_id" readonly disabled>
                                            <option value="">-- Seleziona una Provincia --</option>
                                            @foreach ($provinces as $province)
                                                <option {{$address->province_id == $province->id ? 'selected' : ''}} data-region-id="{{$province->region_id}}" value="{{$province->id}}">{{$province->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    {{-- city_id --}}
                                    <div class="col-12 col-md-6 mb-4 form-group">
                                        <label for="city_id" class="form-label">Comune</label>
                                        <select class="form-select" name="city_id" id="city_id" readonly disabled>
                                            <option value="" selected hidden>-- Seleziona un Comune --</option>
                                            @foreach ($cities as $city)
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
    
                                    {{-- line divider --}}
                                    <div class="col-12">
                                        <div class="line"></div>
                                    </div>
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

                {{-- created & updated at --}}
                <div class="row">
                    <div class="col-12">
                        <p class="mb-1">
                            <span class="fw-bold">Creato il:</span>
                            {{ \Carbon\Carbon::create($user->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                        </p>
                        <p class="mb-0">
                            <span class="fw-bold">Modificato il:</span>
                            {{ \Carbon\Carbon::create($user->updated_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection