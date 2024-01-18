{{-- Button --}}
<button type="button" class="btn btn-primary text-uppercase" data-bs-toggle="modal" data-bs-target="#createAddressModal">
    Aggiungi Indirizzo
</button>

<!-- Modal -->
<div class="modal fade" id="createAddressModal" tabindex="-1" aria-labelledby="createAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-large">
        <div class="modal-content bg-body-secondary">
            <div class="modal-header">
                <h1 class="fs-5 fw-bolder" id="createAddressModalLabel">
                    Aggiungi Indirizzo
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.profiles.createAddress', $user->id)}}" method="POST" class="row">
                    @csrf

                    {{-- is primary --}}
                    <div class="col-12 mb-4">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="is_primary">
                                Indirizzo primario
                            </label>
                            <input {{old('is_primary') == 'on' ? 'checked' : ''}} class="form-check-input @error('is_primary') is-invalid @enderror" type="checkbox" role="switch" id="is_primary" name="is_primary" >

                            @error('is_primary')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- nation id --}}
                    <div class="col-12 col-md-6 mb-4 form-group">
                        <label for="nation_id" class="form-label">Nazione*</label>
                        <select class="form-select @error('nation_id') is-invalid @enderror" name="nation_id" id="nation_id" required>
                            <option value="" selected hidden>-- Seleziona una Nazione --</option>
                            <option selected value="{{App\Nation::where('name', 'Italia')->pluck('id')->first()}}">{{App\Nation::where('name', 'Italia')->pluck('name')->first()}}</option>
                        </select>

                        @error('nation_id')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    {{-- region_id --}}
                    <div class="col-12 col-md-6 mb-4 form-group">
                        <label for="region_id" class="form-label">Regione*</label>
                        <select onchange="filterProvinceByRegionId(event)" class="form-select @error('region_id') is-invalid @enderror" name="region_id" id="region_id" required>
                            <option value="" selected hidden>-- Seleziona una Regione --</option>
                            @foreach (App\Region::orderBy('name', 'asc')->get() as $region)
                                <option {{old('region_id') == $region->id ? 'selected' : ''}} value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>

                        @error('region_id')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    {{-- province_id --}}
                    <div class="col-12 col-md-6 mb-4 form-group">
                        <label for="province_id" class="form-label">Provincia*</label>
                        <select onchange="filterCitiesByProvinceId(event)" class="form-select @error('province_id') is-invalid @enderror" name="province_id" id="province_id" required>
                            <option value="">-- Seleziona una Provincia --</option>
                            @foreach (App\Province::orderBy('name', 'asc')->get() as $province)
                                <option {{old('province_id') == $province->id ? 'selected' : ''}} data-region-id="{{$province->region_id}}" value="{{$province->id}}">{{$province->name}}</option>
                            @endforeach
                        </select>

                        @error('province_id')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    {{-- city_id --}}
                    <div class="col-12 col-md-6 mb-4 form-group">
                        <label for="city_id" class="form-label">Comune*</label>
                        <select class="form-select @error('city_id') is-invalid @enderror" name="city_id" id="city_id" required>
                            <option value="" selected hidden>-- Seleziona un Comune --</option>
                            @foreach (App\City::orderBy('name', 'asc')->get() as $city)
                                <option {{old('city_id') == $city->id ? 'selected' : ''}} data-province-id="{{$city->province_id}}" value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>

                        @error('city_id')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    {{-- cap --}}
                    <div class="col-12 col-md-6 mb-4 form-group">
                        <label for="cap" class="form-label">Cap*</label>
                        <input type="number" class="form-control @error('cap') is-invalid @enderror" id="cap" name="cap" value="{{old('cap')}}" placeholder="Cap" >

                        @error('cap')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    {{-- address --}}
                    <div class="col-12 col-md-6 mb-4 form-group">
                        <label for="address" class="form-label">Indirizzo*</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address')}}" placeholder="Via / Piazza" >

                        @error('address')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    {{-- house number --}}
                    <div class="col-12 col-md-6 mb-4 form-group">
                        <label for="house_number" class="form-label">Numero Civico*</label>
                        <input type="text" class="form-control @error('house_number') is-invalid @enderror" id="house_number" name="house_number" value="{{old('house_number')}}" placeholder="Numero civico" >

                        @error('house_number')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- buttons --}}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-uppercase">
                        Salva
                    </button>
                    <button type="button" class="btn btn-primary text-uppercase" data-bs-dismiss="modal">
                        Annulla
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('javascript')
    @if($errors->any())
        <script type="module">
            openModal('createAddressModal');
        </script>
    @endif
@endpush