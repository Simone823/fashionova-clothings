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
                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
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

                        {{-- genre_id --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="genre_id" class="form-label">Genere*</label>
                            <select class="form-select @error('genre_id') is-invalid @enderror" name="genre_id" id="genre_id" required >
                                <option value="" selected hidden>-- Seleziona un Genere --</option>
                                @foreach ($genres as $genre)
                                    <option {{old('genre_id') == $genre->id ? 'selected' : ''}} value="{{$genre->id}}">
                                        {{$genre->name}}
                                    </option>
                                @endforeach
                            </select>
    
                            @error('genre_id')    
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
                            <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')}}" required>

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
                            <input onchange="showInput('price_discounted')" type="number" step="any" class="form-control @error('discount_percent') is-invalid @enderror" id="discount_percent" name="discount_percent" value="{{old('discount_percent')}}">

                            @error('discount_percent')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        {{-- visible --}}
                        <div class="col-12 col-md-6 form-group">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="visible">Visibile</label>
                                <input {{old('visible') == 'on' ? 'checked' : ''}} class="form-check-input" type="checkbox" role="switch" id="visible" name="visible">
                                
                                @error('visible')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
                    <div class="row gx-5">
                        {{-- subtitle --}}
                        <div class="col-12 mb-4">
                            <h5 class="fw-semibold mb-0">Dettagli Taglie e Colori</h5>
                        </div>
                        
                        {{-- taglie e relativi colori con relative quantità --}}
                        @foreach ($sizes as $size)
                            <div class="col-12 col-md-6 form-group mb-4">
                                <div class="form-check">
                                    <input {{old("size-{$size->id}") ? 'checked' : ''}} onchange="toggleSizeColorsVisibility(event)" class="form-check-input size-checkbox" type="checkbox" name="size-{{ $size->id }}" id="size-{{ $size->id }}" data-size-id="{{$size->id}}">
                                    <label class="form-check-label" for="size-{{ $size->id }}">
                                        {{ $size->name }}
                                    </label>
                                </div>

                                @error('sizes')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                                
                                {{-- size colors --}}
                                <div class="size-colors {{old("size-{$size->id}") ? 'd-block' : 'd-none'}}" id="size-colors-{{ $size->id }}" >
                                    <div class="row gy-2 gy-sm-0">
                                        {{-- color label --}}
                                        <div class="col-12 col-sm-6">
                                            <label class="form-label mb-0" >Colore</label>
                                        </div>

                                        {{-- quantity label --}}
                                        <div class="col-12 col-sm-6">
                                            <label class="form-label mb-0">Quantità</label>
                                        </div>

                                        @foreach ($colors as $color)
                                            {{-- color name --}}
                                            <div class="col-12 col-sm-6 color">
                                                <input type="text" id="size-{{ $size->id }}-{{ $color->id }}-color_name" class="form-control" value="{{ $color->name }}" readonly disabled>
                                            </div>
                                            {{-- quantity --}}
                                            <div class="col-12 col-sm-6 size-color-quantities mb-3">
                                                <input onchange="toggleImageInputs({{$size->id}}, {{$color->id}})" type="number" class="form-control" id="size-{{ $size->id }}-{{ $color->id }}-quantity_available" name="sizes[{{ $size->id }}][colors][{{ $color->id }}][quantity_available]" value="{{ old("sizes.{$size->id}.colors.{$color->id}.quantity_available") }}" min="1">
                                                
                                                @error("sizes.{$size->id}.colors.{$color->id}.quantity_available")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        @endforeach
                                            
                                        {{-- line divider --}}
                                        <div class="col-12 pb-3">
                                            <div class="border-bottom border-light-subtle"></div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        @endforeach
                    </div>

                    {{-- detail images color --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold mb-2">Dettagli Immagini per Colore</h5>
                            {{-- question images colors tooltip --}}
                            <button type="button" class="bg-transparent border-0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Gli input per caricare le immagini verranno mostrati solo per i colori che hanno quantità disponibili.">
                                <i class="fa-regular fa-circle-question fs-5 text-primary"></i>
                            </button>
                        </div>

                        {{-- immagini per colore --}}
                        @foreach ($colors as $color)
                            {{-- se la validazione fallisce, controllo se le taglie hanno quantità per quel colore --}}
                            @php
                                $colorHasAvailableQuantity = false;
                                foreach (old('sizes', []) as $sizeId => $sizeData) {
                                    if (isset($sizeData['colors'][$color->id]['quantity_available']) && $sizeData['colors'][$color->id]['quantity_available'] !== null && $sizeData['colors'][$color->id]['quantity_available'] > 0) {
                                        $colorHasAvailableQuantity = true;
                                        break;
                                    }
                                }
                            @endphp
                        
                            <div class="col-12 col-sm-6 size-color-images {{ $colorHasAvailableQuantity ? 'd-block' : 'd-none' }}">
                                <p class="mb-2 fst-italic">Colore: {{$color->name}}</p>

                                <label for="images_colors-{{$color->id}}" class="form-label">Immagini</label>
                                <input type="file" accept="image/png,image/jpg,image/jpeg,image/webp" class="form-control" id="images_colors-{{$color->id}}" name="images_colors[{{ $color->id }}][]" multiple >
                            
                                @error("images_colors.{$color->id}.*")
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
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

                            <a href="{{ url()->previous() }}" class="btn btn-danger text-uppercase">
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