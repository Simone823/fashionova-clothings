@extends('layouts.admin')

@section('metaTitle', 'Lista Taglie')

@section('content')
    <section id="admin-sizes-index">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-ruler-combined fs-4"></i>
                        Lista Taglie
                    </h3>
                </div>
            </div>

            {{-- Buttons --}}
            @can('sizes_create')
                <div class="row mb-4">
                    <div class="col-12">
                        <a class="btn btn-primary text-uppercase" href="{{route('admin.sizes.create')}}">
                            <i class="fa-solid fa-plus me-1"></i>
                            Crea
                        </a>
                    </div>
                </div>
            @endcan

            {{-- table sizes --}}
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
                                        <th scope="col"></th>
                                        <th scope="col">@sortablelink('name', 'Nome', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('created_at', 'Data creazione', '', ['class' => 'link-dark'])</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($sizes) > 0)
                                        @foreach ($sizes as $size)
                                            <tr>
                                                {{-- actions --}}
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        {{-- edit --}}
                                                        @can('sizes_edit')
                                                            <a data-bs-title="Modifica" class="btn btn-sm btn-primary" href="{{route('admin.sizes.edit', $size->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a> 
                                                        @endcan

                                                        {{-- delete --}}
                                                        @can('sizes_delete')
                                                            <form action="{{route('admin.sizes.delete', $size->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" data-bs-title="Elimina" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                                <td>{{ $size->name }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::create($size->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
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
                        @if(count($sizes) > 0)
                            <div class="paginate-wrapper">
                                <p class="mb-3">
                                    Visualizzando da {{$sizes->firstItem()}} a {{$sizes->perPage()}} di {{$sizes->total()}}
                                </p>
                                {!! $sizes->appends(\Request::except('page'))->render() !!}
                            </div>
                        @endif
                
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection