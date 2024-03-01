@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

    <!-- Inclui os estilos CSS -->
    <link rel="stylesheet" href="{{ asset('../assets/css/mesa.css') }}">

    <!-- Início do conteúdo HTML -->
    <div class="container">

        <!-- Botões de filtro -->

        <div class="filtro-btn" id="botoes-filtro">
            <button id="filtro-btn-todos" class="filtro-ativo" onclick="filtrar('todos')" data-status="todos" title="Todas">
                <i class="ri-bar-chart-2-line"></i>
                <span>Todas</span>
            </button>
            <button id="filtro-btn-disponivel" class="filtro-ativo" onclick="filtrar('disponivel')" title="Disponível"
                data-status="disponivel">
                <i class="ri-checkbox-circle-fill"></i>
                <span>Disponível</span>
            </button>
            <button id="filtro-btn-ocupada" onclick="filtrar('ocupada')" title="Ocupada" data-status="ocupada">
                <i class="ri-git-repository-private-fill"></i>
                <span>Ocupada</span>
            </button>
            <button id="filtro-btn-reservada" onclick="filtrar('reservada')" title="Reservada" data-status="reservada">
                <i class="ri-time-fill"></i>
                <span>Reservada</span>
            </button>
        </div>
    </div>

    @include('dashboard.administrativo.mesa.create')




    <!-- Container dos cards de produtos -->
    <div class="card-container" id="card-container">
        <!-- Card para adicionar novo prato -->
        <div class="card card-edit" data-toggle="modal" data-target="#createMesa">
            <a href="#" >
                <div>
                    <span><i class="ri-add-line"></i></span>
                    <span>Adicionar mesa</span>
                </div>
            </a>
        </div>
        @foreach ($mesas as $mesa)
        @include('dashboard.administrativo.mesa.edit', ['id' => $mesa->id])

            @php
                $statusColor = '';
                switch ($mesa->status) {
                    case 'disponivel':
                        $statusColor = 'var(--disponivel)';
                        break;
                    case 'ocupada':
                        $statusColor = 'var(--ocupada)';
                        break;
                    case 'reservada':
                        $statusColor = 'var(--reservada)';
                        break;
                    default:
                        $statusColor = 'var(--default-color)';
                        break;
                }
            @endphp
            <div class="card card-show" style="border: solid 1px {{ $statusColor }}" data-status="{{ $mesa->status }}">
                <!-- Verifica o status da mesa e define a cor de fundo com base nisso -->


                <div class="card-info" data-toggle="modal"
                data-target="#alterarMesaModal{{ $mesa->id }}">
                    <!-- Adiciona o estilo condicional ao campo card-stats -->
                    <div class="card-stats" style="background-color: {{ $statusColor }}">
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

            </div>
        @endforeach
    </div>
    </div>





@endsection
