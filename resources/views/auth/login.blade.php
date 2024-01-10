@extends('layouts.guest')

@section('metaTitle', 'Login')

@section('content')
    <section id="auth-login">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    {{-- card login --}}
                    <div class="card card-login">
                        {{-- title --}}
                        <div class="card-header text-center bg-transparent py-3 mb-4">
                            <h3 class="fw-bold mb-0">Bello rivederti!</h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" class="row">
                                @csrf

                                {{-- email --}}
                                <div class="col-12 mb-4 form-group">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="Il tuo indirizzo email" >

                                    @error('email')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                {{-- password --}}
                                <div class="col-12 mb-2 form-group">
                                    <label for="password" class="form-label">Password*</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="La tua password" >

                                    @error('password')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                {{-- forgot password --}}
                                <div class="col-12 mb-4">
                                    <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                        Hai dimenticato la Password?
                                    </a>
                                </div>

                                {{-- remember me --}}
                                <div class="col-12 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Ricorda accesso
                                        </label>
                                    </div>
                                </div>

                                {{-- btn --}}
                                <div class="col-12">
                                    <button type="submit" class="w-100 btn btn-primary text-uppercase">
                                        Accedi
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