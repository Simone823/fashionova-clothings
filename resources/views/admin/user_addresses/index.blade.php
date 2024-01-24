@extends('layouts.admin')

@section('metaTitle', 'Lista Indirizzi Utente')

@section('content')
    <section id="admin-users-addresses-index">
        <div class="container-fluid">

            {{-- Title page --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-location-dot fs-4"></i>
                        Lista Indirizzi Utente
                    </h3>
                </div>
            </div>

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
                                        <th scope="col">@sortablelink('user.name', 'Nome Utente', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('is_primary', 'Indirizzo Primario', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('nation.name', 'Nazione', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('region.name', 'Regione', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('province.name', 'Provincia', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('city.name', 'Città', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('cap', 'Cap', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('address', 'Indirizzo', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('house_number', 'Numero Civico', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('created_at', 'Data creazione', '', ['class' => 'link-dark'])</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($userAddresses) > 0)
                                        @foreach ($userAddresses as $address)
                                            <tr>
                                                <td>{{ $address->user->name }}</td>
                                                <td>{{ $address->is_primary == 1 ? 'Sì' : 'No' }}</td>
                                                <td>{{ $address->nation->name }}</td>
                                                <td>{{ $address->region->name }}</td>
                                                <td>{{ $address->province->name }}</td>
                                                <td>{{ $address->city->name }}</td>
                                                <td>{{ $address->cap }}</td>
                                                <td>{{ $address->address}}</td>
                                                <td>{{ $address->house_number }}</td>
                                                
                                                <td>
                                                    {{ \Carbon\Carbon::create($address->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                                                </td>

                                                {{-- actions --}}
                                                <td>
                                                    {{-- show --}}
                                                    @can('user_addresses_view')
                                                        <a data-bs-title="Visualizza" class="btn btn-sm btn-primary" href="{{route('admin.userAddresses.show', $address->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    @endcan
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
                        @if(count($userAddresses) > 0)
                            <div class="paginate-wrapper">
                                <p class="mb-3">
                                    Visualizzando da {{$userAddresses->firstItem()}} a {{$userAddresses->perPage()}} di {{$userAddresses->total()}}
                                </p>
                                {!! $userAddresses->appends(\Request::except('page'))->render() !!}
                            </div>
                        @endif
                
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection