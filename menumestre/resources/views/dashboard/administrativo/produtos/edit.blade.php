<div class="modal fade" id="edit{{ $item->idProduto }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Conteúdo do modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atualizar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Conteúdo do formulário -->
                <div class="container">
                    <div class="inserir-container">
                         <form class="form-container" action="{{ route('admin.produto.update', ['idProduto' => $item->idProduto])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputImagem">Imagem:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fotoProduto{{ $item->idProduto }}" name="fotoProduto" onchange="exibirImagem(this, {{ $item->idProduto }})">
                                                <label class="custom-file-label" for="fotoProduto{{ $item->idProduto }}">Escolha um arquivo</label>
                                            </div>
                                            <!-- Exibir a imagem atual -->
                                            <div class="mt-3" style="text-align: center;">
                                                <img id="imagemAtual{{ $item->idProduto }}" src="{{ asset('assets/images/cardapio/' . $item->fotoProduto) }}" class="img-fluid" alt="Imagem do Produto" style="margin: 0 auto;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nomeProduto">Título do Produto:</label>
                                            <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" maxlength="20" placeholder="Título do produto" required value="{{ $item->nomeProduto }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="descricaoProduto">Descrição do Produto:</label>
                                            <textarea class="form-control" id="descricaoProduto" name="descricaoProduto" rows="4" maxlength="100" placeholder="Descrição do produto" required>{{ $item->descricaoProduto }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="valorProduto">Preço do Produto:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input type="text" class="form-control" id="valorProduto" name="valorProduto" pattern="^[0-9]+(\.[0-9]{1,2})?$" maxlength="7" placeholder="Preço do produto" required value="{{ $item->valorProduto }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categoriaProduto">Categoria do Produto:</label>
                                            <select class="form-control" id="categoriaProduto" name="categoriaProduto" required>
                                                <option value="comida" {{ $item->categoriaProduto == 'comida' ? 'selected' : '' }}>Comida</option>
                                                <option value="bebida" {{ $item->categoriaProduto == 'bebida' ? 'selected' : '' }}>Bebida</option>
                                                <option value="sobremesa" {{ $item->categoriaProduto == 'sobremesa' ? 'selected' : '' }}>Sobremesa</option>
                                                <option value="massa" {{ $item->categoriaProduto == 'massa' ? 'selected' : '' }}>Massa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Botão de fechar o modal -->

        </div>
    </div>
</div>



<script>
    // function exibirImagem(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             $('#imagemAtual')
    //                 .attr('src', e.target.result)
    //                 .removeClass('d-none'); // Remove a classe d-none para exibir a imagem
    //         };
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }

    function exibirImagem(input, idProduto) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Montar o ID da imagem atual usando o ID do produto
                var imagemAtualId = '#imagemAtual' + idProduto;

                // Exibir a imagem atualizada no modal
                $(imagemAtualId)
                    .attr('src', e.target.result)
                    .removeClass('d-none'); // Remover a classe d-none para exibir a imagem
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
