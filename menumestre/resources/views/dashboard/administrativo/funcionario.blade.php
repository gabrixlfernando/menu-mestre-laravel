@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('../assets/css/funcionario.css') }}">

    <div class="container-funcionario">
        <button type="button" class="btn btn-dark mb-3" data-toggle="modal" data-target="#createFuncionario">Cadastrar Novo Funcionário</button>
        @include('dashboard.administrativo.funcionario.create')
        <div class="cont-funcionario">
            <div class="cont-gerentes">
                <h4>Gerentes</h4>
                <!-- Gerentes -->

                <div class="gerentes-card">


                    @foreach($administradores as $administrador)
                    @include('dashboard.administrativo.funcionario.edit', ['idFuncionario' => $administrador->idFuncionario])
                    <div class="card-container">
                        <div class="card-geral">
                             <a href="" class="funcionario-link" data-toggle="modal" data-target="#editFuncionario{{ $administrador->idFuncionario }}">
                                <img src="{{ asset('../assets/images/funcionarios/' . $administrador->fotoFuncionario) }}" class="img-fluid" id="imagem{{$administrador->id}}">
                                <i class="ri-pencil-fill"></i>
                            </a>
                            <div class="card-info">
                                <h4>{{ $administrador->nomeFuncionario }}</h4>
                                <p>Função: <span>{{ ucwords($administrador->tipoFuncionario) }}</span></p>
                                <p>Status: <span>{{ ucwords($administrador->statusFuncionario) }}<strong></strong></span></p>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Atendentes -->
           <div class="cont-atendentes">
                <h4>Atendentes</h4>
                <div class="atendentes-card">

                    @foreach($atendentes as $atendente)
                    @include('dashboard.administrativo.funcionario.editfunc', ['idFuncionario' => $atendente->idFuncionario])
                    <div class="card-container">

                        <div class="card-geral">
                            <a href="" class="funcionario-link" data-toggle="modal" data-target="#editFuncionarioatd{{ $atendente->idFuncionario }}">
                                <img src="{{ asset('../assets/images/funcionarios/' . $atendente->fotoFuncionario) }}" class="img-fluid" id="imagem{{$atendente->id}}">
                                <i class="ri-pencil-fill"></i>
                            </a>
                            <div class="card-info">
                                <h4>{{ $atendente->nomeFuncionario }}</h4>
                                <p>Função: <span>{{ ucwords($atendente->tipoFuncionario) }}</span></p>
                                <p>Status: <span>{{ ucwords($atendente->statusFuncionario) }}</span></p>
                            </div>
                        </div>

                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')

@endsection
