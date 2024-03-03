@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('../assets/css/funcionario.css') }}">

    <div class="container-funcionario">
        <button onclick="window.location.href='/cadastro-funcionario'" class="btn btn-dark mb-3">Cadastrar Novo Funcionário</button>
        <div class="cont-funcionario">
            <div class="cont-gerentes">
                <h4>Gerentes</h4>
                <!-- Gerentes -->

                <div class="gerentes-card">

                    @foreach($administradores as $administrador)
                    <div class="card-container">
                        <div class="card-geral">
                             <a href="" class="funcionario-link">
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
                    <div class="card-container">

                        <div class="card-geral">
                            <a href="" class="funcionario-link">
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



@endsection
