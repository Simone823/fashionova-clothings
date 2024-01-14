@extends('layouts.guest')

@section('metaTitle', "Modifica Profilo Utente {$user->name} {$user->surname}")

@section('content')
    <section id='user-profiles-edit'>
        <div class='container'>

            {{-- title --}}
            <div class='row mb-5'>
                <div class='col-12'>
                    <h1 class='title-section'>Modifica Profilo</h1>
                </div>
            </div>

            {{-- turn back --}}
            <div class="row mb-4">
                <div class="col-12">
                    <a href="{{url()->previous()}}">
                        <i class="fa-solid fa-arrow-left"></i>
                        Torna indietro
                    </a>
                </div>
            </div>

            {{-- card profile --}}
            <div class='row'>
                <div class='col-12'>
                    <div class='card bg-body-secondary border-0 shadow-sm p-4'>
                        <form action="{{route('user.profiles.update', $user->id)}}" method="POST" class='row'>
                            @csrf

                            {{-- details user --}}
                            <div class="row mb-4">
                                {{-- title --}}
                                <div class="col-12 mb-4">
                                    <h4>Dettagli Utente</h4>
                                </div>

                                {{-- name --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="name" class="form-label">Nome*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $user->name)}}" placeholder="Il tuo nome" >

                                    @error('name')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                {{-- surname --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="surname" class="form-label">Cognome*</label>
                                    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{old('surname', $user->surname)}}" placeholder="Il tuo cognome" >

                                    @error('surname')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                {{-- email --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $user->email)}}" placeholder="Il tuo indirizzo email" >

                                    @error('email')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- user addresses --}}
                            <div class="row mb-5">
                                {{-- title --}}
                                <div class="col-12 mb-4">
                                    <h4>Indirizzi</h4>
                                </div>

                                
                            </div>
                            

                            {{-- btn submit --}}
                            <div class="row">
                                <div class='col-12'>
                                    <button type='submit' class='btn btn-primary text-uppercase px-5'>
                                        Salva modifica
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection