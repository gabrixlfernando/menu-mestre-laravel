@foreach($contatos as $contato)
    <div class="modal fade" id="show{{ $contato->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Conteúdo do modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $contato->assuntoContato }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-container">
                        <div class="m-info">
                            <img src="{{ url('assets/images/contatos/perfil_contato.png') }}" alt="">
                            <div>
                                <span>{{ $contato->nomeContato }}</span>
                                <p>{{ $contato->emailContato }}</p>
                            </div>
                        </div>
                        <p>{{ $contato->mensContato }}</p>

                    </div>
                </div>
                <div class="modal-footer m-data">
                    <p>{{ \Carbon\Carbon::parse($contato->dataContato)->isoFormat('DD [de] MMMM') }}</p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <!-- Adicione aqui os botões ou ações que você deseja realizar no modal -->
                </div>
            </div>
        </div>
    </div>
@endforeach
