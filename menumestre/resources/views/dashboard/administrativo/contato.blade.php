@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

<link rel="stylesheet" href="{{ asset('../assets/css/contato.css') }}">

<div class="container-contato">
    <div class="header-contato">
        <div class="header-titulo">
            <h1>Mensagens</h1>
            <p>Mensagens de nossos clientes</p>
        </div>
        <div role="navigation" aria-label="Pagination Navigation" class="pagination-container">
            <div class="pagination">
                @if ($contatos->previousPageUrl())
                    <a href="{{ $contatos->previousPageUrl() }}" class="pagination-link">
                        <i class="ri-arrow-drop-left-line"></i>
                    </a>
                @else
                    <span class="pagination-link disabled">
                        <i class="ri-arrow-drop-left-line"></i>
                    </span>
                @endif

                @if ($contatos->nextPageUrl())
                    <a href="{{ $contatos->nextPageUrl() }}" class="pagination-link">
                        <i class="ri-arrow-drop-right-line"></i>
                    </a>
                @else
                    <span class="pagination-link disabled">
                        <i class="ri-arrow-drop-right-line"></i>
                    </span>
                @endif
            </div>

            <div class="message-counter">
                <p>
                    <span>{{ $contatos->firstItem() }}</span> - <span>{{ $contatos->lastItem() }}</span>
                    de
                    <span>{{ $contatos->total() }}</span>
                    mensagens
                </p>
            </div>
        </div>
    </div>
    <div class="cont-contato">
        <div>
            <ul>
            <!-- Loop sobre as mensagens e exibir cada uma -->

            @php
                $maxId = App\Models\Contato::max('id');
            @endphp

            @foreach($contatos as $contato)
                <li class="cont-list-contato abrirModal" data-id="{{ $contato->id }}" data-toggle="modal" data-target="#show{{ $contato->id }}">
                    <div class="cont-info-contato">
                        <img src="{{ asset('../assets/images/contatos/perfil_contato.png') }}" alt="">
                        <div>
                            <span>{{ $contato->nomeContato }}</span>
                            <p>{{ $contato->emailContato }}</p>
                        </div>
                    </div>
                    <div class="cont-info-assunto">
                        <span>{{ $contato->assuntoContato }}: </span>
                        <span>{{ Str::limit($contato->mensContato, 25, '...') }}</span>
                    </div>
                    @if($contato->id == $maxId)
                    <span class="card-new-item">Novo!</span>
                    @endif
                    <div class="cont-info-data">
                        <span>{{ \Carbon\Carbon::parse($contato->created_at)->isoFormat('DD [de] MMMM') }}</span>
                    </div>
                </li>
                @include('dashboard.administrativo.contato.show', ['id' => $contato->id])
            @endforeach
            </ul>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Verificar cada contato na página ao carregar
        $('.cont-list-contato').each(function() {
            var id = $(this).data('id');
            $.get('/verificar-lido/' + id, function(data) {
                if (data.lido) {
                    $('.cont-list-contato[data-id="' + id + '"]').addClass('lido');
                }
            });
        });
        // Captura o evento de fechamento do modal
        $('.modal').on('hidden.bs.modal', function () {
            var id = $(this).attr('id').replace('show', '');
            $('.cont-list-contato[data-id="' + id + '"]').addClass('lido');
            $.ajax({
                url: '/atualizar-lido/' + id,
                type: 'PUT',
                data: { lidoContato: true },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
    </script>
