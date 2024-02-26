<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Conteúdo do modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inserir Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Conteúdo do formulário -->
                <div class="container">
                    <div class="inserir-container">
                        <form class="form-container" action="index.php?p=cardapio&c=inserir" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputImagem">Imagem:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputImagem" name="fotoProduto" required>
                                                <label class="custom-file-label" for="inputImagem">Escolha um arquivo</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nomeProduto">Título do Produto:</label>
                                            <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" maxlength="20" placeholder="Título do produto" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="descricaoProduto">Descrição do Produto:</label>
                                            <textarea class="form-control" id="descricaoProduto" name="descricaoProduto" rows="4" maxlength="100" placeholder="Descrição do produto" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="valorProduto">Preço do Produto:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input type="text" class="form-control" id="valorProduto" name="valorProduto" pattern="^[0-9]+(\.[0-9]{1,2})?$" maxlength="7" placeholder="Preço do produto" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Categoria do Produto:</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="comida" name="categoriaProduto" value="comida" required>
                                                <label class="form-check-label" for="comida">Comida</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="bebida" name="categoriaProduto" value="bebida" required>
                                                <label class="form-check-label" for="bebida">Bebida</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="sobremesa" name="categoriaProduto" value="sobremesa" required>
                                                <label class="form-check-label" for="sobremesa">Sobremesa</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Botão de fechar o modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
