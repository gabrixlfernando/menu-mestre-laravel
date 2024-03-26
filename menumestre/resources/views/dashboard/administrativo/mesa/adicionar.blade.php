<div class="modal fade" id="AdicionarProduto" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarProdutoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarProdutoLabel">Adicionar Produto à Mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Conteúdo do formulário -->
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="produto">Selecione o Produto:</label>
                        <select class="form-control" id="produto" name="produto">
                            @foreach($cardapio as $item)
                                <option value="{{ $item->idProduto }}">{{ $item->nomeProduto }} - R$ {{ $item->valorProduto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
