@extends('layouts.admin')

@section('metaTitle', "Visualizza Indirizzo Utente: {$userAddress->address} {$userAddress->house_number}")

@section('content')
    <section id="admin-users-addresses-show">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-location-dot fs-4"></i>
                        Visualizza Indirizzo Utente
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
                    </div>
                </div>

                {{-- detail user addresses --}}
                <div class="row gy-4 mb-5">
                    {{-- subtitle --}}
                    <div class="col-12">
                        <h5 class="fw-semibold mb-0">Dettagli Indirizzo</h5>
                    </div>

                    <div class="col-12">
                        <div class="row mb-4">
                            {{-- user_id --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="user_id" class="form-label">Utente</label>
                                <select class="form-select" name="user_id" id="user_id" readonly disabled>
                                    <option selected value="{{$userAddress->user->id}}">{{$userAddress->user->name}} {{$userAddress->user->surname}}</option>
                                </select>
                            </div>

                            {{-- is primary --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="is_primary">
                                        Indirizzo primario
                                    </label>
                                    <input {{$userAddress->is_primary == 1 ? 'checked' : ''}} class="form-check-input" type="checkbox" role="switch" id="is_primary" name="is_primary" readonly disabled>
                                </div>
                            </div>
    
                            {{-- nation id --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="nation_id" class="form-label">Nazione</label>
                                <select class="form-select" name="nation_id" id="nation_id" readonly disabled>
                                    <option selected value="{{$userAddress->nation_id}}">{{$userAddress->nation->name}}</option>
                                </select>
                            </div>
    
                            {{-- region_id --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="region_id" class="form-label">Regione</label>
                                <select class="form-select" name="region_id" id="region_id" readonly disabled>
                                    <option selected value="{{$userAddress->region_id}}">{{$userAddress->region->name}}</option>
                                </select>
                            </div>
    
                            {{-- province_id --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="province_id" class="form-label">Provincia</label>
                                <select class="form-select" name="province_id" id="province_id" readonly disabled>
                                    <option selected data-region-id="{{$userAddress->province->region_id}}" value="{{$userAddress->province->id}}">{{$userAddress->province->name}}</option>
                                </select>
                            </div>
    
                            {{-- city_id --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="city_id" class="form-label">Comune</label>
                                <select class="form-select" name="city_id" id="city_id" readonly disabled>
                                    <option selected data-province-id="{{$userAddress->city->province_id}}" value="{{$userAddress->city->id}}">{{$userAddress->city->name}}</option>
                                </select>
                            </div>
    
                            {{-- cap --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="cap" class="form-label">Cap</label>
                                <input type="number" class="form-control" id="cap" name="cap" value="{{$userAddress->cap}}" placeholder="Cap" readonly>
                            </div>
    
                            {{-- address --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="address" class="form-label">Indirizzo</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$userAddress->address}}" placeholder="Via / Piazza" readonly>
                            </div>
    
                            {{-- house number --}}
                            <div class="col-12 col-md-6 form-group">
                                <label for="house_number" class="form-label">Numero Civico</label>
                                <input type="text" class="form-control" id="house_number" name="house_number" value="{{$userAddress->house_number}}" placeholder="Numero civico" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- created & updated at --}}
                <div class="row">
                    <div class="col-12">
                        <p class="mb-1">
                            <span class="fw-bold">Creato il:</span>
                            {{ \Carbon\Carbon::create($userAddress->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                        </p>
                        <p class="mb-0">
                            <span class="fw-bold">Modificato il:</span>
                            {{ \Carbon\Carbon::create($userAddress->updated_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection