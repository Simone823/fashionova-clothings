@extends('layouts.admin')

@section('metaTitle', "Visualizza Prodotto: {$product->code}")

@section('content')
    <section id="admin-products-show">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-box-archive fs-4"></i>
                        Visualizza Prodotto
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

                        {{-- edit --}}
                        @can('products_edit')
                            <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-pen-to-square me-1"></i>
                                Modifica
                            </a>
                        @endcan

                        {{-- delete --}}
                        @can('products_delete')
                            <form action="{{route('admin.products.delete', $product->id)}}" method="POST">
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

                {{-- detail product --}}
                <div class="row gy-4 mb-5">
                    {{-- subtitle --}}
                    <div class="col-12">
                        <h5 class="fw-semibold mb-0">Dettagli Prodotto</h5>
                    </div>

                    {{-- name --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" readonly>
                    </div>

                    {{-- code --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="code" class="form-label">Codice Prodotto</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{$product->code}}" readonly>
                    </div>

                    {{-- genre --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="genre" class="form-label">Genere</label>
                        <select class="form-select" name="genre" id="genre" disabled >
                            <option {{$product->genre == 'Uomo' ? 'selected' : ''}} value="Uomo">Uomo</option>
                            <option {{$product->genre == 'Donna' ? 'selected' : ''}} value="Donna">Donna</option>
                        </select>
                    </div>

                    {{-- price --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="price" class="form-label">
                            Prezzo (€)
                        </label>
                        <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}" readonly>
                    </div>

                    {{-- discount_percent --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="discount_percent" class="form-label">
                            Sconto (%)
                        </label>
                        <input type="number" class="form-control" id="discount_percent" name="discount_percent" value="{{$product->discount_percent}}" readonly>
                    </div>

                    {{-- price discounted --}}
                    @if($product->discount_percent != null)
                        <div class="col-12 col-md-6 form-group">
                            <label for="price_discounted" class="form-label">
                                Prezzo Scontato (€)
                            </label>
                            <input type="number" class="form-control" id="price_discounted" name="price_discounted" value="{{$product->getPriceDiscounted()}}" readonly>
                        </div>
                    @endif

                    {{-- total_quantity --}}
                    <div class="col-12 col-md-6 form-group">
                        <label for="total_quantity" class="form-label">
                            Totale Quantità
                        </label>
                        <input type="number" class="form-control" id="total_quantity" name="total_quantity" value="{{$product->total_quantity}}" readonly>
                    </div>

                    {{-- description --}}
                    <div class="col-12 form-group">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" name="description" readonly >{{$product->description}}</textarea>
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
                            <input {{$product->categories->contains($category) ? 'checked' : ''}} type="checkbox" class="btn-check" id="categories-{{$category->id}}" name="categories[]" value="{{$category->id}}" disabled>
                            <label class="btn btn-outline-dark" for="categories-{{$category->id}}">
                                {{$category->name}}
                            </label>
                        @endforeach
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
                            <label for="size-{{$size->id}}" class="form-label">Taglia: {{$size->name}}</label>
                            <p class="mb-2">Quantità disponibile</p>
                            <input type="number" class="form-control" id="size-{{$size->id}}" name="sizes[{{$size->id}}]" value="{{$product->sizes->firstWhere('id', $size->id)->pivot->quantity_available ?? ''}}" min="1" readonly>
                        </div>
                    @endforeach
                </div>

                {{-- created & updated at --}}
                <div class="row">
                    <div class="col-12">
                        <p class="mb-1">
                            <span class="fw-bold">Creato il:</span>
                            {{ \Carbon\Carbon::create($product->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                        </p>
                        <p class="mb-0">
                            <span class="fw-bold">Modificato il:</span>
                            {{ \Carbon\Carbon::create($product->updated_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection