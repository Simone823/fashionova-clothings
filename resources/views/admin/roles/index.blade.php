@extends('layouts.admin')

@section('metaTitle', 'Lista Ruoli')

@section('content')
    <section id="admin-roles-index">
        <div class="container-fluid">

            {{-- Title page --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-medal fs-4"></i>
                        Lista Ruoli
                    </h3>
                </div>
            </div>

            {{-- Buttons --}}
            @can('roles_create')
                <div class="row mb-4">
                    <div class="col-12">
                        <a class="btn btn-primary text-uppercase" href="{{route('admin.roles.create')}}">
                            <i class="fa-solid fa-plus me-1"></i>
                            Crea
                        </a>
                    </div>
                </div>
            @endcan

            {{-- table roles --}}
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
                                            Permessi
                                        </th>
                                        <th scope="col">
                                            @sortablelink('created_at', 'Data creazione', '', ['class' => 'link-dark'])
                                        </th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($roles) > 0)
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->guard_name }}</td>
                                                <td>
                                                    @foreach ($role->permissions as $permission)
                                                        <span class="badge text-bg-dark p-1 px-2 fw-normal">{{ $permission->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::create($role->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                                                </td>

                                                {{-- actions --}}
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        {{-- edit --}}
                                                        @can('roles_edit')
                                                            <a data-bs-title="Modifica" class="btn btn-sm btn-primary @if($role->name == 'User') disabled @endif" href="{{route('admin.roles.edit', $role->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        @endcan

                                                        {{-- delete --}}
                                                        @can('roles_delete')
                                                            <form action="{{route('admin.roles.delete', $role->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button {{$role->name == 'Administrator' || $role->name == 'User' ? 'disabled' : ''}} type="submit" data-bs-title="Elimina" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom">
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
                                                @lang('global.no-record-on-table')
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Paginate --}}
                        @if(count($roles) > 0)
                            <div class="paginate-wrapper">
                                <p class="mb-3">
                                    Visualizzando da {{$roles->firstItem()}} a {{$roles->perPage()}} di {{$roles->total()}}
                                </p>
                                {!! $roles->appends(\Request::except('page'))->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection