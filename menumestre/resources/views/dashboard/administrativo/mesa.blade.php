@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

    <!-- Inclui os estilos CSS -->
    <link rel="stylesheet" href="{{ asset('../assets/css/mesa.css') }}">

    <!-- Início do conteúdo HTML -->
    <div class="container">

        <!-- Botões de filtro -->
        <div class="filtro-btn" id="botoes-filtro">
            <button id="filtro-btn-disponivel" class="filtro-ativo" onclick="filtrar('disponivel')" title="Disponível">
                <i class="ri-checkbox-circle-fill"></i>
                <span>Disponível</span>
            </button>
            <button id="filtro-btn-ocupada" onclick="filtrar('ocupada')" title="Ocupada">
                <i class="ri-git-repository-private-fill"></i>
                <span>Ocupada</span>
            </button>
            <button id="filtro-btn-reservada" onclick="filtrar('reservada')" title="Reservada">
                <i class="ri-time-fill"></i>
                <span>Reservada</span>
            </button>
        </div>



        <!-- Container dos cards de produtos -->
        <div class="card-container" id="card-container">
            <!-- Card para adicionar novo prato -->
            <div class="card card-edit" onclick="">
                <a href="">
                    <div>
                        <span><i class="ri-add-line"></i></span>
                        <span>Adicionar mesa</span>
                    </div>
                </a>
            </div>

            <!-- Loop para exibir os cards de produtos -->

            {{-- // Obtém o ID mais alto da lista --}}
            {{-- $maxId = max(array_column($listar, 'idProduto')); --}}

            {{-- // Loop através dos produtos --}}

            @foreach ($mesas as $mesa)
            <div class="card card-show" data-categoria="">

                <!-- Botão de ativação/desativação -->
                {{-- <div class="card-desativado">
                    <a class="card-desativado-btn" title="Desativado (Clique para ativar)" href="index.php?p=cardapio&c=ativar&id=">
                        <i class="ri-eye-off-line"></i>
                    </a>
                </div> --}}


                <!-- Informações do produto -->
                {{-- <div class="card-info" onclick="window.location.href='';">
                    <div class="card-stats">
                    <span>Disponivel</span><i class="ri-checkbox-circle-fill"></i>
                    </div>
                    <img src="{{ asset('../assets//images/icones/mesa.png') }}" alt="Mesa">
                    <h3>Mesa 1</h3>
                    <p>Capacidade: 4</p>
                    <div class="card-price-pessoas">
                        <span class="card-price">R$150.00</span>
                        <span class="card-pessoas"><p>2</p><i class="ri-group-fill"></i></span>
                    </div>
                </div> --}}


                    <div class="card-info" onclick="window.location.href='';">
                        <div class="card-stats">
                            <span>{{ ucwords($mesa->status) }}</span><i class="ri-checkbox-circle-fill"></i>
                        </div>
                        <img src="{{ asset('../assets//images/icones/mesa.png') }}" alt="Mesa">
                        <h3>Mesa {{ $mesa->numero_mesa }}</h3>
                        <p>Capacidade: {{ $mesa->capacidade }}</p>
                        <div class="card-price-pessoas">
                            <span class="card-price">R${{ $mesa->preco }}</span>
                            <span class="card-pessoas">
                                <p>{{ $mesa->capacidade }}</p>
                                <i class="ri-group-fill"></i>
                            </span>
                        </div>
                    </div>


                <!-- Botão de edição -->
                <!-- <div class="card-edit-btn" onclick="window.location.href='index.php?p=cardapio&c=atualizar&id=<?php ?>';">
                        <a title="Editar Cardápio" href="index.php?p=cardapio&c=atualizar&id=<?php ?>">
                            <span><i class="ri-edit-2-line"></i></span>
                            <span>Mesa 01</span>
                        </a>
                    </div> -->
            </div>
            @endforeach
        </div>
    </div>


@endsection
