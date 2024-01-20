@extends('layouts.guest')

@section('metaTitle', 'Contattaci')

@section('content')
    <section id='contact-us'>
        <div class='container'>

            {{-- title --}}
            <div class='row mb-5'>
                <div class='col-12'>
                    <h1 class='title-section'>Contattaci</h1>
                </div>
            </div>

            {{-- references --}}
            <div class="row mb-5">
                <h3 class="text-uppercase fw-bolder mb-3">Fashionova Clothings</h3>
                <p class="fw-bolder fs-5 mb-1">Indirizzo: <span class="fw-normal">Via Esempio 10, Italia</span></p>
                <p class="fw-bolder fs-5 mb-0">Telefono: <span class="fw-normal">000 000 0000</span></p>
                <p class="fw-bolder fs-5 mb-0">Orari: <span class="fw-normal">Da Lunedi a Venerdì 9:15-12:30 / 14.30-18-00</span></p>
            </div>

            {{-- card form --}}
            <div class='row'>
                <div class='col-12'>
                    <div class='card bg-body-secondary border-0 shadow-sm p-4'>
                        <form action="{{route('guest.contactUs.store')}}" method="POST" class='row'>
                            @csrf

                            {{-- name --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="name" class="form-label">
                                    <i class="fa-regular fa-user"></i>
                                    Nome*
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Il tuo nome" required>

                                @error('name')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            {{-- surname --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="surname" class="form-label">
                                    <i class="fa-regular fa-user"></i>
                                    Cognome*
                                </label>
                                <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{old('surname')}}" placeholder="Il tuo cognome" required>

                                @error('surname')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            {{-- email --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="email" class="form-label">
                                    <i class="fa-regular fa-envelope"></i>
                                    Email*
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="Il tuo indirizzo email" required>

                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            {{-- phone --}}
                            <div class="col-12 col-md-6 mb-4 form-group">
                                <label for="phone" class="form-label">
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                    Telefono*
                                </label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{old('phone')}}" placeholder="Il tuo numero di telefono" required>

                                @error('phone')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            {{-- subject --}}
                            <div class="col-12 mb-4 form-group">
                                <label for="subject" class="form-label">
                                    <i class="fa-regular fa-envelope"></i>
                                    Soggetto*
                                </label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{old('subject')}}" placeholder="Soggetto..." required>

                                @error('subject')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            {{-- message --}}
                            <div class="col-12 mb-4 form-group">
                                <label for="message" class="form-label">
                                    <i class="fa-regular fa-comment"></i>
                                    Messaggio*
                                </label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Scrivi il tuo messaggio..." required>{{old('message')}}</textarea>

                                @error('message')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            {{-- privacy check --}}
                            <div class="col-12 mb-5">
                                <div class="form-check form-switch">
                                    <input {{old('privacy_check') == 'on' ? 'checked' : ''}} class="form-check-input @error('privacy_check') is-invalid @enderror" type="checkbox" role="switch" id="privacy_check" name="privacy_check" required>
                                    <label class="form-check-label" for="privacy_check">
                                        Acconsento al trattamento dei dati personali
                                    </label>

                                    @error('privacy_check')
                                        <div class="text-danger mt-1">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- btn submit --}}
                            <div class='col-12'>
                                <button type='submit' class='btn btn-primary text-uppercase px-5'>
                                    Invia
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection