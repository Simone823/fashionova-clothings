{{-- Button --}}
<button type="button" class="btn btn-danger text-uppercase" data-bs-toggle="modal" data-bs-target="#deleteUserAccountModal">
    Elimina Account
</button>

<!-- Modal -->
<div class="modal fade" id="deleteUserAccountModal" tabindex="-1" aria-labelledby="deleteUserAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-body-secondary">
            <div class="modal-header border-0">
                <h1 class="modal-title text-danger fw-bold fs-5" id="deleteUserAccountModalLabel">
                    Elimina Account
                </h1>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.profiles.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <p class="fw-semibold">Sei sicuro di voler eliminare il tuo account? Questa azione è irreversibile e comporterà la perdita di tutti i dati associati al tuo profilo. Prima di procedere, assicurati di aver eseguito il backup di tutte le informazioni importanti. Se sei certo di voler procedere con l'eliminazione del tuo account, clicca su 'Elimina account'. In caso contrario, puoi annullare l'operazione cliccando su 'Annulla' o chiudendo questa finestra modale.</p>

                    {{-- buttons --}}
                    <div class="modal-footer border-0 d-flex gap-2">
                        <button type="submit" class="btn btn-danger fw-bold text-uppercase">
                            Elimina account
                        </button>
                        <button type="button" class="btn btn-primary fw-bold text-uppercase" data-bs-dismiss="modal">
                            Annulla
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>