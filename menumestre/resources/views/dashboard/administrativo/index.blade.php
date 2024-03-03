@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')


<div class="home-container">
    <!-- Container das estatísticas -->
    <div class="home-estatisticas">
        <!-- Cabeçalho com o nome do funcionário e a data atual -->
        <div class="cabecalho-container">
            <h2>Olá, {{ $funcionario -> nomeFuncionario }}</h2>
            <p id="data-atual"></p>
        </div>
        <!-- Container das estatísticas -->
        <div class="estatisticas-container">
            <!-- Estatísticas de clientes -->
            <div class="estatisticas">
                <div class="estatisticas-info">
                    <h4>22</h4>
                    <span>Clientes</span>
                    <p>Clientes registrados.</p>
                </div>
                <div class="estatisticas-icon"  style="background-color: rgba(226, 208, 45, 0.568);">
                    <i class="ri-user-smile-fill"  style="color: rgb(226, 208, 45);"></i>
                </div>
            </div>
            <!-- Estatísticas de pedidos -->
            <div class="estatisticas">
                <div class="estatisticas-info">
                    <h4>10</h4>
                    <span>Pedidos</span>
                    <p>Pedidos realizados.</p>
                </div>
                <div class="estatisticas-icon" style="background-color: rgba(45, 169, 226, 0.568);">
                    <i class="ri-file-list-3-fill" style="color: rgb(45, 169, 226);"></i>
                </div>
            </div>
         <!-- Estatísticas de funcionários -->
         <div class="estatisticas">
            <div class="estatisticas-info">
                <h4>{{ $totalFuncionarios }}</h4>
                <span>Funcionários</span>
                <p>Funcionários registrados.</p>
            </div>
            <div class="estatisticas-icon" style="background-color: rgba(179, 8, 8, 0.568)">
                <i class="ri-user-2-fill" style="color: rgb(179, 8, 8);"></i>
            </div>
        </div>
        <!-- Estatísticas de vendas -->
        <div class="estatisticas">
            <div class="estatisticas-info">
                <h4>R$ 400</h4>
                <span>Vendas Totais</span>
                <p>Vendas totais realizadas.</p>
            </div>
            <div class="estatisticas-icon" style="background-color: rgba(61, 236, 38, 0.568);">
                <i class="ri-money-dollar-circle-fill" style="color: rgb(61, 236, 38);"></i>
            </div>
        </div>
            <!-- Estatísticas de pratos -->
            <div class="estatisticas">
                <img src="{{ asset('../assets//images/icones/mesa.png') }}" alt="">
                <div class="estatisticas-info">
                    <h4>{{ $totalMesas }}</h4>
                    <span>Mesas</span>
                    <p>Mesas disponíveis.</p>
                    <a href="{{ url('/dashboard/administrativo/mesa')}}">Acessar</a>

                </div>
            </div>

            <!-- Estatísticas de pratos -->
            <div class="estatisticas">
                <img src="{{ asset('../assets//images/icones/burguer.png') }}" alt="">
                <div class="estatisticas-info">
                    <h4>{{ $totalPratos }}</h4>
                    <span>Pratos</span>
                    <p>Itens registrados.</p>
                        <a href="{{ url('/dashboard/administrativo/cardapio')}}">Acessar</a>
                </div>                <!-- Condição que verifica se o funcionário é Atendente -->
            </div>
               
            </div>
        </div>
    </div>
    <!-- Container dos pedidos (aqui você pode adicionar conteúdo relacionado aos pedidos, se necessário) -->
    <div class="home-pedidos">
        <div class="teste2">

        </div>
    </div>

</div>


@endsection
