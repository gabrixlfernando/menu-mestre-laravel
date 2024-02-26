@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('../assets/css/funcionario.css') }}">

    <div class="container-funcionario">
        <div class="cont-funcionario">
            <div class="cont-gerentes">
                <h4>Gerentes</h4>
                <!-- Gerentes -->

                <div class="gerentes-card">

                    @foreach($administradores as $administrador)
                    <div class="card-container">
                        <div class="card-geral">
                            <img src="{{ asset('../assets/images/funcionarios/' . $administrador->fotoFuncionario) }}">
                            <div class="card-info">
                                <h4>{{ $administrador->tipoFuncionario }}</h4>
                                <p>Função: <span>{{ $administrador->tipoFuncionario }}</span></p>
                                <p>Status: <span>{{ $administrador->statusFuncionario }}<strong></strong></span></p>
                            </div>
                        </div>
                        <!-- <div class="card-botao">
                            <span><a href="#" title="Editar informações"><i class="ri-pencil-fill"></i></a></span>
                        </div>       -->
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
                            <img src="{{ asset('../assets/images/funcionarios/' . $atendente->fotoFuncionario) }}">
                            <div class="card-info">
                                <h4>{{ $atendente->tipoFuncionario }}</h4>
                                <p>Função: <span>{{ $atendente->tipoFuncionario }}</span></p>
                                <p>Status: <span>{{ $atendente->statusFuncionario }}</span></p>
                            </div>
                        </div>

                        <!-- <div class="card-botao">
                            <span><a href="#" title="Editar informações"><i class="ri-pencil-fill"></i></a></span>
                        </div>      -->
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>



@endsection
