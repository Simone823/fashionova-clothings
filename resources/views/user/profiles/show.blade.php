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
                        <div class='row'>

                            {{-- buttons --}}
                            <div class="col-12 d-flex flex-wrap gap-3 mb-4">
                                {{-- btn edit --}}
                                <a href="{{route('user.profiles.edit', Auth::id())}}" class="btn btn-primary text-uppercase">
                                    Modifica
                                </a>

                                {{-- btn modal change password --}}
                                @include('user.profiles.changePasswordModal')

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
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection