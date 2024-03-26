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
            <button class="btn btn-warning" id="btn-adicionar-produto" data-toggle="modal" data-target="#AdicionarProduto">Adicionar Produto</button>
        </div>
        @include('dashboard.administrativo.mesa.adicionar')
    </div>

    <!-- Tabela para exibir os produtos pedidos -->
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
            <tr>
                <td>Nome</td>
                <td>R$</td>
                <td>Quantidade</td>
                <td>
                    <button class="btn btn-danger remover-produto">Remover</button>
                </td>
            </tr>
        </tbody>
    </table>


    <p>Total dos Pedidos: R$ <span id="total-pedidos">0</span></p>

   <div class="row">
    <div class="col-md-6">
        <button class="btn btn-success" id="btn-adicionar-produto"  data-toggle="modal" data-target="#modalFecharConta">Fechar Mesa</button>
        @include('dashboard.administrativo.mesa.fechar')
    </div>
   </div>

</div>







@include('sweetalert::alert')

@endsection
