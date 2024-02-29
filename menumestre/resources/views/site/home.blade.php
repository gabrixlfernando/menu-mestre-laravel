@extends('layout.layout')

@section('title', 'Home')

@section('conteudo')





    <!-- offer section -->

    <section class="offer_section layout_padding-bottom" id="menu">
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

    <!-- cardapio section -->

    {{-- <section class="food_section layout_padding-bottom">
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
                                            RR$20
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
                                            R$15
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
                                            R$17
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
                                            R$18
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
                                            R$10
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
                                            R$15
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
                                            R$12
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
                                            R$14
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
                                            R$10
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
        </div>
    </section> --}}

    <section id="our_menu" class="pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="page_title text-center mb-4">
						<h1>Nosso Menu</h1>
						<div class="single_line"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<ul class="nav nav-tabs menu_tab mb-4" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="breakfast-tab" data-toggle="tab" href="#breakfast" role="tab">Pratos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="lunch-tab" data-toggle="tab" href="#lunch" role="tab">Massas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="dinner-tab" data-toggle="tab" href="#dinner" role="tab">Bebidas</a>
					</li>
          <li class="nav-item">
						<a class="nav-link" id="dinner-tab" data-toggle="tab" href="#dinner" role="tab">Sobremesas</a>
					</li>
				</ul>
        	</div>
			<div class="row">
				<div class="tab-content col-lg-12" id="myTabContent">
					<div class="tab-pane fade show active" id="breakfast" role="tabpanel" aria-labelledby="breakfast-tab">
						<div class="row">
							<div class="col-md-6">
								<div class="single_menu">
									<img src="{{ asset('../assets/images/chinese.jpeg') }}" alt="burger">
									<div class="menu_content">
										<h4>Chicken Burger  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/prato1.jpeg') }}" alt="black coffee">
									<div class="menu_content">
										<h4>Black coffee <span>R$20</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/Hambúrguer.jpeg') }}" alt="fried rice">
									<div class="menu_content">
										<h4>Fried Rice  <span>R$45</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/prato2.jpeg') }}" alt="meat">
									<div class="menu_content">
										<h4>meat  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="single_menu">
									<img src="{{ asset('../assets/images/prato3.jpeg') }}" alt="burger">
									<div class="menu_content">
										<h4>Chicken Burger  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/prato4.jpeg') }}" alt="black coffee">
									<div class="menu_content">
										<h4>Black coffee <span>R$20</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/prato5.jpeg') }}" alt="fried rice">
									<div class="menu_content">
										<h4>Fried Rice  <span>R$45</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/prato6.jpeg') }}" alt="meat">
									<div class="menu_content">
										<h4>meat  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="lunch" role="tabpanel" aria-labelledby="lunch-tab">
						<div class="row">
							<div class="col-md-6">
								<div class="single_menu">
									<img src="{{ asset('../assets/images/prato6.jpeg') }}" alt="pizza">
									<div class="menu_content">
										<h4>12" Pizza  <span>R$35</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/massa1.jpeg') }}" alt="salad">
									<div class="menu_content">
										<h4>Salad <span>R$20</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/massa2.jpeg') }}" alt="green tea">
									<div class="menu_content">
										<h4>green tea <span>R$15</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/massa3.jpeg') }}" alt="meat">
									<div class="menu_content">
										<h4>meat  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="single_menu">
									<img src="{{ asset('../assets/images/messa4.jpeg') }}" alt="burger">
									<div class="menu_content">
										<h4>Chicken Burger  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/massa5.jpeg') }}" alt="black coffee">
									<div class="menu_content">
										<h4>Black coffee <span>R$20</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/pizza1.jpeg') }}"fried rice">
									<div class="menu_content">
										<h4>Fried Rice  <span>R$45</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/prato1.jpeg') }}" alt="meat">
									<div class="menu_content">
										<h4>meat  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="dinner" role="tabpanel" aria-labelledby="dinner-tab">
						<div class="row">
							<div class="col-md-6">
								<div class="single_menu">
									<img src="{{ asset('../assets/images/coca1.jpeg') }}" alt="burger">
									<div class="menu_content">
										<h4>Chicken Burger  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/sprite.jpeg') }}" alt="black coffee">
									<div class="menu_content">
										<h4>Black coffee <span>R$20</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/pepsi.jpeg') }}" alt="fried rice">
									<div class="menu_content">
										<h4>Fried Rice  <span>R$45</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/fanta.jpeg') }}" alt="meat">
									<div class="menu_content">
										<h4>meat  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="single_menu">
									<img src={{ asset('../assets/images/vinho.jpeg') }} alt="burger">
									<div class="menu_content">
										<h4>Chicken Burger  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/vinho2.jpeg') }}" alt="black coffee">
									<div class="menu_content">
										<h4>Black coffee <span>R$20</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/vinho3.jpeg') }}" alt="fried rice">
									<div class="menu_content">
										<h4>Fried Rice  <span>R$45</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
								<div class="single_menu">
									<img src="{{ asset('../assets/images/vinho4.jpeg') }}" alt="meat">
									<div class="menu_content">
										<h4>meat  <span>R$24</span></h4>
										<p>Aperiam tempore sit,perferendis numquam repudiandae porro voluptate dicta saepe facilis.</p>
									</div>
								</div>
							</div>
						</div>
					</div>

		</div>
	</section>

    <!-- fim cardapio section -->

    <!-- sobre section -->

    <section class="about_section layout_padding" id="sobre">
        <div class="container  ">

            <div class="row">
                <div class="col-md-6 ">
                    <div class="img-box">
                        {{-- <img src="{{ asset('../assets/images/about-img.png') }}" alt=""> --}}
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

    <!-- fim sobre section -->

    <!-- contato section -->
    <section class="book_section layout_padding" id="contato">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Entre Em Contato
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="{{ route('contato.enviar')}}" method="POST" id="formContato">
                            @csrf
                            <div>
                                <input type="text" name="nomeContato" id="nomeContato" class="form-control"
                                    placeholder="Seu Nome" value="{{ old('nomeContato') }}">
                                <div id="nomeContatoError" class="error-mensagem"></div>
                            </div>
                            <div>
                                <input type="email" name="emailContato" id="emailContato" class="form-control"
                                    placeholder="Seu Email" value="{{ old('emailContato') }}">
                                <div id="emailContatoError" class="error-mensagem"></div>
                            </div>
                            <div>
                                <input type="text" name="foneContato" id="foneContato" class="form-control"
                                    placeholder="Telefone" value="{{ old('foneContato') }}">
                            </div>

                            {{-- opção de selecionar o tipo de assunto do contato --}}

                            <div>
                                <select name="assuntoContato" id="assuntoContato" class="form-control"  value="{{ old('assuntoContato') }}">
                                    <option value="" disabled="" selected="" hidden="">Selecione o assunto</option>
                                    <option value="Feedback">Feedback</option>
                                    <option value="Pedidos e consultas sobre o cardápio">Pedidos e consultas sobre o cardápio</option>
                                    <option value="Suporte ao cliente">Suporte ao cliente</option>
                                    <option value="Trabalhe conosco">Trabalhe conosco</option>
                                </select>
                                 <div id="assuntoContatoError" class="error-mensagem"></div>
                            </div>
                            <div>
                                <textarea  name="mensContato" id="mensContato" cols="30" rows="10" class="form-control textarea"
                                    placeholder="Digite a sua mensagem">{{ old('mensContato') }}</textarea>
                                    <div id="mensContatoError" class="error-mensagem"></div>
                            </div>
                            <div class="btn_box">
                                <button type="submit" onclick="formContato(event)">Enviar via e-mail</button>
                                <div id="contatoMensagem" class="msgContato"></div>
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
    <!-- fim contato section -->


@endsection
