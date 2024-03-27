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
                    data-target="#AdicionarProduto{{ $mesa->id}}">Adicionar Produto</button>
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
                @if (session('produtos'))
                    @foreach (session('produtos') as $pedido)
                        <tr>
                            <td>{{ $pedido['produto']->nomeProduto }}</td>
                            <td>R$ {{ $pedido['preco_unitario'] }}</td>
                            <td>{{ $pedido['quantidade'] }}</td>
                            <td>
                                <button class="btn btn-danger remover-produto">Remover</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Nenhum produto adicionado à mesa ainda.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        @if (session('produtos'))
            <p>Total dos Pedidos: R$ <span id="total-pedidos">
                    @php
                        $totalPedidos = 0;
                        foreach (session('produtos') as $pedido) {
                            $totalPedidos += $pedido['total_item'];
                        }
                        echo $totalPedidos;
                    @endphp
                </span></p>
        @endif

        <p>Taxa Garçom: 10% </p>

        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-success" id="btn-adicionar-produto" data-toggle="modal"
                    data-target="#modalFecharConta">Fechar Mesa</button>
                @include('dashboard.administrativo.mesa.fechar')
            </div>
        </div>

    </div>







    @include('sweetalert::alert')

@endsection
