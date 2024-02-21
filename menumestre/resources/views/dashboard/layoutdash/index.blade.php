<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Menu Mestre | Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('../assets//images/dashboard/logo.png') }}" type="image/x-icon">


    <!--ICONES-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css"
        integrity="sha512-HXXR0l2yMwHDrDyxJbrMD9eLvPe3z3qL3PPeozNTsiHJEENxx8DH2CxmV05iwG0dwoz5n4gQZQyYLUNt1Wdgfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Sweet Alert -->

    <!-- Inclua os arquivos CSS do SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Inclua os arquivos JavaScript do SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.6/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.6/dist/sweetalert2.min.css"> --}}

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/bootstrap.css ') }}" />

    <link rel="stylesheet" href="{{ asset('../assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('../assets/css/cardapio.css') }}">

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('../assets/css/dashboard.css') }}">



</head>

<body>

    <div class="grid-container">
        <header>
            <img class="logo" src="{{ asset('../assets//images/logo/MM-Logo-dark.svg') }}" alt="">
            <div>
                <div class="perfil-info">
                    <div class="funcionario-img">
                        <img class=""
                            src="{{ asset('../assets/images/funcionarios/' . $funcionario->fotoFuncionario) }}">
                        <span title="Ativo!"></span>
                    </div>
                    <div class="perfil-title">
                        <span class="perfil-nome">{{ $funcionario->nomeFuncionario }}</span>
                        <span class="perfil-cargo">{{ $funcionario->tipoFuncionario }}</span>
                    </div>
                </div>

                <a class="btn btn-danger" href="{{ route('sair') }}"><i class="ri-logout-circle-r-line"></i>Sair</a>

            </div>
        </header>
        <nav id="menu">
            <div class="navbar">
                <ul>

                    <li><a href="{{ url('/dashboard/administrativo') }}"><span class="nav-icon"><i
                                    class="ri-home-3-line"></i></span><span class="nav-title">Dashboard</span></a></li>
                    <li><a href="{{ url('/dashboard/administrativo/cardapio') }}"><span class="nav-icon"><i
                                    class="ri-notification-3-line"></i></span><span class="nav-title">Pedidos</span></a>
                    </li>

                    <!-- Verificação se é Gerente ou Chef de Cozinha -->

                    {{-- <li class="acesso-negado" >
                            <a href="#" onclick="acessoNegado(); return false;">
                                <span class="nav-icon"><i class="ri-restaurant-line"></i></span>
                                <span class="nav-title">Cardápio</span>
                            </a><span class="lock"><i class="ri-lock-line"></i></span>
                        </li> --}}

                    <li>
                        <a href="{{ url('/dashboard/administrativo/cardapio') }}">
                            <span class="nav-icon"><i class="ri-restaurant-line"></i></span>
                            <span class="nav-title">Cardápio</span>
                        </a>
                    </li>


                    {{-- < <li><a href="index.php?p=funcionario"><span class="nav-icon"><i class="ri-shake-hands-line"></i></span><span class="nav-title">Funcionários</span></a>
                    <li><a href="index.php?p=configuracao"><span class="nav-icon"><i class="ri-settings-2-line"></i></span><span class="nav-title">Configurações</span></a>
                    <li><a href="index.php?p=perfil"><span class="nav-icon"><i class="ri-user-line"></i></span><span class="nav-title">Perfil</span></a></li>   --}}

                    </li>
                </ul>
            </div>
        </nav>

        <main>
            @yield('conteudo')
        </main>
    </div>



    <!--js-->

    <script src="{{ asset('../assets/js/main.js') }}"></script>

</body>

</html>
