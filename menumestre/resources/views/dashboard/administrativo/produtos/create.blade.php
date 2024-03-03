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
                        <form class="form-container" action="{{ route('admin.produto.create') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputGroupFile01">Imagem:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                    name="fotoProduto" required onchange="previewFile()">
                                                <label class="custom-file-label" for="inputGroupFile01">Escolha um
                                                    arquivo</label>
                                            </div>
                                        </div>
                                        <!-- Div para exibir a miniatura da imagem -->
                                        <div class="form-group">
                                            <img src="#" id="preview" class="img-fluid" alt="Preview da Imagem"
                                                style="display: none;">
                                            <p id="filename" style="display: none;"></p>
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" id="nomeProduto"
                                                name="nomeProduto" maxlength="20" placeholder="Título do produto"
                                                required>
                                        </div>
                                        <div class="form-group">

                                            <textarea class="form-control" id="descricaoProduto" name="descricaoProduto" rows="4" maxlength="100"
                                                placeholder="Descrição do produto" required></textarea>
                                        </div>
                                        <div class="form-group">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="comida"
                                                    name="categoriaProduto" value="comida" required>
                                                <label class="form-check-label categoria-btn"
                                                    for="comida">Comida</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="massa"
                                                    name="categoriaProduto" value="massa" required>
                                                <label class="form-check-label categoria-btn"
                                                    for="massa">Massa</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="bebida"
                                                    name="categoriaProduto" value="bebida" required>
                                                <label class="form-check-label categoria-btn"
                                                    for="bebida">Bebida</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="sobremesa"
                                                    name="categoriaProduto" value="sobremesa" required>
                                                <label class="form-check-label categoria-btn"
                                                    for="sobremesa">Sobremesa</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">R$</span>
                                                </div>
                                                <input type="text" class="form-control" id="valorProduto"
                                                    name="valorProduto" pattern="^[0-9]+(\.[0-9]{1,2})?$" maxlength="7"
                                                    placeholder="Preço do produto" required>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <div class="col">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
     // Função para exibir a miniatura da imagem selecionada
     function previewFile() {
        var preview = document.getElementById('preview');
        var file = document.querySelector('input[type=file]').files[0];
        var filename = document.getElementById('filename');

        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
            filename.textContent = file.name; // Exibe o nome real do arquivo
            filename.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            filename.textContent = '';
            preview.style.display = 'none';
            filename.style.display = 'none';
        }
    }
</script>
