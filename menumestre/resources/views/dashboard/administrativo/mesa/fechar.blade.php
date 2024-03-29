<div class="modal fade" id="modalFecharConta" tabindex="-1" role="dialog" aria-labelledby="modalFecharContaLabel"
    aria-hidden="true">
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
                    @if ($produtosMesa)
                        @php
                            $totalPedidos = 0;
                            foreach ($produtosMesa as $pedido) {
                                $totalPedidos += $pedido['total_item'];
                            }

                            // Calcula a taxa do garçom (10% do total dos pedidos)
                            $taxaGarcom = $totalPedidos * 0.1;
                            $totalComTaxaGarcom = $totalPedidos + $taxaGarcom;
                        @endphp

                        <p>Total dos Pedidos: R$ <span
                                id="total-pedidos">{{ number_format($totalPedidos, 2, ',', '.') }}</span></p>
                        <p>Taxa Garçom (10%): R$ <span
                                id="taxa-garcom">{{ number_format($taxaGarcom, 2, ',', '.') }}</span></p>
                        <p>Total com Taxa Garçom: R$ <span
                                id="total-com-taxa">{{ number_format($totalComTaxaGarcom, 2, ',', '.') }}</span></p>
                    @endif
                    <div class="form-group">
                        <label for="valor_dado_cliente">Valor Dado pelo Cliente:</label>
                        <input type="number" class="form-control" id="valor_dado_cliente" name="valor_dado_cliente"
                            min="{{ $mesa->preco }}" step="0.01">
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

                    <!-- Div para exibir uma mensagem de erro se o valor pago for insuficiente -->
                    <div class="container mt-3 text-center" id="div-erro-valor-insuficiente" style="display: none;">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div id="erro-valor-insuficiente" class="alert alert-danger" role="alert">
                                    Valor pago é insuficiente.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Div para exibir uma mensagem de erro se o valor digitado pelo cliente não for um número válido -->
                    <div class="container mt-3 text-center" id="div-erro-valor-invalido" style="display: none;">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div id="erro-valor-invalido" class="alert alert-danger" role="alert">
                                    Por favor, insira um valor válido.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pagar-taxa">Deseja pagar a taxa de serviço de 10%?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pagar-taxa" name="pagar_taxa" checked>
                            <label class="form-check-label" for="pagar-taxa">Sim, desejo pagar a taxa de serviço</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col">
                            <button type="button" class="btn btn-success" onclick="calcularTroco()">Calcular
                                Troco</button>
                        </div>
                        <button type="submit" class="btn btn-danger">Fechar Conta</button>
                    </div>
                </form>


            </div>
        </div>
    </div>



    <script>
        function calcularTroco() {
            // Obtenha o total dos pedidos e a taxa de serviço
            var totalPedidos = parseFloat(document.getElementById('total-pedidos').textContent.replace('R$ ', '').replace(
                ',', '.'));
            var taxaGarcom = parseFloat(document.getElementById('taxa-garcom').textContent.replace('R$ ', '').replace(',',
                '.'));

            // Verifique se o cliente deseja pagar a taxa de serviço
            var pagarTaxa = document.getElementById('pagar-taxa').checked;

            // Calcule o total com ou sem taxa de serviço
            var totalComTaxa;
            if (pagarTaxa) {
                totalComTaxa = totalPedidos + taxaGarcom;
            } else {
                totalComTaxa = totalPedidos;
            }

            // Obtenha o valor digitado pelo cliente
            var valorDadoCliente = parseFloat(document.getElementById('valor_dado_cliente').value);

            // Calcule o troco
            var troco = valorDadoCliente - totalComTaxa;

            // Exiba o resultado
            var divTroco = document.getElementById('div-troco');
            var divTrocoContent = document.getElementById('troco');
            if (!isNaN(valorDadoCliente)) { // Verifique se o valor digitado pelo cliente é um número válido
                if (troco >= 0) {
                    divTroco.style.display = 'block'; // Mostrar a div de troco
                    divTrocoContent.innerHTML = 'Troco: R$ ' + troco.toFixed(2); // Exibir o valor do troco
                } else {
                    document.getElementById('div-erro-valor-insuficiente').style.display =
                    'block'; // Mostrar a div de erro de valor insuficiente
                }
            } else {
                document.getElementById('div-erro-valor-invalido').style.display =
                'block'; // Mostrar a div de erro de valor inválido
            }
        }
    </script>
