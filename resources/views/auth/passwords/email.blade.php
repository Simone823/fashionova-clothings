@extends('layouts.guest')

@section('metaTitle', 'Reset Password')

@section('content')
    <section id="auth-passwords-email">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    {{-- card reset password send email --}}
                    <div class="card card-login">
                        {{-- title --}}
                        <div class="card-header text-center bg-transparent py-3 mb-4">
                            <h3 class="fw-bold mb-0">Resetta la password</h3>
                        </div>
        
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
        
                            <form method="POST" action="{{ route('password.email') }}" class="row">
                                @csrf
        
                                {{-- email --}}
                                <div class="col-12 mb-5 form-group">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Il tuo indirizzo email" required>

                                    @error('email')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
        
                                {{-- btn --}}
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 text-uppercase px-5">
                                        Ottieni link di reset
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