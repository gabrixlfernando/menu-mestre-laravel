@extends('dashboard.layoutdash.index')

@section('title', 'Dashboard')

@section('conteudo')

    <link rel="stylesheet" href="{{ asset('../assets/css/contato.css') }}">

    <div class="container-contato">
        <div class="header-contato">
            <div class="header-titulo">
                <a><i class="ri-mail-open-line"></i><span>Mensagens</span></a>
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

                    @foreach ($contatos as $contato)
                        <li class="cont-list-contato abrirModal {{ $contato->lidoContato == '1' ? 'lido' : '' }}"
                            data-id="{{ $contato->id }}" data-toggle="modal" data-target="#show{{ $contato->id }}">
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

                            {{-- tava aq --}}

                            <div class="cont-info-data">
                                @if ($contato->lidoContato == '0')
                                    <p class="card-new-item" data-id="{{ $contato->id }}">Novo!</p>
                                @endif
                                <span>
                                     {{-- {{ \Carbon\Carbon::parse($contato->created_at)->isoFormat('DD [de] MMMM') }} --}}
                                     @php
                                     $created_at = \Carbon\Carbon::parse($contato->created_at);

                                     if ($created_at->isToday()) {
                                         $formatted_date = $created_at->format('H:i');
                                     } elseif ($created_at->isSameWeek(\Carbon\Carbon::now())) {
                                         $formatted_date = $created_at->isoFormat('ddd, H:mm');
                                     } elseif ($created_at->diffInWeeks(\Carbon\Carbon::now()) == 1) {
                                         $formatted_date = $created_at->isoFormat('ddd, DD/MM');
                                     } else {
                                         $formatted_date = $created_at->isoFormat('ddd, DD/MM');
                                     }
                                 @endphp

                                 <span>{{ $formatted_date }}</span>
                                </span>
                            </div>

                            <div class="cont-info-lixeira">
                                <i class="fa-regular fa-trash-can"></i>
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
                    $(this).addClass('lido');
                }
            });
        });

        // Verificar cada parágrafo .card-new-item na página ao carregar
        $('.card-new-item').each(function() {
            var id = $(this).data('id');
            $.get('/verificar-lido/' + id, function(data) {
                if (data.lido) {
                    $(this).hide(); // Oculta o parágrafo
                }
            });
        });

        // Captura o evento de fechamento do modal
        $('.modal').on('hidden.bs.modal', function() {
            var id = $(this).attr('id').replace('show', '');

            // Marca o contato como lido
            $('.cont-list-contato[data-id="' + id + '"]').addClass('lido');

            // Oculta o parágrafo .card-new-item associado ao modal
            $('.card-new-item[data-id="' + id + '"]').hide();

            // Atualiza o status de lido no servidor
            $.ajax({
                url: '/atualizar-lido/' + id,
                type: 'PUT',
                data: {
                    lidoContato: true
                },
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
