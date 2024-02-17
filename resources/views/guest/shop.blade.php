@extends('layouts.guest')

@section('metaTitle', $titlePage ?? 'Shop')

@section('content')
    <section id='shop'>
        <div class='container'>
            {{-- title --}}
            <div class="row mb-5">
                <div class="col-12">
                    <h1 class="mb-0 fw-bold">{{$titlePage ?? 'Shop'}}</h1>
                </div>
            </div>

            {{-- liste filtri --}}
            <div class="row lists-filters mb-5">
                <div class="card border-0 bg-transparent">
                    <div class="card-header">
                        <p class="mb-0 fs-5 fw-semibold">Filtra per</p>
                    </div>

                    <div class="card-body">
                        <form class="col-12" action="{{route('guest.products.index')}}" method="GET">
                            {{-- filtro generi --}}
                            <div class="filter-genres mb-3">
                                <p class="fw-bolder mb-2">Genere</p>
                                <ul class="list-input-genres">
                                    @foreach($genres as $genre)
                                        <input {{in_array($genre->id, session()->get('filters.genres', [])) ? 'checked' : ''}} type="checkbox" class="btn-check" id="genres-{{$genre->id}}" name="genres[]" value="{{$genre->id}}">
                                        <label class="btn btn-outline-dark" for="genres-{{$genre->id}}">
                                            {{$genre->name}}
                                        </label>
                                    @endforeach
                                </ul>
                            </div>
        
                            {{-- filtro categorie --}}
                            <div class="filter-categories mb-3">
                                <p class="fw-bolder mb-2">Categorie</p>
                                <ul class="list-input-categories">
                                    @foreach($categories as $category)
                                        <input {{in_array($category->id, session()->get('filters.categories', [])) ? 'checked' : ''}}  type="checkbox" class="btn-check" id="categories-{{$category->id}}" name="categories[]" value="{{$category->id}}">
                                        <label class="btn btn-outline-dark" for="categories-{{$category->id}}">
                                            {{$category->name}}
                                        </label>
                                    @endforeach
                                </ul>
                            </div>
        
                            {{-- filtro taglia --}}
                            <div class="filter-sizes mb-3">
                                <p class="fw-bolder mb-2">Taglie</p>
                                <ul class="list-input-sizes">
                                    @foreach($sizes as $size)
                                        <input {{in_array($size->id, session()->get('filters.sizes', [])) ? 'checked' : ''}}  type="checkbox" class="btn-check" id="sizes-{{$size->id}}" name="sizes[]" value="{{$size->id}}">
                                        <label class="btn btn-outline-dark" for="sizes-{{$size->id}}">
                                            {{$size->name}}
                                        </label>
                                    @endforeach
                                </ul>
                            </div>
        
                            {{-- filtro colori --}}
                            <div class="filter-colors mb-3">
                                <p class="fw-bolder mb-2">Colori</p>
                                <ul class="list-input-colors">
                                    @foreach($colors as $color)
                                        <input {{in_array($color->id, session()->get('filters.colors', [])) ? 'checked' : ''}}  type="checkbox" class="btn-check" id="colors-{{$color->id}}" name="colors[]" value="{{$color->id}}">
                                        <label class="btn btn-outline-dark" for="colors-{{$color->id}}">
                                            {{$color->name}}
                                        </label>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- btn actions --}}
                            <div class="actions">
                                <button type="submit" class="btn btn-primary">
                                    Filtra
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- list products --}}
            <div class="row gy-5 gx-sm-4">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        @include('components.guest.productCard')
                    @endforeach

                    @else
                        <div class="col-12">
                            no prodotti
                        </div>
                @endif
           </div>
        </div>
    </section>
@endsection