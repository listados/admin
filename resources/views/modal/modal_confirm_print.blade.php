<!-- Modal de confirmação de impressão -->
<div class="modal fade bs-example-modal-sm" id="confSaveKey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Salvando e Imprimindo</h4>
      </div>
      {{ Form::open(['url' => 'chaves/receipt/', 'method' => 'get', 'id' => 'form_conf_print']) }}
     
      <div class="modal-body">
         <div class="row">
           <ul class="list-group">
            {{ Form::hidden('reserves_id' , '', ['id' => 'confirm_reserves_id']) }}
              <li class="list-group-item"> <input type="checkbox" name="key" checked="true" > - RECIBO CHAVES PARA VISITAÇÃO</li>
              <li class="list-group-item"><input type="checkbox" name="auto" checked="true" > - AUTORIZAÇÃO PARA VISITAÇÃO</li>
              <li class="list-group-item"><input type="checkbox" name="delivery" checked="true"> - RECIBO CHAVES - DELIVERY</li>        
            </ul>
         </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
        {{Form::submit('Salvar e gerar recibo' , ['class' => 'btn btn-info pull-right'])}}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>