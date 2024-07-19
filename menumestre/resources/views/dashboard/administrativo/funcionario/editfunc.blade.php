<!-- Modal -->
<div class="modal fade" id="editFuncionarioatd{{ $atendente->idFuncionario }}" tabindex="-1" aria-labelledby="editFuncionarioatdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFuncionarioModalLabel">Atualização do Funcionário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.funcionario.update', ['idFuncionario' => $atendente->idFuncionario]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="fotoFuncionario{{ $atendente->idFuncionario }}" class="form-label">Foto do Funcionário</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoFuncionario{{ $atendente->idFuncionario }}" name="fotoFuncionario" onchange="exibirNovaImagemAtendente(this, {{ $atendente->idFuncionario }})">
                            <label class="custom-file-label" for="fotoFuncionario{{ $atendente->idFuncionario }}">Escolha uma imagem</label>
                        </div>
                        <div class="mt-3 text-center">
                            <img id="imagemAtendente{{ $atendente->idFuncionario }}" src="{{ asset('../assets/images/funcionarios/' . $atendente->fotoFuncionario) }}" class="img-fluid" alt="Imagem do Funcionário">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nomeFuncionario" class="form-label">Nome do Funcionário</label>
                            <input type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario" required value="{{ $atendente->nomeFuncionario }}">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ $atendente->email }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="{{ $atendente->dataNascimento }}">
                        </div>
                        <div class="col">
                            <label for="foneFuncionario" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="foneFuncionario" name="foneFuncionario" value="{{ $atendente->foneFuncionario }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="cepFuncionario" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cepFuncionario" name="cepFuncionario" value="{{ $atendente->cepFuncionario }}" onblur="pesquisacep(this.value)">
                        </div>
                        <div class="col">
                            <label for="enderecoFuncionario" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="enderecoFuncionario" name="enderecoFuncionario" value="{{ $atendente->enderecoFuncionario }}">
                        </div>
                        <div class="col">
                            <label for="bairroFuncionario" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairroFuncionario" name="bairroFuncionario" value="{{ $atendente->bairroFuncionario }}">
                        </div>
                        <div class="col">
                            <label for="numeroFuncionario" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numeroFuncionario" name="numeroFuncionario" value="{{ $atendente->numeroFuncionario }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="cidadeFuncionario" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidadeFuncionario" name="cidadeFuncionario" value="{{ $atendente->cidadeFuncionario }}">
                        </div>
                        <div class="col">
                            <label for="estadoFuncionario" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estadoFuncionario" name="estadoFuncionario" value="{{ $atendente->estadoFuncionario }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="dataContratacao" class="form-label">Data de Contratação</label>
                            <input type="date" class="form-control" id="dataContratacao" name="dataContratacao" value="{{ $atendente->dataContratacao }}">
                        </div>
                        <div class="col">
                            <label for="cargo" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $atendente->cargo }}">
                        </div>
                        <div class="col">
                            <label for="salario" class="form-label">Salário</label>
                            <input type="text" class="form-control" id="salario" name="salario" value="{{ $atendente->salario }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tipoFuncionario" class="form-label">Tipo de Funcionário</label>
                            <div class="input-group d-flex justify-content-center">
                                <select class="form-control" id="tipoFuncionario" name="tipoFuncionario">
                                    <option value="administrativo" {{ $atendente->tipoFuncionario === 'administrativo' ? 'selected' : '' }}>Administrativo</option>
                                    <option value="atendente" {{ $atendente->tipoFuncionario === 'atendente' ? 'selected' : '' }}>Atendente</option>
                                    <option value="cozinheiro" {{ $atendente->tipoFuncionario === 'cozinheiro' ? 'selected' : '' }}>Cozinheiro</option>
                                </select>
                                <label class="input-group-text" for="tipoFuncionario"><i class="fas fa-user"></i></label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="statusFuncionario" class="form-label">Status do Funcionário</label>
                            <div class="input-group d-flex justify-content-center">
                                <select class="form-control" id="statusFuncionario" name="statusFuncionario">
                                    <option value="ativo" {{ $atendente->statusFuncionario === 'ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="inativo" {{ $atendente->statusFuncionario === 'inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <label class="input-group-text" for="statusFuncionario"><i class="fas fa-user"></i></label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Função para exibir a miniatura da imagem selecionada
    function exibirNovaImagemAtendente(input, idFuncionario) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var novaImagemURL = e.target.result;
                var idImagem = 'imagemAtendente' + idFuncionario;
                document.getElementById(idImagem).src = novaImagemURL;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Função para limpar os campos de endereço
    function limpa_formulário_cep() {
        document.getElementById('enderecoFuncionario').value = "";
        document.getElementById('cidadeFuncionario').value = "";
        document.getElementById('estadoFuncionario').value = "";
        document.getElementById('bairroFuncionario').value = "";
    }

    // Função de callback da API ViaCEP
    function meu_callback(conteudo) {
        console.log(conteudo); // Adicione este log para depuração
        if (!("erro" in conteudo)) {
            document.getElementById('enderecoFuncionario').value = conteudo.logradouro || "";
            document.getElementById('bairroFuncionario').value = conteudo.bairro || "";
            document.getElementById('cidadeFuncionario').value = conteudo.localidade || "";
            document.getElementById('estadoFuncionario').value = conteudo.uf || "";
        } else {
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    // Função para pesquisar o CEP
    function pesquisacep(valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep !== "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                // Exibe texto de carregamento
                document.getElementById('enderecoFuncionario').value = "...";
                document.getElementById('bairroFuncionario').value = "...";
                document.getElementById('cidadeFuncionario').value = "...";
                document.getElementById('estadoFuncionario').value = "...";

                // Remove o script existente, se houver
                var existingScript = document.getElementById('viaCepScript');
                if (existingScript) {
                    existingScript.parentNode.removeChild(existingScript);
                }

                // Adiciona o script da API ViaCEP
                var script = document.createElement('script');
                script.id = 'viaCepScript'; // Adiciona um ID para facilitar a remoção
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
</script>
