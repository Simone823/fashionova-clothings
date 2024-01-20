@extends('layouts.guest')

@section('metaTitle', 'Register')

@section('content')
    <section id="auth-register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    {{-- card register --}}
                    <div class="card border-0 pb-4 shadow-sm">
                        {{-- title --}}
                        <div class="card-header text-center bg-transparent py-3 mb-4">
                            <h3 class="fw-bold mb-0">Sono un nuovo cliente</h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" class="row">
                                @csrf

                                {{-- name --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="name" class="form-label">Nome*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Il tuo nome" required>

                                    @error('name')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- surname --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="surname" class="form-label">Cognome*</label>
                                    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname') }}" placeholder="Il tuo cognome" required>

                                    @error('surname')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                {{-- email --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Il tuo indirizzo email" required>

                                    @error('email')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- password --}}
                                <div class="col-12 col-md-6 mb-4 form-group">
                                    <label for="password" class="form-label">Password*</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="La tua password" required>

                                    @error('password')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- confirm password --}}
                                <div class="col-12 col-md-6 mb-5 form-group">
                                    <label for="password" class="form-label">Conferma Password*</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Conferma password" required autocomplete="new-password">

                                    @error('password_confirmation')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                               {{-- btn submit --}}
                                <div class='col-12'>
                                    <button type='submit' class='btn btn-primary w-100 text-uppercase px-5'>
                                        Registrati
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection