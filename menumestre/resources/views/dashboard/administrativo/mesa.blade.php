@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

    <!-- Inclui os estilos CSS -->
    <link rel="stylesheet" href="{{ asset('../assets/css/mesa.css') }}">

    <!-- Início do conteúdo HTML -->
    <div class="container">

<<<<<<< HEAD
       <!-- Botões de filtro -->
<div class="filtro-btn-mesa" id="botoes-filtro">
    <button id="filtro-btn-todos" class="filtro-ativo" data-status="todos" title="Todos">
        <i class="ri-bar-chart-2-line"></i>
        <span>Todos</span>
    </button>
    <button id="filtro-btn-disponivel" data-status="disponivel" title="Disponível">
        <i class="ri-checkbox-circle-fill"></i>
        <span>Disponível</span>
    </button>
    <button id="filtro-btn-ocupada" data-status="ocupada" title="Ocupada">
        <i class="ri-git-repository-private-fill"></i>
        <span>Ocupada</span>
    </button>
    <button id="filtro-btn-reservada" data-status="reservada" title="Reservada">
        <i class="ri-time-fill"></i>
        <span>Reservada</span>
    </button>
</div>
=======
        <!-- Botões de filtro -->
        <div class="filtro-btn-mesa" id="botoes-filtro">
            <button id="filtro-btn-todos" class="filtro-ativo" data-status="todos" title="Todos">
                <i class="ri-bar-chart-2-line"></i>
                <span>Todos</span>
            </button>
            <button id="filtro-btn-disponivel" data-status="disponivel" title="Disponível">
                <i class="ri-checkbox-circle-fill"></i>
                <span>Disponível</span>
            </button>
            <button id="filtro-btn-ocupada" data-status="ocupada" title="Ocupada">
                <i class="ri-git-repository-private-fill"></i>
                <span>Ocupada</span>
            </button>
            <button id="filtro-btn-reservada" data-status="reservada" title="Reservada">
                <i class="ri-time-fill"></i>
                <span>Reservada</span>
            </button>
        </div>
>>>>>>> 327f379451dae3f34bb514e0486a7b3e6438555e
    </div>

    @include('dashboard.administrativo.mesa.create')




    <!-- Container dos cards de produtos -->
    <div class="card-container" id="card-container">
        <!-- Card para adicionar novo prato -->
        <div class="card card-edit" data-toggle="modal" data-target="#createMesa">
            <a href="#">
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
                @if (empty($mesa['status']) || strtolower($mesa['status']) == 'inativo')
                    <!-- Botão de ativação/desativação -->
                    <div class="card-desativado">
                        <a class="card-desativado-btn" title="Desativado (Clique para ativar)"
                            href="{{ route('mesa.ativar', ['id' => $mesa->id]) }}">
                            <i class="ri-eye-off-line"></i>
                        </a>
                    </div>
                @endif

                <div class="card-info" data-toggle="modal" data-target="#alterarMesaModal{{ $mesa->id }}">

                    <!-- Adiciona o estilo condicional ao campo card-stats -->
                    <div class="card-stats" style="background-color: {{ $statusColor }}">
                        <span>{{ ucwords($mesa->status) }}</span>
                        @if ($mesa->status === 'disponivel')
                            <i class="ri-checkbox-circle-fill"></i>
                        @elseif ($mesa->status === 'reservada')
                            <i class="ri-time-fill"></i>
                        @elseif ($mesa->status === 'ocupada')
                            <i class="ri-git-repository-private-fill"></i>
                        @endif
                    </div>
                    <img src="{{ asset('../assets//images/icones/mesa.png') }}" alt="Mesa">
                    <h3>Mesa {{ $mesa->numero_mesa }}</h3>
                    <p>Capacidade: {{ $mesa->capacidade }}</p>
<<<<<<< HEAD

                    @if ($mesa->status !== 'disponivel')
                    <div class="card-price-pessoas">
                        <span class="card-price">R${{ $mesa->preco }}</span>
                        <span class="card-pessoas">
                            <p>{{ $mesa->capacidade }}</p>
                            <i class="ri-group-fill"></i>
                        </span>
                    </div>

=======

                    @if ($mesa->status !== 'disponivel')
                        <div class="card-price-pessoas">
                            <span class="card-price">R${{ $mesa->preco }}</span>
                            <span class="card-pessoas">
                                <p>{{ $mesa->capacidade }}</p>
                                <i class="ri-group-fill"></i>
                            </span>
                        </div>
>>>>>>> 327f379451dae3f34bb514e0486a7b3e6438555e
                    @endif

                </div>
                <a class="card-ativo-btn" title="Ativo (Clique para desativar)"
<<<<<<< HEAD
                href="{{ route('mesa.desativar', ['id' => $mesa->id]) }}"><i class="ri-eye-line"></i></a>
=======
                    href="{{ route('mesa.desativar', ['id' => $mesa->id]) }}"><i class="ri-eye-line"></i></a>
>>>>>>> 327f379451dae3f34bb514e0486a7b3e6438555e
            </div>


        @endforeach
    </div>
    </div>

<<<<<<< HEAD


=======
>>>>>>> 327f379451dae3f34bb514e0486a7b3e6438555e
    @include('sweetalert::alert')

@endsection
