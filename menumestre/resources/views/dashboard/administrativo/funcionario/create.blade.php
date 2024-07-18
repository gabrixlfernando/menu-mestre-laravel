
<!-- Modal -->
<div class="modal fade" id="createFuncionario" tabindex="-1" aria-labelledby="createFuncionarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cadastroFuncionarioModalLabel">Cadastro de Funcionário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.funcionario.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="fotoFuncionario" class="form-label">Foto do Funcionário</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="fotoFuncionario" onchange="previewFile()">
                            <label class="custom-file-label" for="inputGroupFile01">Escolha uma imagem</label>
                        </div>
                        <div class="mt-2" style="text-align: center;">
                            <img src="#" id="preview" class="img-fluid" alt="Preview da Imagem" style="display: none; margin: 0 auto;">
                            <p id="filename" style="display: none;"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="nomeFuncionario" class="form-label">Nome do Funcionário</label>
                            <input type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario" required>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
                        </div>
                        <div class="col">
                            <label for="foneFuncionario" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="foneFuncionario" name="foneFuncionario">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cepFuncionario" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cepFuncionario" name="cepFuncionario" onblur="pesquisacep(this.value);" />
                        </div>
                        <div class="col">
                            <label for="enderecoFuncionario" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="enderecoFuncionario" name="enderecoFuncionario">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cidadeFuncionario" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidadeFuncionario" name="cidadeFuncionario">
                        </div>
                        <div class="col">
                            <label for="estadoFuncionario" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estadoFuncionario" name="estadoFuncionario">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cargo" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo">
                        </div>
                        <div class="col">
                            <label for="salario" class="form-label">Salário</label>
                            <input type="text" class="form-control" id="salario" name="salario">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tipoFuncionario" class="form-label">Tipo de Funcionário</label>
                        <div class="input-group">
                            <select class="form-control" id="tipoFuncionario" name="tipoFuncionario">
                                <option value="administrativo">Administrativo</option>
                                <option value="atendente">Atendente</option>
                                <option value="cozinheiro">Cozinheiro</option>
                            </select>
                            <label class="input-group-text" for="tipoFuncionario"><i class="fas fa-user"></i></label>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
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

   function limpa_formulário_cep() {
        document.getElementById('enderecoFuncionario').value = ("");
        document.getElementById('cidadeFuncionario').value = ("");
        document.getElementById('estadoFuncionario').value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('enderecoFuncionario').value = (conteudo.logradouro);
            document.getElementById('cidadeFuncionario').value = (conteudo.localidade);
            document.getElementById('estadoFuncionario').value = (conteudo.uf);
        } else {
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep != "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                document.getElementById('enderecoFuncionario').value = "...";
                document.getElementById('cidadeFuncionario').value = "...";
                document.getElementById('estadoFuncionario').value = "...";

                var script = document.createElement('script');

                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                document.body.appendChild(script);
            } else {
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            limpa_formulário_cep();
        }
    }

    function previewFile() {
        var preview = document.getElementById('preview');
        var file = document.querySelector('input[type=file]').files[0];
        var filename = document.getElementById('filename');

        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
            filename.textContent = file.name;
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
