@extends('layouts.admin')

@section('metaTitle', "Visualizza Contatto: {$contact->name} {$contact->surname}")

@section('content')
    <section id="admin-contacts-show">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-address-book fs-4"></i>
                        Visualizza Contatto
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                {{-- Actions btn --}}
                <div class="row mb-5">
                    <div class="col-12 d-flex flex-wrap gap-3">
                        {{-- back --}}
                        <a href="{{url()->previous()}}" class="btn btn-primary text-uppercase">
                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Indietro
                        </a>

                        {{-- delete --}}
                        @can('contacts_delete')
                            <form action="{{route('admin.contacts.delete', $contact->id)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger text-uppercase">
                                    <i class="fa-solid fa-trash me-1"></i>
                                    Elimina
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

                {{-- detail contact --}}
                <div class="row gy-4 mb-5">
                    {{-- subtitle --}}
                    <div class="col-12">
                        <h5 class="fw-semibold mb-0">Dettagli Contatto</h5>
                    </div>

                    {{-- name --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$contact->name}}" readonly>
                    </div>

                    {{-- surname --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="{{$contact->surname}}" readonly>
                    </div>

                    {{-- email --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$contact->email}}" readonly>
                    </div>

                    {{-- phone --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="phone" class="form-label">Telefono</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{$contact->phone}}" readonly>
                    </div>

                    {{-- subject --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="subject" class="form-label">Soggetto</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="{{$contact->subject}}" readonly>
                    </div>

                    {{-- Message --}}
                    <div class="col-12 form-group">
                        <label for="message" class="form-label">Messaggio</label>
                        <textarea class="form-control" id="message" name="message" readonly>{{$contact->message}}</textarea>
                    </div>
                </div>

                {{-- created & updated at --}}
                <div class="row">
                    <div class="col-12">
                        <p class="mb-1">
                            <span class="fw-bold">Creato il:</span>
                            {{ \Carbon\Carbon::create($contact->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                        </p>
                        <p class="mb-0">
                            <span class="fw-bold">Modificato il:</span>
                            {{ \Carbon\Carbon::create($contact->updated_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection