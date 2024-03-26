<div class="modal fade" id="modalFecharConta" tabindex="-1" role="dialog" aria-labelledby="modalFecharContaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFecharContaLabel">Fechar Conta da Mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para fechar a conta -->
                <form action="{{ route('mesa.fechar', ['id' => $mesa->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <p>Total: R$ {{ $mesa->preco }}</p>
                    <div class="form-group">
                        <label for="valor_dado_cliente">Valor Dado pelo Cliente:</label>
                        <input type="number" class="form-control" id="valor_dado_cliente" name="valor_dado_cliente" min="{{ $mesa->preco }}" step="0.01">
                    </div>

                    <!-- Botão para calcular o troco -->


                    <!-- Div para exibir o troco -->
                    <div class="container mt-3 text-center" id="div-troco" style="display: none;">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div id="troco"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col">
                            <button type="button" class="btn btn-success" onclick="calcularTroco()">Calcular Troco</button>
                        </div>
                        <button type="submit" class="btn btn-danger">Fechar Conta</button>
                    </div>
                </form>


        </div>
    </div>
</div>



<script>
    function calcularTroco() {
        // Obter o valor dado pelo cliente
        var valorDadoCliente = parseFloat(document.getElementById('valor_dado_cliente').value);

        // Obter o total da mesa
        var totalMesa = parseFloat('{{ $mesa->preco }}');

        // Calcular o troco
        var troco = valorDadoCliente - totalMesa;

        // Exibir o troco na div
        document.getElementById('troco').innerText = 'Troco R$ ' + troco.toFixed(2);

        // Exibir a div do troco
        document.getElementById('div-troco').style.display = 'block';
    }
</script>
