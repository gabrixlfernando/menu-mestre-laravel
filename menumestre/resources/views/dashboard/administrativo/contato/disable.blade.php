   <!-- Modal de confirmação de exclusão da lixeira -->
   <div class="modal fade" id="modalLixeira" tabindex="-1" role="dialog" aria-labelledby="modalLixeiraLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLixeiraLabel">Excluir Mensagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir esta mensagem? Esta ação não poderá ser desfeita!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <!-- Formulário para exclusão -->
                <form id="formDelete" method="POST" action="{{ route('contato.desativar', ['id' => $contato->id]) }}">
                    @csrf
                    <!-- Campo oculto para enviar o ID da mensagem -->
                    <input type="hidden" name="contato_id" id="contatoIdParaExcluir">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
