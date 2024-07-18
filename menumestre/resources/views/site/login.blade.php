<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Mestre | Login</title>
    <!--ICONES-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" integrity="sha512-HXXR0l2yMwHDrDyxJbrMD9eLvPe3z3qL3PPeozNTsiHJEENxx8DH2CxmV05iwG0dwoz5n4gQZQyYLUNt1Wdgfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('../assets/css/login.css ')}}">
    <link rel="shortcut icon" href="{{ asset('../assets/images/dashboard/logo.png') }}" type="image/x-icon">

</head>

<body>
    <main>

        <div class="container">
            <div class="form-img">
                <div>
                    <img class="logo" src="{{ asset('../assets/images/logo/MM-Logo-white.svg') }}" alt="Menu Mestre" width="50px">
                    <p>
                    Esta página de login é o portal de acesso exclusivo do nosso restaurante
                    virtual. Ao entrar, você terá total controle sobre o cardápio, permitindo
                    personalizar e atualizar os pratos para refletir o melhor que temos a oferecer.
                    </p>
                </div>
                <div>
                    <img class="hamburguer-img" src="{{ asset('../assets/images/login/bandeja.png') }}" alt="Hamburguer">
                </div>
                {{-- <img class="bola-icon" src="{{ asset('../assets/images/login/bola-icon.png') }}" alt="Pattern"> --}}
            </div>

            <div class="form-content">
                <div class="form-title">
                    <div>
                        <a href="{{ route('sair') }}" title="Voltar ao site"><i class="ri-arrow-left-circle-line"></i></a>
                    </div>
                    <div>
                        <h2>Login</h2>
                    </div>
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="inputs">
                        <div>
                            <i class="ri-mail-fill"></i>
                            <input type="email" name="email" required placeholder="Informe seu E-mail: " value="{{ old('email') }}">
                            {{ $errors->has('email') ? $errors->first('email') : '' }}
                        </div>
                        <div>
                            <i class="ri-lock-fill"></i>
                            <input type="password" name="password" placeholder="Informe sua Senha: " value="{{ old('password') }}">
                            {{ $errors->has('password') ? $errors->first('password') : '' }}
                        </div>
                        <div>
                            <input class="formBtn" type="submit" idform="formLogin" value="Entrar">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>


</body>

</html>
