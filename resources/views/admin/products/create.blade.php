@extends('layouts.admin')

@section('metaTitle', 'Creazione Prodotto')

@section('content')
    <section id="admin-products-create">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-box-archive fs-4"></i>
                        Creazione Prodotto
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                <form action="{{route('admin.products.store')}}" method="post">
                    @csrf

                    {{-- detail product --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Prodotto</h5>
                        </div>

                        {{-- name --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="name" class="form-label">
                                Nome*
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required>

                            @error('name')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- code --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="code" class="form-label">
                                Codice Prodotto
                            </label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="AUTOCALCOLATO AL SALVATAGGIO" readonly>
                        </div>

                        {{-- genre --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="genre" class="form-label">Genere*</label>
                            <select class="form-select @error('genre') is-invalid @enderror" name="genre" id="genre" required >
                                <option value="" selected hidden>-- Seleziona un Genere --</option>
                                <option {{old('genre') == 'Uomo' ? 'selected' : ''}} value="Uomo">Uomo</option>
                                <option {{old('genre') == 'Donna' ? 'selected' : ''}} value="Donna">Donna</option>
                            </select>
    
                            @error('genre')    
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- price --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="price" class="form-label">
                                Prezzo (€)*
                            </label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')}}" required>

                            @error('price')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- discount_percent --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="discount_percent" class="form-label">
                                Sconto (%)
                            </label>
                            <input type="number" class="form-control @error('discount_percent') is-invalid @enderror" id="discount_percent" name="discount_percent" value="{{old('discount_percent')}}">

                            @error('discount_percent')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- description --}}
                        <div class="col-12 form-group">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" >{{old('description')}}</textarea>

                            @error('description')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- detail categories --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Categorie</h5>
                        </div>

                        <div class="col-12 form-group">
                            @foreach ($categories as $category)    
                                <input {{old('categories') && in_array($category->id, old('categories')) ? 'checked' : ''}} type="checkbox" class="btn-check" id="categories-{{$category->id}}" name="categories[]" value="{{$category->id}}">
                                <label class="btn btn-outline-dark" for="categories-{{$category->id}}">
                                    {{$category->name}}
                                </label>
                            @endforeach

                            @error('categories')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- detail sizes --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-0">Dettagli Taglie</h5>
                        </div>
                    
                        @foreach ($sizes as $size)
                            <div class="col-12 col-md-6 form-group">
                                <label for="size-{{ $size->id }}" class="form-label">Taglia: {{ $size->name }}</label>
                                <p class="mb-2">Quantità disponibile</p>
                                <input type="number" class="form-control" id="size-{{ $size->id }}" name="sizes[{{ $size->id }}]" placeholder="Inserisci la quantità disponibile" value="{{ old('sizes.' . $size->id) }}" min="1">
                                
                                @if($errors->has('sizes'))
                                    <div class="text-danger mt-1">
                                        {{ $errors->first('sizes') }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Actions btn --}}
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