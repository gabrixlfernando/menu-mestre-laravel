<!-- Modal -->
<div class="modal fade" id="createMesa" tabindex="-1" role="dialog" aria-labelledby="createMesaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarMesaLabel">Adicionar Mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário -->
                <form id="formAdicionarMesa" method="POST" action="{{ route('mesa.create') }}">
                    @csrf
                    <div class="form-group">
                        <label for="capacidade">Capacidade</label>
                        <input type="number" class="form-control" id="capacidade" name="capacidade" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="disponivel">Disponível</option>
                            <option value="reservada">Reservada</option>
                            <option value="ocupada">Ocupada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="preco">Preço</label>
                        <input type="number" class="form-control" id="preco" name="preco" pattern="^[0-9]+(\.[0-9]{1,2})?$" maxlength="7" required>
                    </div>
                    <div class="modal-footer">
                        <div class="col">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                        <button type="submit" class="btn btn-success">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
