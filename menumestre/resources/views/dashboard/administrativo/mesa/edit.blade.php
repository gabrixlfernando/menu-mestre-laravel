<div class="modal fade" id="alterarMesaModal{{ $mesa->id }}" tabindex="-1" role="dialog" aria-labelledby="alterarMesaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alterarMesaModalLabel">Alterar Mesa</h5>
                <button type="button" class="close" aria-label="Fechar" data-dismiss="modal">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-container" method="POST" action="{{ route('mesa.update', ['id' => $mesa->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Capacidade da Mesa:</label>
                        <p>{{ $mesa->capacidade }}</p>
                    </div>
                    <!-- Campos do formulário para editar a mesa -->
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="disponivel" {{ $mesa->status == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                            <option value="ocupada" {{ $mesa->status == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                            <option value="reservada" {{ $mesa->status == 'reservada' ? 'selected' : '' }}>Reservada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pessoas_sentadas">Quantas Pessoas?</label>
                        <input type="number" id="pessoas_sentadas" name="pessoas_sentadas" value="{{ $mesa->pessoas_sentadas }}" class="form-control" max="{{ $mesa->capacidade }}">
                    </div>
                    <!-- Outros campos do formulário, se necessário -->
                    <div class="modal-footer">
                        <div class="col">
                            <button type="button" class="btn btn-danger"  data-dismiss="modal">Cancelar</button>
                        </div>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

