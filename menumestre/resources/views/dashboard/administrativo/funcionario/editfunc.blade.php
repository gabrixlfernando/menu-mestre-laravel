<div class="modal fade" id="editFuncionarioatd{{ $atendente->idFuncionario }}" tabindex="-1" aria-labelledby="editFuncionarioatdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Adicionando classe modal-lg para tornar o modal grande -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editFuncionarioModalLabel">Atualização do Funcionário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <!-- Formulário de edit -->
          <form action="{{ route('admin.funcionario.update', ['idFuncionario' => $atendente->idFuncionario]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="fotoFuncionario" class="form-label">Foto do Funcionário</label>
                <input type="file" class="form-control" id="fotoFuncionario" name="fotoFuncionario" value="{{ $atendente->fotoFuncionario }}" onchange="exibirImagem(this)">
                <div class="mt-3">
                  <img id="imagemAtual" src="{{ asset('assets/images/funcionarios/' . $atendente->fotoFuncionario) }}" class="img-fluid" alt="Imagem do Produto">
              </div>
              </div>
            <div class="mb-3">
              <label for="nomeFuncionario" class="form-label">Nome do Funcionário</label>
              <input type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario" required value="{{ $atendente->nomeFuncionario }}">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required value="{{ $atendente->email }}">
            </div>
            <div class="mb-3">
              <label for="dataNascimento" class="form-label">Data de Nascimento</label>
              <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="{{ $atendente->dataNascimento }}">
            </div>
            <div class="mb-3">
              <label for="foneFuncionario" class="form-label">Telefone</label>
              <input type="text" class="form-control" id="foneFuncionario" name="foneFuncionario" value="{{ $atendente->foneFuncionario }}">
            </div>
            <div class="mb-3">
              <label for="enderecoFuncionario" class="form-label">Endereço</label>
              <input type="text" class="form-control" id="enderecoFuncionario" name="enderecoFuncionario" value="{{ $atendente->enderecoFuncionario }}">
            </div>
            <div class="mb-3">
              <label for="cidadeFuncionario" class="form-label">Cidade</label>
              <input type="text" class="form-control" id="cidadeFuncionario" name="cidadeFuncionario" value="{{ $atendente->cidadeFuncionario }}">
            </div>
            <div class="mb-3">
              <label for="estadoFuncionario" class="form-label">Estado</label>
              <input type="text" class="form-control" id="estadoFuncionario" name="estadoFuncionario" value="{{ $atendente->estadoFuncionario }}">
            </div>
            <div class="mb-3">
              <label for="cepFuncionario" class="form-label">CEP</label>
              <input type="text" class="form-control" id="cepFuncionario" name="cepFuncionario" value="{{ $atendente->cepFuncionario }}">
            </div>
            <div class="mb-3">
              <label for="dataContratacao" class="form-label">Data de Contratação</label>
              <input type="date" class="form-control" id="dataContratacao" name="dataContratacao" value="{{ $atendente->dataContratacao }}">
            </div>
            <div class="mb-3">
              <label for="cargo" class="form-label">Cargo</label>
              <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $atendente->cargo }}">
            </div>
            <div class="mb-3">
              <label for="salario" class="form-label">Salário</label>
              <input type="text" class="form-control" id="salario" name="salario" value="{{ $atendente->salario }}">
            </div>
            <div class="mb-3">
                <label for="tipoFuncionario" class="form-label">Tipo de Funcionário</label>
                <select class="form-select" id="tipoFuncionario" name="tipoFuncionario">
                    <option value="administrativo" {{ $atendente->tipoFuncionario === 'administrativo' ? 'selected' : '' }}>Administrativo</option>
                    <option value="atendente" {{ $atendente->tipoFuncionario === 'atendente' ? 'selected' : '' }}>Atendente</option>
                    <option value="cozinheiro" {{ $atendente->tipoFuncionario === 'cozinheiro' ? 'selected' : '' }}>Cozinheiro</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="statusFuncionario" class="form-label">Status do Funcionário</label>
                <select class="form-select" id="statusFuncionario" name="statusFuncionario">
                    <option value="ativo" {{ $atendente->statusFuncionario === 'ativo' ? 'selected' : '' }}>Ativo</option>
                    <option value="inativo" {{ $atendente->statusFuncionario === 'inativo' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>

            <!-- Botão de Cancelar -->
            <button type="button" class="btn btn-secondary float-start" data-dismiss="modal">Cancelar</button>
            <!-- Botão de Enviar -->
            <button type="submit" class="btn btn-primary float-end">Atualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    function exibirImagem(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagemAtual')
                    .attr('src', e.target.result)
                    .removeClass('d-none'); // Remove a classe d-none para exibir a imagem
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
