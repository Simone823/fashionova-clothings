@extends('layouts.admin')

@section('metaTitle', 'Lista Prodotti')

@section('content')
    <section id="admin-products-index">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-box-archive fs-4"></i>
                        Lista Prodotti
                    </h3>
                </div>
            </div>

            {{-- Buttons --}}
            @can('products_create')
                <div class="row mb-4">
                    <div class="col-12">
                        <a class="btn btn-primary text-uppercase" href="{{route('admin.products.create')}}">
                            <i class="fa-solid fa-plus me-1"></i>
                            Crea
                        </a>
                    </div>
                </div>
            @endcan

            {{-- table products --}}
            <div class="row">
                <div class="col-12">
                    <div class="card px-3 py-4 shadow-sm border-0">
                        {{-- input search  --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label" for="searchInput">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    Cerca
                                </label>
                                <input onkeyup="searchOnTable()" type="text" class="form-control border-2 shadow-sm" id="searchInput" name="searchInput">
                            </div>
                        </div>

                        {{-- table --}}
                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">@sortablelink('name', 'Nome', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('code', 'Codice Prodotto', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('genre.name', 'Genere', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('price', 'Prezzo (€)', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('discount_percent', 'Sconto (%)', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('categories.name', 'Categorie', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('sizes.name', 'Taglie', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('total_quantity', 'Totale Quantità', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('created_at', 'Data creazione', '', ['class' => 'link-dark'])</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($products) > 0)
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->code }}</td>
                                                <td>{{ $product->genre->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->discount_percent }}</td>
                                                <td>
                                                    @foreach ($product->categories as $category)
                                                        <span class="badge text-bg-dark p-1 px-2 fw-normal">{{ $category->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($product->sizes as $size)
                                                        <span class="badge text-bg-dark p-1 px-2 fw-normal">{{ $size->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{$product->total_quantity}}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::create($product->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                                                </td>

                                                {{-- actions --}}
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        {{-- show --}}
                                                        @can('products_view')
                                                            <a data-bs-title="Visualizza" class="btn btn-sm btn-primary" href="{{route('admin.products.show', $product->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        @endcan

                                                        {{-- edit --}}
                                                        @can('products_edit')
                                                            <a data-bs-title="Modifica" class="btn btn-sm btn-primary" href="{{route('admin.products.edit', $product->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a> 
                                                        @endcan

                                                        {{-- delete --}}
                                                        @can('products_delete')
                                                            <form action="{{route('admin.products.delete', $product->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" data-bs-title="Elimina" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button> 
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="50" class=" bg-info bg-opacity-75 p-3">
                                                <strong>Info!</strong>
                                                Nessun record in tabella.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Paginate --}}
                        @if(count($products) > 0)
                            <div class="paginate-wrapper">
                                <p class="mb-3">
                                    Visualizzando da {{$products->firstItem()}} a {{$products->perPage()}} di {{$products->total()}}
                                </p>
                                {!! $products->appends(\Request::except('page'))->render() !!}
                            </div>
                        @endif
                
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection