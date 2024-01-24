@extends('layouts.admin')

@section('metaTitle', 'Lista Utenti')

@section('content')
    <section id="admin-users-index">
        <div class="container-fluid">

            {{-- Title page --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-user fs-4"></i>
                        Lista Utenti
                    </h3>
                </div>
            </div>

            {{-- Buttons --}}
            @can('users_create')
                <div class="row mb-4">
                    <div class="col-12">
                        {{-- create --}}
                        <a class="btn btn-primary text-uppercase" href="{{route('admin.users.create')}}">
                            <i class="fa-solid fa-plus me-1"></i>
                            Crea
                        </a>
                    </div>
                </div>
            @endcan

            {{-- table user --}}
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
                                        <th scope="col">@sortablelink('surname', 'Cognome', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('email', 'Email', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">Ruoli</th>
                                        <th scope="col">@sortablelink('created_at', 'Data creazione', '', ['class' => 'link-dark'])</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) > 0)
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->surname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($user->roles as $role)
                                                        <span class="badge text-bg-dark p-1 px-2 fw-normal">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::create($user->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                                                </td>

                                                {{-- actions --}}
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        {{-- show --}}
                                                        @can('users_view')
                                                            <a data-bs-title="Visualizza" class="btn btn-sm btn-primary" href="{{route('admin.users.show', $user->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        @endcan

                                                        {{-- edit --}}
                                                        @can('users_edit')
                                                            <a data-bs-title="Modifica" class="btn btn-sm btn-primary" href="{{route('admin.users.edit', $user->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a> 
                                                        @endcan

                                                        {{-- delete --}}
                                                        @can('users_delete')
                                                            <form action="{{route('admin.users.delete', $user->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button {{$user->hasRole('Administrator') ? 'disabled' : ''}} type="submit" data-bs-title="Elimina" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button> 
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
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
                        @if(count($users) > 0)
                            <div class="paginate-wrapper">
                                <p class="mb-3">
                                    Visualizzando da {{$users->firstItem()}} a {{$users->perPage()}} di {{$users->total()}}
                                </p>
                                {!! $users->appends(\Request::except('page'))->render() !!}
                            </div>
                        @endif
                
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection