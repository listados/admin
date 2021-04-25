<!-- Modal Mudar Status da Proposta-->
<div class="modal fade" id="editStatus_{{$proposta->proposal_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <Editar>Alterar</Editar>
                    Status da proposta nº {{ $proposta->proposal_id }}
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Status atual: {{$proposta->proposal_status}}</label>
                </div>
                {{Form::open(array('url' => 'alterar-status-proposta'))}}
                <div class="container-fluid bd-example-row">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Escolha o Status</p>
                            <select name="proposal_status" id="" class="form-control selectpicker">
                                <option value="Nova">Nova</option>
                                <option value="Incompleta">Incompleta</option>
                                <option value="Em Análise">Em Análise</option>
                                <option value="Concluída">Concluída</option>
                            </select>
                            {{Form::hidden('proposal_id', $proposta->proposal_id)}}
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                <button type="submit" value="Alterar" id="alterar_status_proposta" class="btn btn-primary pull-right">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Alterar Status
                </button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
