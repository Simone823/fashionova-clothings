@extends('layouts.admin')

@section('metaTitle', "Modifica Prodotto: {$product->code}")

@section('content')
    <section id="admin-products-edit">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-box-archive fs-4"></i>
                        Modifica Prodotto
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>

                            @error('name')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- code --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="code" class="form-label">
                                Codice Prodotto
                            </label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ $product->code }}" readonly>
                        </div>

                        {{-- genre_id --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="genre_id" class="form-label">Genere*</label>
                            <select class="form-select @error('genre_id') is-invalid @enderror" name="genre_id" id="genre_id" required>
                                <option value="" selected hidden>-- Seleziona un Genere --</option>
                                @foreach ($genres as $genre)
                                    <option
                                        {{ $product->genre_id == $genre->id || old('genre_id') == $genre->id ? 'selected' : '' }}
                                        value="{{ $genre->id }}">
                                        {{ $genre->name }}
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
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>

                            @error('price')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- discount_percent --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="discount_percent" class="form-label">
                                Sconto (%)
                            </label>
                            <input type="number" class="form-control @error('discount_percent') is-invalid @enderror" id="discount_percent" name="discount_percent" value="{{ old('discount_percent', $product->discount_percent) }}">

                            @error('discount_percent')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- visible --}}
                        <div class="col-12 col-md-6 form-group">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="visible">Visibile</label>
                                <input {{$product->visible == 1 || old('visible') == 'on' ? 'checked' : ''}} class="form-check-input" type="checkbox" role="switch" id="visible" name="visible">
                                
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
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <div class="text-danger mt-1">
                                    {{ $message }}
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
                                <input {{ $product->categories->contains($category) || (old('categories') && in_array($category->id, old('categories'))) ? 'checked' : '' }} type="checkbox" class="btn-check" id="categories-{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                                <label class="btn btn-outline-dark" for="categories-{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            @endforeach

                            @error('categories')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- detail sizes --}}
                    <div class="row gx-5">
                        {{-- subtitle --}}
                        <div class="col-12 mb-4">
                            <h5 class="fw-semibold mb-0">Dettagli Taglie</h5>
                        </div>

                        {{-- taglie e relativi colori con relative quantità --}}
                        @foreach ($sizes as $size)
                            <div class="col-12 col-md-6 form-group mb-4">
                                <p class="mb-2 fw-bolder text-uppercase">Taglia: {{ $size->name }}</p>

                                @error('sizes')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                                {{-- size colors --}}
                                <div class="size-colors">
                                    @foreach ($colors as $color)
                                        <div class="row gy-2">
                                            {{-- color name --}}
                                            <div class="col-12 col-sm-6 color">
                                                <label class="form-label" for="size-{{ $size->id }}-{{ $color->id }}-color_name">
                                                    Colore
                                                </label>
                                                <input type="text" id="size-{{ $size->id }}-{{ $color->id }}-color_name" class="form-control" value="{{ $color->name }}" readonly>
                                            </div>

                                            {{-- quantity --}}
                                            <div class="col-12 col-sm-6 size-color-quantities mb-3">
                                                <label for="size-{{ $size->id }}-{{ $color->id }}-quantity_available" class="form-label">
                                                    Quantità
                                                </label>
                                                <input type="number" class="form-control" id="size-{{ $size->id }}-{{ $color->id }}-quantity_available" name="sizes[{{ $size->id }}][colors][{{ $color->id }}][quantity_available]" value="{{ old("sizes.{$size->id}.colors.{$color->id}.quantity_available",$product->colors()->where('colors.id', $color->id)->wherePivot('size_id', $size->id)->first()->pivot->quantity_available ?? '') }}" min="1">

                                                @error("sizes.{$size->id}.colors.{$color->id}.quantity_available")
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- line divider --}}
                                    <div class="col-12 pb-3">
                                        <div class="border-bottom border-light-subtle"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- detail images color --}}
                    <div class="row gy-4 mb-5">
                        {{-- subtitle --}}
                        <div class="col-12">
                            <h5 class="fw-semibold">Dettagli Immagini per Colore</h5>
                        </div>

                        @foreach ($colors as $color)
                            <div class="col-12 col-sm-6 size-color-images">
                                <p class="mb-2 fst-italic">Colore: {{ $color->name }}</p>

                                {{-- aggiunta nuove immagini --}}
                                <div class="add-images_colors">
                                    <label for="images_colors-{{ $color->id }}" class="form-label">
                                        Aggiungi nuove immagini
                                    </label>
                                    <input type="file" accept="image/png,image/jpg,image/jpeg,image/webp" class="form-control" id="images_colors-{{ $color->id }}" name="images_colors[{{ $color->id }}][]" multiple>
                                </div>

                                {{-- caroselli immagini --}}
                                @if (!empty($product->images))
                                    @php
                                        // se non ci sono immagine associate al colore non mostro il carosello
                                        $colorImages = collect(json_decode($product->images))->filter(function ($image) use ($color) {
                                            return strpos($image, "_{$color->name}-") !== false;
                                        });
                                    @endphp
                                    @if (count($colorImages) > 0)
                                        <div id="carouselImagesColor{{$color->name}}" class="carousel slide carousel-image-product mt-3 mx-auto">
                                            <div class="carousel-inner">
                                                @php $colorActive = false; @endphp
                                                @foreach ($colorImages as $pathImage)
                                                    <div class="carousel-item{{ !$colorActive ? ' active' : '' }}">
                                                        <img src="/storage/{{ $pathImage }}" class="image-product" alt="{{str_replace(' ', '', $pathImage)}}">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5>{{str_replace(' ', '', $pathImage)}}</h5>
                                                        </div>
                                                    </div>
                                                    @php $colorActive = true; @endphp
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselImagesColor{{$color->name}}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselImagesColor{{$color->name}}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Actions btn --}}
                    <div class="row">
                        <div class="col-12 d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-bookmark me-1"></i>
                                Salva modifica
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