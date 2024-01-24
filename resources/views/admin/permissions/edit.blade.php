@extends('layouts.admin')

@section('metaTitle', "Modifica Permesso: {$permission->name}")

@section('content')
    <section id="admin-permissions-edit">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-briefcase fs-4"></i>
                        Modifica Permesso
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                <form action="{{route('admin.permissions.update', $permission->id)}}" method="post">
                    @csrf

                    <div class="row gy-4 mb-5">
                        {{-- name --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="name" class="form-label">
                                Nome*
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $permission->name)}}" required>

                            @error('name')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions btn --}}
                    <div class="row">
                        <div class="col-12 d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary text-uppercase">
                                <i class="fa-solid fa-bookmark me-1"></i>
                                Salva
                            </button>

                            <a href="{{url()->previous()}}" class="btn btn-danger text-uppercase">
                                <i class="fa-solid fa-ban me-1"></i>
                                Annulla
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection