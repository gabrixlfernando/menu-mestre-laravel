@extends('layout.layout')

@section('title', 'Home')

@section('conteudo')

    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('../assets/images/hero-bg.jpg') }}" alt="">
        </div>

        <!-- slider section -->
        <section class="slider_section ">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-7 col-lg-6 ">
                                    <div class="detail-box">
                                        <h1>
                                            Restaurante fast food
                                        </h1>
                                        <p>
                                            Doloremque, itaque aperiam facilis rerum, comodi, temporibus sapiente ad
                                            mollitia laborum quam quisquam esse erro unde. Tempora ex doloremque, labore,
                                            sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                                        </p>
                                        <div class="btn-box">
                                            <a href="" class="btn1">
                                                Peça agora
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-7 col-lg-6 ">
                                    <div class="detail-box">
                                        <h1>
                                            Restaurante fast food
                                        </h1>
                                        <p>
                                            Doloremque, itaque aperiam facilis rerum, comodi, temporibus sapiente ad
                                            mollitia laborum quam quisquam esse erro unde. Tempora ex doloremque, labore,
                                            sunt repellat dolore, iste magni quos nihil ducimus libero ipsam. </p>
                                        <div class="btn-box">
                                            <a href="" class="btn1">
                                                Peça agora
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-7 col-lg-6 ">
                                    <div class="detail-box">
                                        <h1>
                                            Restaurante fast food
                                        </h1>
                                        <p>
                                            Doloremque, itaque aperiam facilis rerum, comodi, temporibus sapiente ad
                                            mollitia laborum quam quisquam esse erro unde. Tempora ex doloremque, labore,
                                            sunt repellat dolore, iste magni quos nihil ducimus libero ipsam. </p>
                                        <div class="btn-box">
                                            <a href="" class="btn1">
                                                Peça agora
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <ol class="carousel-indicators">
                        <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                        <li data-target="#customCarousel1" data-slide-to="1"></li>
                        <li data-target="#customCarousel1" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>

        </section>
        <!-- end slider section -->
    </div>

    <!-- offer section -->

    <section class="offer_section layout_padding-bottom">
        <div class="offer_container">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6  ">
                        <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('../assets/images/o1.jpg') }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Quintas-feiras saborosas
                                </h5>
                                <h6>
                                    <span>20%</span> Off
                                </h6>
                                <a href="">
                                    Peça agora<i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  ">
                        <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('../assets/images/o2.jpg') }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Dias de Pizza
                                </h5>
                                <h6>
                                    <span>15%</span> Off
                                </h6>
                                <a href="">
                                    Peça agora <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end offer section -->

    <!-- food section -->

    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Nosso cardápio
                </h2>
            </div>

            <ul class="filters_menu">
                <li class="active" data-filter="*">Tudo</li>
                <li data-filter=".burger">Hambúrguer</li>
                <li data-filter=".pizza">Pizza</li>
                <li data-filter=".pasta">Massa</li>
                <li data-filter=".fries">Fritas</li>
            </ul>

            <div class="filters-content">
                <div class="row grid">
                    <div class="col-sm-6 col-lg-4 all pizza">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f1.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Pizza Deliciosa </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $20
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all burger">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f2.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Hambúrguer Delicioso </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $15
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all pizza">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f3.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Pizza Deliciosa </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $17
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all pasta">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f4.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Massa Deliciosa </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $18
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all fries">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f5.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Batatas fritas </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $10
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all pizza">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f6.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Pizza Deliciosa </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $15
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all burger">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f7.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Hambúrguer Saboroso </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $12
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all burger">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f8.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Hambúrguer Saboroso </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $14
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 all pasta">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ asset('../assets/images/f9.png') }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Massa Deliciosa </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque </p>
                                    <div class="options">
                                        <h6>
                                            $10
                                        </h6>
                                        <a href="">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="">Veja mais</a>
            </div>
        </div>
    </section>

    <!-- end food section -->

    <!-- about section -->

    <section class="about_section layout_padding">
        <div class="container  ">

            <div class="row">
                <div class="col-md-6 ">
                    <div class="img-box">
                        <img src="{{ asset('../assets/images/about-img.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Nós somos Menu Mestre </h2>
                        </div>
                        <p>
                            Existem muitas variações de passagens de Lorem Ipsum disponíveis, mas a maioria sofreu
                            alterações
                            de alguma forma, por meio de humor injetado ou palavras aleatórias que não parecem nem um pouco
                            verossímeis. Se você
                            usar uma passagem de Lorem Ipsum, você precisa ter certeza de que não há nada embaraçoso
                            escondido
                            no meio do texto. Todos
                        </p>
                        <a href="">
                            consulte Mais informação </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- book section -->
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Entre Em Contato
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="">
                            <div>
                                <input type="text" class="form-control" placeholder="Seu Nome" />
                            </div>
                            <div>
                                <input type="text" class="form-control" placeholder="Telefone" />
                            </div>
                            <div>
                                <input type="email" class="form-control" placeholder="Seu Email" />
                            </div>
                            <div>
                                <select class="form-control nice-select wide">
                                    <option value="" disabled selected>
                                        Quantas pessoas? </option>
                                    <option value="">
                                        2
                                    </option>
                                    <option value="">
                                        3
                                    </option>
                                    <option value="">
                                        4
                                    </option>
                                    <option value="">
                                        5
                                    </option>
                                </select>
                            </div>
                            <div>
                                <input type="date" class="form-control">
                            </div>
                            <div class="btn_box">
                                <button type="submit">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map_container ">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end book section -->

    <!-- client section -->

    <section class="client_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center psudo_white_primary mb_45">
                <h2>
                    O que dizem nossos clientes </h2>
            </div>
            <div class="carousel-wrap row ">
                <div class="owl-carousel client_owl-carousel">
                    <div class="item">
                        <div class="box">
                            <div class="detail-box">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidente
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                <h6>
                                    Moana Michell
                                </h6>
                                <p>
                                    magna aliqua
                                </p>
                            </div>
                            <div class="img-box">
                                <img src="{{ asset('../assets/images/client1.jpg') }}" alt="" class="box-img">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box">
                            <div class="detail-box">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                </p>
                                <h6>
                                    Mike Hamell
                                </h6>
                                <p>
                                    magna aliqua
                                </p>
                            </div>
                            <div class="img-box">
                                <img src="{{ asset('../assets/images/client2.jpg') }}" alt="" class="box-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end client section -->

@endsection
