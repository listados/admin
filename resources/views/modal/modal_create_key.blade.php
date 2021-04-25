<!-- Modal -->
<div class="modal fade" id="create_key" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastrar Chave</h4>
            </div>
            {{ Form::open(['url' => '' , 'id' => 'form_save_key']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group ">
                            {{ Form::label('Código da Chave') }}
                            {{ Form::text('keys_code' , '' , ['class' => 'form-control' , 'id' => 'keys_code_immobile']) }}

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('Código do Imóvel') }}
                            {{ Form::select('keys_cod_immobile', $immobile, '',['class' => 'js-select-combo']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                <button type="button" class="btn btn-primary" id="save_key">Cadastrar</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
