@extends('layouts.admin')

@section('metaTitle', 'Creazione Categoria')

@section('content')
    <section id="admin-categories-create">
        <div class="container-fluid">

            {{-- title --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="title-page">
                        <i class="fa-solid fa-tags fs-4"></i>
                        Creazione Categoria
                    </h3>
                </div>
            </div>

            {{-- card --}}
            <div class="card px-3 py-4 shadow-sm border-0">
                <form action="{{route('admin.categories.store')}}" method="post">
                    @csrf

                    <div class="row gy-4 mb-5">
                        {{-- name --}}
                        <div class="col-12 col-md-6 form-group">
                            <label for="name" class="form-label">
                                Nome*
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required>

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