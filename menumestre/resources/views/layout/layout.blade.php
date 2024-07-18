<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href=" {{ asset('../assets/images/favicon.png') }}" type="">

    <title> Menu Mestre - Início </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/bootstrap.css ') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">




    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="{{ asset('../assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('../assets/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="  {{ asset('../assets/css/responsive.css') }}" rel="stylesheet" />

</head>


<body>
    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('../assets/images/site/prato.png') }}" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span>
                            Menu Mestre
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  mx-auto ">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/') }}">Início <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#menu">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#sobre">Sobre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contato">Contato</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- slider section -->
        <section class="slider_section">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="text-center" style="display: flex; justify-content: center;">
                                <div class="detail-box" style="width: 75%;">
                                    <h1>
                                        Bem-vindo ao Menu Mestre
                                    </h1>
                                    <p style="font-size: 20px; font-weight: 300; line-height: 33px;">
                                        Desfrute de uma experiência gastronômica única no Menu Mestre. Pratos feitos com os melhores ingredientes, preparados para surpreender seu paladar. Momentos inesquecíveis aguardam você.
                                    </p>
                                    <div class="btn-box">
                                        <a href="#menu" class="btn btn-primary">
                                            Conheça Nosso Menu
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- end slider section -->
    </div>

    <main>
        @yield('conteudo')
    </main>

    <button id="btnVoltarAoTopo" class="btn-voltar-ao-topo" title="Voltar ao Topo">
        <i class="fas fa-arrow-up"></i>
    </button>

    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-col">
                    <div class="footer_contact">
                        <h4>
                            Contate-nos
                        </h4>
                        <div class="contact_link_box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    Avenida Marechal Tito, 1500
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    +55 11 97127-9876
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    menumestre@gmail.com
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <div class="footer_detail">
                        <a href="" class="footer-logo">
                            Menu Mestre
                        </a>
                        <p>Obrigado por escolher o Menu Mestre. Aqui, combinamos tradição e inovação para oferecer uma experiência gastronômica única e inesquecível.</p>
                        <div class="footer_social">
                            <a href="https://www.facebook.com/" target="_blank">
                                <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
                            </a>
                            <a href="https://x.com/" target="_blank">
                                <i class="fa-brands fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.linkedin.com/" target="_blank">
                                <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.instagram.com/" target="_blank">
                                <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.pinterest.com" target="_blank">
                                <i class="fa-brands fa-pinterest" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <h4>
                        Horário De Funcionamento </h4>
                    <p>
                        Diariamente
                    </p>
                    <p>
                        10 horas - 22 horas
                    </p>
                </div>
            </div>
            <div class="footer-info">
                <p>
                    &copy; <span id="displayYear"></span> Todos os direitos reservados por
                    <a href="https://cybercompany.smpsistema.com.br/" target="_blank">Cyber Company</a>
                </p>
            </div>
        </div>
    </footer>
    <!-- footer section -->

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


    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQery -->
    <script src="{{ asset('../assets/js/jquery-3.4.1.min.js') }}"></script>
    <!-- Importe a biblioteca Axios para fazer requisições AJAX -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="{{ asset('../assets/js/bootstrap.js') }}"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="{{ asset('../assets/js/custom.js') }}"></script>

</body>
