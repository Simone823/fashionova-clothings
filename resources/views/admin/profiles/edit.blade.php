@extends('layouts.admin')

@section('metaTitle', "Modifica Profilo: {$user->name} {$user->surname}")

@section('content')
    <section id="admin-profiles-edit">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-user-gear fs-4"></i>
                        Modifica Profilo
                    </h3>
                </div>
            </div>

            {{-- form --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                <form action="{{route('admin.profiles.update', $user->id)}}" method="post">
                    @csrf

                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Utente</h5>
                        </div>

                        {{-- name --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="name" class="form-label">Nome*</label>
                            <input {{$user->name == 'Administrator' ? 'readonly' : ''}} type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $user->name)}}" required>

                            @error('name')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- surname --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="surname" class="form-label">Cognome*</label>
                            <input {{$user->surname == 'System' ? 'readonly' : ''}} type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{old('surname', $user->surname)}}" required>

                            @error('surname')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- email --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $user->email)}}" required>

                            @error('email')
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
                                <i class="fa-solid fa-ban"></i>
                                Annulla
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection