{{-- Button --}}
<button type="button" class="btn btn-primary text-uppercase" data-bs-toggle="modal" data-bs-target="#changePasswordUserModal">
    Cambia Password
</button>

<!-- Modal -->
<div class="modal fade" id="changePasswordUserModal" tabindex="-1" aria-labelledby="changePasswordUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-body-secondary">
            <div class="modal-header">
                <h1 class="fs-5 fw-bolder" id="changePasswordUserModalLabel">
                    Cambia Password
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.profiles.changePassword', $user->id)}}" method="POST">
                    @csrf

                    {{-- password --}}
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Nuova Password*</label>
                        <input type="password" class="form-control @if($errors->profiles_change_password->has('password')) is-invalid @endif" id="password" name="password" value="{{ old('password') }}" placeholder="Scrivi la nuova password" required autocomplete="off" autofocus="off">

                        @if ($errors->profiles_change_password->has('password'))
                            <div class="text-danger mt-1">
                                {{ $errors->profiles_change_password->first('password') }}
                            </div>
                        @endif
                    </div>

                    {{-- password confirm --}}
                    <div class="form-group mb-4">
                        <label for="password-confirm" class="form-label">Conferma nuova Password*</label>
                        <input type="password" class="form-control @if($errors->profiles_change_password->has('password_confirmation')) is-invalid @endif" id="password-confirm" name="password_confirmation" value="" placeholder="Conferma la nuova password" required autocomplete="off" autofocus="off">

                        @if ($errors->profiles_change_password->has('password_confirmation'))
                            <div class="text-danger mt-1">
                                {{ $errors->profiles_change_password->first('password_confirmation') }}
                            </div>
                        @endif
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

{{-- JS --}}
@push('javascript')
    @if ($errors->profiles_change_password->any())
        <script type="module">
            openModal('changePasswordUserModal');
        </script>
    @endif
@endpush