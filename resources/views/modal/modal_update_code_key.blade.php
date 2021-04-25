<!-- MODAL UPDATE CODE KEY/.modal -->
<div class="modal fade" id="update_code_key" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alterar código da chave</h4>
      </div>
      {{ Form::open(['url' => 'update-code-key' , 'id' => 'form_update_code_key']) }}
      <div class="modal-body">
        <p id="info_update_code_key"></p>
        <div class="row">
          <div class="col-md-12">
            {{ Form::hidden('keys_id' , '' , ['id' => 'update_keys_code']) }}
            {{ FORM::text('keys_cod_immobile' , '', ['class' => 'form-control', 'id' => 'keys_cod_immobile', 'placeholder' => 'Digite o novo código do Imóvel']) }}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="save_update_code_key" > <i class="fa fa-edit"></i> Alterar</button>
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->