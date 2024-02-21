@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

    <!-- Início do conteúdo HTML -->
    <div class="container">

        <!-- Botões de filtro -->
        <div class="filtro-btn" id="botoes-filtro">
            <button id="filtro-btn-todos" class="filtro-ativo" onclick="filtrar('todos')" title="Todos">
                <i class="ri-file-list-3-fill"></i>
                <span>Todos</span>
            </button>
            <button id="filtro-btn-comida" onclick="filtrar('comida')" title="Comida">
                <i class="ri-restaurant-2-fill"></i>
                <span>Comida</span>
            </button>
            <button id="filtro-btn-bebida" onclick="filtrar('bebida')" title="Bebida">
                <i class="ri-goblet-fill"></i>
                <span>Bebida</span>
            </button>
            <button id="filtro-btn-sobremesa" onclick="filtrar('sobremesa')" title="Sobremesa">
                <i class="ri-cake-3-fill"></i>
                <span>Sobremesa</span>
            </button>
        </div>

        <!-- Container dos cards de produtos -->
        <div class="card-container" id="card-container">
            <!-- Card para adicionar novo prato -->
            <div class="card card-edit" onclick="window.location.href='index.php?p=cardapio&c=inserir'">
                <a href="index.php?p=cardapio&c=inserir">
                    <div>
                        <span><i class="ri-add-line"></i></span>
                        <span>Adicionar novo prato</span>
                    </div>
                </a>
            </div>

            <!-- Loop para exibir os cards de produtos -->

            @php
                $maxId = App\Models\Cardapio::max('idProduto');
            @endphp

            @foreach ($cardapio as $item)
                <div class="card card-show" data-categoria="{{ $item->categoriaProduto }}">

                    @if (empty($item['statusProduto']) || strtolower($item['statusProduto']) == 'inativo')
                        <!-- Botão de ativação/desativação -->
                        <div class="card-desativado">
                            <a class="card-desativado-btn" title="Desativado (Clique para ativar)" 
                                href="{{ route('ativar.produto', ['idProduto' => $item->idProduto]) }}">
                                <i class="ri-eye-off-line"></i>
                            </a>
                        </div>
                    @endif


                    <!-- Informações do produto -->
                    <div class="card-info">

                        @if ($item->idProduto == $maxId)
                            <span class="card-new-item">Novo!</span>
                        @endif

                        <a class="card-ativo-btn" title="Ativo (Clique para desativar)"
                            href="{{ route('dashboard.administrativo.cardapio.desativar', ['idProduto' => $item->idProduto]) }}"><i
                                class="ri-eye-line""></i></a></td>
                        <img src="{{ asset('../assets/images/cardapio/' . $item->fotoProduto) }}">
                        <h3>{{ $item->nomeProduto }}</h3>
                        <p>{{ $item->descricaoProduto }}</p>
                        <span class="card-price">R${{ $item->valorProduto }}</span>
                    </div>

                    <!-- Botão de edição -->
                    <div class="card-edit-btn" onclick="window.location.href='index.php?p=cardapio&c=atualizar&id=';">
                        <a title="Editar Cardápio" href="">
                            <span><i class="ri-edit-2-line"></i></span>
                            <span>Editar</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
