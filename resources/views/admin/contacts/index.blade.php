@extends('layouts.admin')

@section('metaTitle', 'Lista Contatti')

@section('content')
    <section id="admin-contacts-index">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-address-book fs-4"></i>
                        Lista Contatti
                    </h3>
                </div>
            </div>

            {{-- table contacts --}}
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
                                        <th scope="col">@sortablelink('phone', 'Telefono', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('subject', 'Soggetto', '', ['class' => 'link-dark'])</th>
                                        <th scope="col">@sortablelink('created_at', 'Data creazione', '', ['class' => 'link-dark'])</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($contacts) > 0)
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->surname }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->phone }}</td>
                                                <td>{{ $contact->subject }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::create($contact->created_at)->locale(config('app.locale'))->isoFormat('L LT') }}
                                                </td>

                                                {{-- actions --}}
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        {{-- show --}}
                                                        @can('contacts_view')
                                                            <a data-bs-title="Visualizza" class="btn btn-sm btn-primary" href="{{route('admin.contacts.show', $contact->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                                <i class="fa-regular fa-eye"></i>
                                                            </a>
                                                        @endcan

                                                        {{-- delete --}}
                                                        @can('contacts_delete')
                                                            <form action="{{route('admin.contacts.delete', $contact->id)}}" method="post">
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
                                                @lang('global.no-record-on-table')
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Paginate --}}
                        @if(count($contacts) > 0)
                            <div class="paginate-wrapper">
                                <p class="mb-3">
                                    Visualizzando da {{$contacts->firstItem()}} a {{$contacts->perPage()}} di {{$contacts->total()}}
                                </p>
                                {!! $contacts->appends(\Request::except('page'))->render() !!}
                            </div>
                        @endif
                
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection