@extends('layouts.admin')

@section('metaTitle', "Visualizza Profilo: {$user->name} {$user->surname}")

@section('content')
    <section id="admin-profiles-show">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-user-gear fs-4"></i>
                        Visualizza Profilo
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                {{-- Actions btn --}}
                <div class="row mb-5">
                    <div class="col-12 d-flex flex-wrap gap-3">
                        {{-- edit --}}
                        <a href="{{route('admin.profiles.edit', Auth::id())}}" class="btn btn-primary text-uppercase">
                            <i class="fa-solid fa-pen-to-square me-1"></i>
                            Modifica
                        </a>

                        {{-- change password --}}
                        @include('admin.profiles.changePasswordModal')
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

                    {{-- password --}}
                    {{-- <div class="col-12 col-md-6 form-group">
                        <p class="mb-2">@lang('users.password')</p>
                        @include('profile.change-password')
                    </div> --}}
                </div>

                {{-- detail roles --}}
                <div class="row gy-4">
                    {{-- subtitle --}}
                    <div class="col-12">
                        <h5 class="fw-semibold mb-0">Dettagli Ruoli</h5>
                    </div>

                    {{-- ruoli --}}
                    <div class="col-12 form-group">
                        @foreach ($user->roles as $key => $role)    
                            <input {{$user->roles->contains($role) ? 'checked' : ''}} type="checkbox" class="btn-check" id="roles-{{$role->id}}" name="roles[]" value="{{$role->id}}" readonly disabled>
                            <label class="btn btn-outline-dark" for="roles-{{$role->id}}">
                                {{$role->name}}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection