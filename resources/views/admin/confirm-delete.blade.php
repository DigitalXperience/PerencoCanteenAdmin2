<!-- Modal de confirmation de suppression -->
<form action="{{ route('users.destroy', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="modal fade" id="confirmDeleteModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel-{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $user->id }}">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer l'utilisateur {{ $user->name }} (ID: {{ $user->id }}) ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary bg-green" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</form>
