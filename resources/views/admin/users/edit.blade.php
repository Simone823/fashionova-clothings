@extends('layouts.admin')

@section('metaTitle', "Modifica Utente: {$user->name} {$user->surname}")

@section('content')
    <section id="admin-users-edit">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-user fs-4"></i>
                        Modifica Utente
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                <form action="{{route('admin.users.update', $user->id)}}" method="post">
                    @csrf

                    {{-- detail user --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Utente</h5>
                        </div>

                        {{-- name --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="name" class="form-label">Nome*</label>
                            <input {{$user->hasRole('Administrator') ? 'readonly' : ''}} type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $user->name)}}" required>

                            @error('name')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- surname --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="surname" class="form-label">Cognome*</label>
                            <input {{$user->hasRole('Administrator') ? 'readonly' : ''}} type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{old('surname', $user->surname)}}" required>

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

                    {{-- detail roles --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Ruoli</h5>
                        </div>

                        <div class="col-12 form-group">
                            @if($user->hasRole('Administrator'))
                                @foreach ($user->roles as $key => $role)    
                                    <input {{$user->roles->contains($role) ? 'checked' : ''}} type="checkbox" class="btn-check" id="roles-{{$role->id}}" name="roles[]" value="{{$role->id}}" readonly disabled>
                                    <label class="btn btn-outline-dark" for="roles-{{$role->id}}">
                                        {{$role->name}}
                                    </label>
                                @endforeach

                                @else
                                    @foreach ($roles as $key => $role)    
                                        <input {{$user->roles->contains($role) ? 'checked' : ''}} type="checkbox" class="btn-check" id="roles-{{$role->id}}" name="roles[]" value="{{$role->id}}">
                                        <label class="btn btn-outline-dark" for="roles-{{$role->id}}">
                                            {{$role->name}}
                                        </label>

                                        @error('roles')
                                            <div class="text-danger mt-1">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    @endforeach
                            @endif
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