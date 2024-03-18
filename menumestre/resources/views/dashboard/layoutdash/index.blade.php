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
                    <!-- Notificações -->
                    <div class="notification-link">
                        <i class="ri-notification-2-line"></i>
                        @if($naoLidas > 0)
                        <div class="notification-ativo" title="Notificações">

                                <span>{{ $naoLidas }}</span>

                        </div>
                        @endif
                        <!-- Dropdown de notificações -->
                        <div class="notification-dropdown" id="notificationDropdown">

                                <div class="notification-item">
                                    <a href="{{ url('dashboard/administrativo/contato') }}">
                                        @if($naoLidas > 0)
                                        <span>{{ $naoLidas }} {{ $naoLidas == '1' ? 'Mensagem': 'Mensagens'}} {{ $naoLidas == '1' ? 'nova': 'novas'}} </span>
                                        @else
                                        <span>Nenhuma mensagem nova</span>
                                        @endif
                                    </a>
                                </div>

                        </div>
                    </div>
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
                        <a href="{{ url('dashboard/administrativo/contato') }}">
                            <span class="nav-icon notification-message">
                                <i class="ri-question-answer-fill"></i>
                                @if($naoLidas > 0)
                                <div class="notification-ativo" title="Notificações">
                                    <span>{{ $naoLidas }}</span>
                                </div>
                                @endif
                            </span>
                            <span class="nav-title">Mensagens</span></a>
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

    <script>


    // Controle das notificações
    document.addEventListener("DOMContentLoaded", function() {
        var notificationLink = document.querySelector(".notification-link");
        var notificationDropdown = document.querySelector(".notification-dropdown");

        // Função para atualizar o conteúdo do dropdown
        function updateNotificationDropdown() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.count > 0) {
                            notificationDropdown.textContent = response.count + " Mensagens novas";
                        } else {
                            notificationDropdown.textContent = "Nenhuma mensagem nova";
                        }
                    } else {
                        console.error('Erro ao buscar as mensagens: ' + xhr.status);
                    }
                }
            };

            xhr.open('GET', '/notifications', true);
            xhr.send();
        }

        // Atualizar o conteúdo do dropdown ao passar o mouse sobre o ícone de sino
        notificationLink.addEventListener("mouseover", function() {
            // Atualizar o conteúdo do dropdown
            updateNotificationDropdown();

            // Exibir o dropdown
            notificationDropdown.classList.add("show");
        });

        // Ocultar o dropdown ao remover o mouse do ícone de sino
        notificationLink.addEventListener("mouseout", function() {
            notificationDropdown.classList.remove("show");
        });
    });
    </script>

     {{-- Vlibras --}}

     <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
          <div class="vw-plugin-top-wrapper"></div>
        </div>
      </div>
      <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
      <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
      </script>

</body>

</html>
