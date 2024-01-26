@extends('layouts.admin')

@section('metaTitle', "Visualizza Dettagli Azienda")

@section('content')
    <section id="admin-details-company-show">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-building fs-4"></i>
                        Visualizza Dettagli Azienda
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                {{-- btn edit --}}
                @can('details_company_edit')
                    <div class="row mb-5">
                        <div class="col-12 d-flex flex-wrap gap-3">
                            <a href="{{route('admin.detailsCompany.edit')}}" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-pen-to-square me-1"></i>
                                Modifica
                            </a>
                        </div>
                    </div>
                @endcan

                {{-- detail user addresses --}}
                <div class="row gy-4">
                    {{-- subtitle --}}
                    <div class="col-12">
                        <h5 class="fw-semibold mb-0">Dettagli Azienda</h5>
                    </div>

                    <div class="col-12">
                        <div class="row mb-4">
                            {{-- address --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$detailsCompany['name']}}" readonly>
                            </div>

                            {{-- address --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="address" class="form-label">Indirizzo</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$detailsCompany['address']}}" readonly>
                            </div>
    
                            {{-- email --}}
                            <div class="col-12 col-md-6 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$detailsCompany['email']}}" readonly>
                            </div>

                            {{-- phone --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="phone" class="form-label">Telefono</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{$detailsCompany['phone']}}" readonly>
                            </div>

                            {{-- hours --}}
                            <div class="col-12 col-md-6 form-group">
                                <label for="hours" class="form-label">Orari</label>
                                <input type="text" class="form-control" id="hours" name="hours" value="{{$detailsCompany['hours']}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection