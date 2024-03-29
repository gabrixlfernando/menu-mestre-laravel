@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')


    <div class="container mt-5">

        <a href="{{ route('dashboard.administrativo.mesa') }}" class="btn btn-dark mb-3">
            <i class="fa fa-arrow-left"></i> Voltar às Mesas
        </a>


        <h2>Mesa {{ $mesa->numero_mesa }}</h2>



        <div class="row">
            <div class="col-md-6 mb-3"> <!-- Adiciona um espaçamento inferior de 3 unidades -->
                <button class="btn btn-warning" id="btn-adicionar-produto" data-toggle="modal"
                    data-target="#AdicionarProduto{{ $mesa->id }}">Adicionar Produto</button>
            </div>
            @include('dashboard.administrativo.mesa.adicionar')
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody id="lista-pedidos">
                @php
                    $mesa_session_key = 'mesa_' . $mesa->id;
                    $produtosMesa = session()->get($mesa_session_key . '.produtos', []);
                @endphp

                @forelse ($produtosMesa as $index => $pedido)
                    <tr>
                        <td>{{ $pedido['produto']->nomeProduto }}</td>
                        <td>R$ {{ $pedido['preco_unitario'] }}</td>
                        <td>{{ $pedido['quantidade'] }}</td>
                        <td>
                            <button class="btn btn-danger remover-produto" data-index="{{ $index }}">Remover</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhum produto adicionado à mesa ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

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

            <p>Total dos Pedidos: R$ <span id="total-pedidos">{{ number_format($totalPedidos, 2, ',', '.') }}</span></p>
            <p>Taxa Garçom (10%): R$ <span id="taxa-garcom">{{ number_format($taxaGarcom, 2, ',', '.') }}</span></p>
            <p>Total com Taxa Garçom: R$ <span
                    id="total-com-taxa">{{ number_format($totalComTaxaGarcom, 2, ',', '.') }}</span></p>
        @endif

        <div id="mensagem-remocao" class="alert alert-success" style="display: none;">
            Produto removido com sucesso.
        </div>

        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-success" id="btn-adicionar-produto" data-toggle="modal"
                    data-target="#modalFecharConta">Fechar Mesa</button>
                @include('dashboard.administrativo.mesa.fechar')


            </div>


        </div>



    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.remover-produto').click(function() {
    var index = $(this).data('index');
    var mesaId = {{ $mesa->id }};

    // Remover o produto da interface
    $(this).closest('tr').fadeOut();

    // Enviar uma solicitação POST para a rota de remoção de produto
    $.ajax({
        url: '{{ route('remover.produto') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            mesa_id: mesaId,
            index: index
        },
        success: function(response) {
            // Exibir a mensagem de remoção
            $('#mensagem-remocao').fadeIn();

            // Ocultar a mensagem após 5 segundos (5000 milissegundos)
            setTimeout(function() {
                $('#mensagem-remocao').fadeOut();
            }, 5000); // Ocultar a mensagem após 5 segundos (5000 milissegundos)

            // Recarregar a página após a remoção do produto
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
        error: function(xhr, status, error) {
            // Exibir uma mensagem de erro, se necessário
            alert('Ocorreu um erro ao tentar remover o produto.');
        }
    });

    // Evitar que o evento de clique continue sua execução padrão
    return false;
});
    </script>




    @include('sweetalert::alert')

@endsection
