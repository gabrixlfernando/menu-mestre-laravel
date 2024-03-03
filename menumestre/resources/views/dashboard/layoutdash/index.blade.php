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

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/bootstrap.css ') }}" />
    <link rel="stylesheet" href="{{ asset('../assets/css/home.css') }}">

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
                        <span class="perfil-cargo">{{ ucwords($funcionario->tipoFuncionario) }}</span>
                    </div>

                </div>
                <div class="header-link">
                    <a class="notification-link" href=""><i class="ri-notification-2-line"></i><div class="notification-ativo" title="Notificações">2</div></a>
                    <a class="btn btn-danger btn-sair" href="{{ route('sair') }}"><i
                            class="ri-logout-circle-r-line"></i>Sair</a>
                </div>

            </div>
        </header>
        <nav id="menu">
            <div class="navbar">
                <ul>

                    <li>
                        <a href="{{ url('/dashboard/administrativo') }}"><span class="nav-icon"><i
                                    class="ri-community-fill"></i></span><span class="nav-title">Home</span></a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/administrativo/mesa') }}"><span class="nav-icon"><i
                                    class="ri-calendar-todo-fill"></i></span><span class="nav-title">Mesas</span></a>
                    </li>

                    <li>
                        <a href="{{ url('/dashboard/administrativo/cardapio') }}">
                            <span class="nav-icon"><i class="ri-restaurant-line"></i></span>
                            <span class="nav-title">Cardápio</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('dashboard/administrativo/funcionario') }}"><span class="nav-icon"><i
                                    class="ri-shield-user-fill"></i></span><span
                                class="nav-title">Funcionários</span></a>
                    </li>
                    <li>
                        <a href="{{ url('dashboard/administrativo/contato') }}"><span class="nav-icon notification-message"><i class="ri-question-answer-fill"></i><div class="notification-ativo" title="Notificações">2</div></span><span
                                class="nav-title">Mensagens</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <main>
            @yield('conteudo')
        </main>
    </div>


    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Pacote de JavaScript do Bootstrap (inclui Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Importe a biblioteca Axios para fazer requisições AJAX -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!--js-->
    <script src="{{ asset('../assets/js/main.js') }}"></script>

</body>

</html>
