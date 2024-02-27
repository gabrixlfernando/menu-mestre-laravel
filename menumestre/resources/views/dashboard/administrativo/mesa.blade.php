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
            @foreach ($mesas as $mesa)
            <div class="card card-show" data-categoria="">
                    <div class="card-info" data-toggle="modal" data-target="#alterarMesaModal">
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
            </div>
            @endforeach
        </div>
    </div>



    <div class="modal fade" id="alterarMesaModal" tabindex="-1" role="dialog" aria-labelledby="alterarMesaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="alterarMesaModalLabel">Alterar Mesa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="formAlterarMesa">
                <input type="hidden" id="mesaId">
                <div class="form-group">
                  <label for="statusMesa">Status da Mesa: </label>
                  <select class="form-control" id="statusMesa">
                    <option value="disponivel">Disponível</option>
                    <option value="ocupada">Ocupada</option>
                    <option value="reservada">Reservada</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="capacidadeMesa">Capacidade da Mesa:</label>
                  <input type="number" class="form-control" id="capacidadeMesa" min="1">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="salvarAlteracoes()">Salvar Alterações</button>
            </div>
          </div>
        </div>
      </div>


@endsection
