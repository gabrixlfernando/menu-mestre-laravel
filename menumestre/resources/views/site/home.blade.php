@extends('layout.layout')

@section('title', 'Home')

@section('conteudo')




    <section id="our_menu" class="pt-5 pb-5 menu">
        <div class="container" id="menu">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page_title text-center mb-4">
                        <h1>Menu</h1>
                        <div class="single_line"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="nav nav-tabs menu_tab mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="prato-tab" data-toggle="tab" href="#prato" role="tab">Pratos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="massa-tab" data-toggle="tab" href="#massa" role="tab">Massas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="bebida-tab" data-toggle="tab" href="#bebida" role="tab">Bebidas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sobremesa-tab" data-toggle="tab" href="#sobremesa"
                            role="tab">Sobremesas</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="tab-content col-lg-12" id="myTabContent">

                    {{-- Pratos --}}

                    <div class="tab-pane fade show active" id="prato" role="tabpanel" aria-labelledby="prato-tab">
                        <div class="row">
                            @php
                                $pratosArray = $pratos->toArray();
                                $pratosChunked = array_chunk($pratosArray, 2);
                            @endphp
                            @foreach ($pratosChunked as $par)
                                <div class="col-md-6">
                                    @foreach ($par as $prato)
                                        <div class="single_menu">
                                            <img src="{{ asset('../assets/images/cardapio/' . $prato['fotoProduto']) }} "
                                            alt="{{ $prato['altProduto'] }}">
                                            <div class="menu_content">
                                                <h4>{{ $prato['nomeProduto'] }} <span>{{ $prato['valorProduto'] }}</span>
                                                </h4>
                                                <p>{{ $prato['descricaoProduto'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Massas --}}

                    <div class="tab-pane fade" id="massa" role="tabpanel" aria-labelledby="massa-tab">
                        <div class="row">
                            @php
                                $massasArray = $massas->toArray();
                                $massasChunked = array_chunk($massasArray, 2);
                            @endphp
                            @foreach ($massasChunked as $par)
                                <div class="col-md-6">
                                    @foreach ($par as $massa)
                                        <div class="single_menu">
                                            <img src="{{ asset('../assets/images/cardapio/' . $massa['fotoProduto']) }}"
                                            alt="{{ $prato['altProduto'] }}">
                                            <div class="menu_content">
                                                <h4>{{ $massa['nomeProduto'] }} <span>{{ $massa['valorProduto'] }}</span>
                                                </h4>
                                                <p>{{ $massa['descricaoProduto'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bebidas --}}

                    <div class="tab-pane fade" id="bebida" role="tabpanel" aria-labelledby="bebida-tab">
                        <div class="row">
                            @php
                                $bebidasArray = $bebidas->toArray();
                                $bebidasChunked = array_chunk($bebidasArray, 2);
                            @endphp
                            @foreach ($bebidasChunked as $par)
                                <div class="col-md-6">
                                    @foreach ($par as $bebida)
                                        <div class="single_menu">
                                            <img src="{{ asset('../assets/images/cardapio/' . $bebida['fotoProduto']) }}"
                                            alt="{{ $prato['altProduto'] }}">
                                            <div class="menu_content">
                                                <h4>{{ $bebida['nomeProduto'] }}
                                                    <span>{{ $bebida['valorProduto'] }}</span></h4>
                                                <p>{{ $bebida['descricaoProduto'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sobremesas --}}

                    <div class="tab-pane fade" id="sobremesa" role="tabpanel" aria-labelledby="sobremesa-tab">
                        <div class="row">
                            @php
                                $sobremesasArray = $sobremesas->toArray();
                                $sobremesasChunked = array_chunk($sobremesasArray, 2);
                            @endphp
                            @foreach ($sobremesasChunked as $par)
                                <div class="col-md-6">
                                    @foreach ($par as $sobremesa)
                                        <div class="single_menu">
                                            <img src="{{ asset('../assets/images/cardapio/' . $sobremesa['fotoProduto']) }}"
                                            alt="{{ $prato['altProduto'] }}">
                                            <div class="menu_content">
                                                <h4>{{ $sobremesa['nomeProduto'] }}
                                                    <span>{{ $sobremesa['valorProduto'] }}</span></h4>
                                                <p>{{ $sobremesa['descricaoProduto'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
    </section>

    <!-- fim cardapio section -->

    <!-- sobre section -->

    <section class="about_section layout_padding" id="sobre">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2 style="align-self: center;">Nós somos Menu Mestre</h2>
                        </div>
                        <p style="font-size: 20px; font-weight: 300; letter-spacing: 1px; line-height: 31px;">
                            Desde a nossa inauguração, temos nos dedicado a criar pratos que combinam ingredientes frescos e
                            de alta qualidade com técnicas de culinária inovadoras. Nossa equipe de chefs talentosos e
                            dedicados trabalha incansavelmente para garantir que cada prato seja uma obra-prima, desde a
                            entrada até a sobremesa.
                            <br><br>
                            Valorizamos a autenticidade e a integridade em tudo o que fazemos. É por isso que nos
                            comprometemos a manter a essência dos sabores tradicionais, ao mesmo tempo em que exploramos
                            novas fronteiras gastronômicas. Cada refeição no Menu Mestre é cuidadosamente preparada para
                            proporcionar uma experiência memorável, seja para um jantar romântico, uma celebração em família
                            ou um encontro casual com amigos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- fim sobre section -->

    <!-- contato section -->
    <!-- contato section -->
<section class="book_section layout_padding" id="contato" data-contato-url="{{ route('contato.enviar') }}">
    <div class="container">
        <div class="heading_container">
            <h2>Entre Em Contato</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form method="POST" id="formContato">
                        @csrf
                        <div>
                            <input type="text" name="nomeContato" id="nomeContato" class="form-control" placeholder="Seu Nome" value="{{ old('nomeContato') }}">
                            <div id="nomeContatoError" class="error-mensagem"></div>
                        </div>
                        <div>
                            <input type="email" name="emailContato" id="emailContato" class="form-control" placeholder="Seu Email" value="{{ old('emailContato') }}">
                            <div id="emailContatoError" class="error-mensagem"></div>
                        </div>
                        <div>
                            <input type="text" name="foneContato" id="foneContato" class="form-control" placeholder="Telefone" value="{{ old('foneContato') }}">
                        </div>
                        <div>
                            <select name="assuntoContato" id="assuntoContato" class="form-control" value="{{ old('assuntoContato') }}">
                                <option value="" disabled="" selected="" hidden="">Selecione o assunto</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Pedidos e consultas sobre o cardápio">Pedidos e consultas sobre o cardápio</option>
                                <option value="Suporte ao cliente">Suporte ao cliente</option>
                                <option value="Trabalhe conosco">Trabalhe conosco</option>
                            </select>
                            <div id="assuntoContatoError" class="error-mensagem"></div>
                        </div>
                        <div>
                            <textarea name="mensContato" id="mensContato" cols="30" rows="10" class="form-control textarea" placeholder="Digite a sua mensagem">{{ old('mensContato') }}</textarea>
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
                <div class="map_container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.0254648900777!2d-46.43443702376172!3d-23.49559225918106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce63dda7be6fb9%3A0xa74e7d5a53104311!2sSenac%20S%C3%A3o%20Miguel%20Paulista!5e0!3m2!1spt-BR!2sbr!4v1718821879391!5m2!1spt-BR!2sbr" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- fim contato section -->


@endsection
