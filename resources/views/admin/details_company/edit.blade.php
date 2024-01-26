@extends('layouts.admin')

@section('metaTitle', "Modifica Dettagli Azienda")

@section('content')
    <section id="admin-details-company-edit">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-building fs-4"></i>
                        Modifica Dettagli Azienda
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                <form action="{{route('admin.detailsCompany.update')}}" method="post">
                    @csrf

                    {{-- detail user --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Azienda</h5>
                        </div>

                        {{-- name --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="name" class="form-label">Nome*</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $detailsCompany['name'])}}" required>

                            @error('name')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="address" class="form-label">Indirizzo*</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address', $detailsCompany['address'])}}" required>

                            @error('address')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- email --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="email" class="form-label">Email*</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $detailsCompany['email'])}}" required>

                            @error('email')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- phone --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="phone" class="form-label">Telefono*</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{old('phone', $detailsCompany['phone'])}}" required>

                            @error('phone')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- hours --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="hours" class="form-label">Orari*</label>
                            <input type="text" class="form-control @error('hours') is-invalid @enderror" id="hours" name="hours" value="{{old('hours', $detailsCompany['hours'])}}" required>

                            @error('hours')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions btn --}}
                    <div class="row">
                        <div class="col-12 d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-bookmark me-1"></i>
                                Salva modifica
                            </button>

                            <a href="{{url()->previous()}}" class="btn btn-danger text-uppercase">
                                <i class="fa-solid fa-ban me-1"></i>
                                Annulla
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection