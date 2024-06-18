



 <link rel="stylesheet" href="{{ asset('../assets/css/mesaadicionar.css') }}">



<!-- Modal para Adicionar Produtos -->
<div class="modal fade" id="AdicionarProduto{{ $mesa->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalAdicionarProdutoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarProdutoLabel">Adicionar Produtos à Mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Filtro por Categoria -->
                <div class="form-group">
                    <label for="categoria">Filtrar por Categoria:</label>
                    <select class="form-control" id="categoria" name="categoria">
                        <option value="todos">Todos</option>
                        <option value="massa">Massa</option>
                        <option value="comida">Comida</option>
                        <option value="sobremesa">Sobremesa</option>
                        <option value="bebida">Bebida</option>
                    </select>
                </div>

                <!-- Listagem de Produtos -->
<div class="row" id="listaProdutos">
    @php
        // Agrupar os produtos por categoria
        $categorias = [];
        foreach ($cardapio as $item) {
            $categorias[$item->categoriaProduto][] = $item;
        }

        // Definir a ordem de exibição das categorias
        $ordemCategorias = ['comida', 'massa', 'bebida', 'sobremesa'];
    @endphp

    <!-- Exibir produtos na ordem desejada -->
    @foreach ($ordemCategorias as $categoria)
        @if (isset($categorias[$categoria]))
            @foreach ($categorias[$categoria] as $produto)
                @php
                    // Definir a cor do botão com base na categoria
                    switch ($categoria) {
                        case 'comida':
                            $cor = '#A9ED4A';
                            break;
                        case 'massa':
                            $cor = '#dbd70096';
                            break;
                        case 'bebida':
                            $cor = '#009ddb96';
                            break;
                        case 'sobremesa':
                            $cor = '#db000096';
                            break;
                        default:
                            $cor = 'rgba(0, 0, 0, 0.5)'; // Preto como padrão
                    }
                @endphp
                <div class="col-md-3 mb-3 produto-card categoria-{{ strtolower($categoria) }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produto->nomeProduto }}</h5>
                            <img src="{{ asset('../assets/images/cardapio/'. $produto['fotoProduto']) }}" style="border: 4px solid{{ $cor }}; width: 130px; height: 130px; border-radius: 50%; margin-bottom: 20px; " >
                            <p class="card-text">{{ $produto->descricaoProduto }}</p>
                            <p class="card-text" style="text-align: center; font-weight: bold; color: black;">R$ {{ $produto->valorProduto }}</p>
                            <div class="form-group2">
                                <label for="quantidade{{ $produto->idProduto }}">Quantidade:</label>
                                <input type="number" class="form-control2"
                                       id="quantidade{{ $produto->idProduto }}" min="1" value="1">
                            </div>
                            <button type="button" class="btn btn-block"
                                    style="background-color: {{ $cor }}; color: white;"
                                    onclick="adicionarProduto({{ $produto->idProduto }}, '{{ $produto->nomeProduto }}', {{ $produto->valorProduto }})">Adicionar</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
</div>


                <!-- Formulário para Submissão -->
                <form id="formAdicionarProdutos" action="{{ route('mesa.adicionar', ['id' => $mesa->id]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" id="mesa_id" name="mesa_id" value="{{ $mesa->id }}">

                    <!-- Lista de Produtos Selecionados -->
                    <div class="mt-4">
                        <h5>Produtos Selecionados:</h5>
                        <ul id="produtosSelecionados" class="list-group">
                            <!-- Lista de produtos selecionados será mostrada aqui -->
                        </ul>
                    </div>

                    <div class="modal-footer">
                        <div class="col">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                        <button type="submit" class="btn btn-success">Adicionar à Mesa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Script para Filtrar Produtos por Categoria -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categoria').change(function() {
            var categoriaSelecionada = $(this).val().toLowerCase();

            // Mostrar todos os produtos se "todos" for selecionado
            if (categoriaSelecionada === 'todos') {
                $('.produto-card').show();
            } else {
                // Mostrar/esconder os produtos conforme a categoria selecionada
                $('.produto-card').each(function() {
                    if ($(this).hasClass(`categoria-${categoriaSelecionada}`)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    });

    // Função para adicionar produto à lista de selecionados
    // Função para adicionar produto à lista de selecionados
    function adicionarProduto(idProduto, nomeProduto, precoProduto) {
        var quantidade = $(`#quantidade${idProduto}`).val();
        var total = (precoProduto * quantidade).toFixed(2);

        // Evitar adicionar o mesmo produto mais de uma vez
        if ($(`#produto-${idProduto}`).length === 0) {
            var itemHtml = `
            <li class="list-group-item" id="produto-${idProduto}">
                ${nomeProduto} - Quantidade: ${quantidade} - Total: R$ ${total}
                <button type="button" class="btn btn-sm btn-outline-danger float-right" onclick="removerProduto(${idProduto})">Remover</button>
                <input type="hidden" name="produtos[${idProduto}][id]" value="${idProduto}">
                <input type="hidden" name="produtos[${idProduto}][quantidade]" value="${quantidade}">
            </li>`;
            $('#produtosSelecionados').append(itemHtml);
        } else {
            // Atualizar a quantidade e o total se o produto já estiver na lista
            var item = $(`#produto-${idProduto}`);
            item.find('input[name="produtos[${idProduto}][quantidade]"]').val(quantidade);
            item.html(`
            ${nomeProduto} - Quantidade: ${quantidade} - Total: R$ ${total}
            <button type="button" class="btn btn-sm btn-outline-danger float-right" onclick="removerProduto(${idProduto})">Remover</button>
            <input type="hidden" name="produtos[${idProduto}][id]" value="${idProduto}">
            <input type="hidden" name="produtos[${idProduto}][quantidade]" value="${quantidade}">
        `);
        }
    }

    // Função para remover produto da lista de selecionados
    function removerProduto(idProduto) {
        $(`#produto-${idProduto}`).remove();
    }
</script>
