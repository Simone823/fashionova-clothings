@extends('layouts.admin')

@section('metaTitle', 'Lista Permessi')

@section('content')
    <section id="admin-permissions-index">
        <div class="container-fluid">

            {{-- Title page --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-briefcase fs-4"></i>
                        Lista Permessi
                    </h3>
                </div>
            </div>

            {{-- Buttons --}}
            @can('permissions_create')
                <div class="row mb-4">
                    <div class="col-12">
                        <a class="btn btn-primary text-uppercase" href="{{route('admin.permissions.create')}}">
                            <i class="fa-solid fa-plus me-1"></i>
                            Crea
                        </a>
                    </div>
                </div>
            @endcan

            {{-- table permissions --}}
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
                                        <th scope="col">
                                            @sortablelink('name', 'Nome', '', ['class' => 'link-dark'])
                                        </th>
                                        <th scope="col">
                                            @sortablelink('guard_name', 'Guard', '', ['class' => 'link-dark'])
                                        </th>
                                        <th scope="col">
                                            @sortablelink('created_at', 'Data creazione', '', ['class' => 'link-dark'])
                                        </th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($permissions) > 0)
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->guard_name }}</td>
                                                <td>{{ \Carbon\Carbon::create($permission->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}</td>

                                                {{-- actions --}}
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        {{-- edit --}}
                                                        @can('permissions_edit')
                                                            <a data-bs-title="Modifica" class="btn btn-sm btn-primary" href="{{route('admin.permissions.edit', $permission->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a> 
                                                        @endcan

                                                        {{-- delete --}}
                                                        @can('permissions_delete')
                                                            <form action="{{route('admin.permissions.delete', $permission->id)}}" method="post">
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
                                        <div class="alert alert-info">
                                            <strong>Info!</strong>
                                            Nessuna informazione
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Paginate --}}
                        @if(count($permissions) > 0)
                            <div class="paginate-wrapper">
                                <p class="mb-3">
                                    Visualizzando da {{$permissions->firstItem()}} a {{$permissions->perPage()}} di {{$permissions->total()}}
                                </p>
                                {!! $permissions->appends(\Request::except('page'))->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection