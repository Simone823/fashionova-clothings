@extends('layouts.admin')

@section('metaTitle', 'Creazione Utente')

@section('content')
    <section id="admin-users-create">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-user fs-4"></i>
                        Creazione Utente
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                <form action="{{route('admin.users.store')}}" method="post">
                    @csrf

                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Utente</h5>
                        </div>

                        {{-- name --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="name" class="form-label">Nome*</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required>

                            @error('name')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- surname --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="surname" class="form-label">Cognome*</label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{old('surname')}}" required>

                            @error('surname')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- email --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" required>

                            @error('email')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- password --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')}}" required>

                            @error('password')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        
                        {{-- password confirm --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="password-confirm" class="form-label">Conferma password*</label>
                            <input type="password" class="form-control @error('password-confirm') is-invalid @enderror" id="password-confirm" name="password_confirmation" value="" required>

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- detail roles --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Ruoli</h5>
                        </div>

                        <div class="col-12 form-group">
                            @foreach ($roles as $key => $role)    
                                <input type="checkbox" class="btn-check" id="roles-{{$role->id}}" name="roles[]" value="{{$role->id}}">
                                <label class="btn btn-outline-dark" for="roles-{{$role->id}}">
                                    {{$role->name}}
                                </label>

                                @error('roles')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-bookmark me-1"></i>
                                Salva
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