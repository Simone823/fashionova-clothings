@extends('layouts.admin')

@section('metaTitle', 'Lista Colori')

@section('content')
    <section id="admin-colors-index">
        <div class="container-fluid">

            {{-- Title page --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-palette fs-4"></i>
                        Lista Colori
                    </h3>
                </div>
            </div>

            {{-- Buttons --}}
            @can('colors_create')
                <div class="row mb-4">
                    <div class="col-12">
                        <a class="btn btn-primary text-uppercase" href="{{route('admin.colors.create')}}">
                            <i class="fa-solid fa-plus me-1"></i>
                            Crea
                        </a>
                    </div>
                </div>
            @endcan

            {{-- table colors --}}
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
                                        <th scope="col">
                                            @sortablelink('name', 'Nome', '', ['class' => 'link-dark'])
                                        </th>
                                        <th scope="col">
                                            @sortablelink('created_at', 'Data creazione', '', ['class' => 'link-dark'])
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($colors) > 0)
                                        @foreach ($colors as $color)
                                            <tr>
                                                {{-- actions --}}
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        {{-- edit --}}
                                                        @can('colors_edit')
                                                            <a data-bs-title="Modifica" class="btn btn-sm btn-primary" href="{{route('admin.colors.edit', $color->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a> 
                                                        @endcan

                                                        {{-- delete --}}
                                                        @can('colors_delete')
                                                            <form action="{{route('admin.colors.delete', $color->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" data-bs-title="Elimina" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button> 
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                                <td>{{ $color->name }}</td>
                                                <td>{{ \Carbon\Carbon::create($color->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="50" class=" bg-info bg-opacity-75 p-3">
                                            <strong>Info!</strong>
                                            Nessun record in tabella.
                                        </td>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Paginate --}}
                        @if(count($colors) > 0)
                            <div class="paginate-wrapper">
                                <p class="mb-3">
                                    Visualizzando da {{$colors->firstItem()}} a {{$colors->perPage()}} di {{$colors->total()}}
                                </p>
                                {!! $colors->appends(\Request::except('page'))->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection