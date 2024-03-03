
  <!-- Modal -->
  <div class="modal fade" id="createFuncionario" tabindex="-1" aria-labelledby="createFuncionarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Adicionando classe modal-lg para tornar o modal grande -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cadastroFuncionarioModalLabel">Cadastro de Funcionário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <!-- Formulário de cadastro -->
          <form action="{{ route('admin.funcionario.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="fotoFuncionario" class="form-label">Foto do Funcionário</label>
                <input type="file" class="form-control" id="fotoFuncionario" name="fotoFuncionario" onchange="previewFile()">
              </div>
               <!-- Div para exibir a miniatura da imagem -->
               <div class="form-group">
                <img src="#" id="preview" class="img-fluid" alt="Preview da Imagem"
                    style="display: none;">
                <p id="filename" style="display: none;"></p>
            </div>
            <div class="mb-3">
              <label for="nomeFuncionario" class="form-label">Nome do Funcionário</label>
              <input type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="dataNascimento" class="form-label">Data de Nascimento</label>
              <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
            </div>
            <div class="mb-3">
              <label for="foneFuncionario" class="form-label">Telefone</label>
              <input type="text" class="form-control" id="foneFuncionario" name="foneFuncionario">
            </div>
            <div class="mb-3">
              <label for="enderecoFuncionario" class="form-label">Endereço</label>
              <input type="text" class="form-control" id="enderecoFuncionario" name="enderecoFuncionario">
            </div>
            <div class="mb-3">
              <label for="cidadeFuncionario" class="form-label">Cidade</label>
              <input type="text" class="form-control" id="cidadeFuncionario" name="cidadeFuncionario">
            </div>
            <div class="mb-3">
              <label for="estadoFuncionario" class="form-label">Estado</label>
              <input type="text" class="form-control" id="estadoFuncionario" name="estadoFuncionario">
            </div>
            <div class="mb-3">
              <label for="cepFuncionario" class="form-label">CEP</label>
              <input type="text" class="form-control" id="cepFuncionario" name="cepFuncionario">
            </div>
            {{-- <div class="mb-3">
              <label for="dataContratacao" class="form-label">Data de Contratação</label>
              <input type="date" class="form-control" id="dataContratacao" name="dataContratacao">
            </div> --}}
            <div class="mb-3">
              <label for="cargo" class="form-label">Cargo</label>
              <input type="text" class="form-control" id="cargo" name="cargo">
            </div>
            <div class="mb-3">
              <label for="salario" class="form-label">Salário</label>
              <input type="text" class="form-control" id="salario" name="salario">
            </div>
            <div class="mb-3">
              <label for="tipoFuncionario" class="form-label">Tipo de Funcionário</label>
              <select class="form-select" id="tipoFuncionario" name="tipoFuncionario">
                <option value="administrativo">Administrativo</option>
                <option value="atendente">Atendente</option>
                <option value="cozinheiro">Cozinheiro</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="statusFuncionario" class="form-label">Status do Funcionário</label>
              <select class="form-select" id="statusFuncionario" name="statusFuncionario">
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
              </select>
            </div>

            <!-- Botão de Cancelar -->
            <button type="button" class="btn btn-secondary float-start" data-dismiss="modal">Cancelar</button>
            <!-- Botão de Enviar -->
            <button type="submit" class="btn btn-primary float-end">Cadastrar</button>
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
</script>
