{{-- <div class="modal fade" id="AdicionarProduto{{ $mesa->id}}" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarProdutoLabel" aria-hidden="true">
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
                <form action="{{ route('mesa.adicionar', ['id' => $mesa->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="produto">Selecione o Produto:</label>
                        <select class="form-control" id="produto" name="produto">
                            @foreach($cardapio as $item)
                                <option value="{{ $item->idProduto }}">{{ $item->idProduto }} - {{ $item->nomeProduto }} - R$ {{ $item->valorProduto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="1">
                        <input type="number" class="form-control" id="mesa_id" name="mesa_id"  value="{{ $mesa -> id }}" style="display: none;">
                    </div>
                    <div class="modal-footer">
                        <div class="col">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                        <button type="submit" class="btn btn-success">Adicionar Produto</button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div> --}}



<!-- Modal para Adicionar Produto à Mesa -->
 <div class="modal fade" id="AdicionarProduto{{ $mesa->id }}" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarProdutoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarProdutoLabel">Adicionar Produto à Mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de Adicionar Produto -->
                <form action="{{ route('mesa.adicionar', ['id' => $mesa->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="categoria">Filtrar por Categoria:</label>
                        <select class="form-control" id="categoria" name="categoria">
                            <option value="">Todas as categorias</option>
                            <option value="massa">Massa</option>
                            <option value="comida">Comida</option>
                            <option value="sobremesa">Sobremesa</option>
                            <option value="bebida">Bebida</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="produto">Selecione o Produto:</label>
                        <select class="form-control" id="produto" name="produto">
                            <option value="">Selecione um Produto</option>
                            @foreach($cardapio as $item)
                                <option class="categoria-{{ strtolower($item->categoriaProduto) }}" value="{{ $item->idProduto }}">{{ $item->idProduto }} - {{ $item->nomeProduto }} - R$ {{ $item->valorProduto }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="1">
                        <input type="hidden" class="form-control" id="mesa_id" name="mesa_id" value="{{ $mesa->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Adicionar Produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script para Filtrar Produtos por Categoria -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categoria').change(function() {
            var categoria_selecionada = $(this).val();

            // Mostrar todos os produtos e depois filtrar pela categoria selecionada
            $('#produto option').hide();

            if (categoria_selecionada) {
                $('.categoria-' + categoria_selecionada).show();
            } else {
                $('#produto option').show();
            }
        });
    });
</script> 






