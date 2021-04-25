<!-- Modal -->
<div class="modal fade" id="modal_edit_key" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Recebimento de chave</h4>
      </div>
      <div class="modal-body">
        <div class="row">
       
            <div class="col-md-12">
                     <div class="row">
                       
                        <div class="col-md-8">
                          {{ Form::hidden('id_key' , '', ['id' => 'id_key'] ) }}
                          <ul class="list-group">
                              <li class="list-group-item"><strong>Ref. Imovel: </strong><label class="text-info" id="ref_imovel"></label></li>
                              <li class="list-group-item"><strong>Cód Chave: </strong><label class="text-info" id="cod_key"></label></li>
                              <li class="list-group-item"><strong>Status: </strong><label class="text-info" id="key_status"></label></li>
                              <li class="list-group-item"><strong>Retirado por: </strong> <label class="text-info" id="retired_by"></label></li>
                              <li class="list-group-item"><strong>Retirada: </strong> <label class="text-info" id="date_retired"></label></li>
                              <li class="list-group-item"><strong>Dt Devolução prevista: </strong> <label class="text-info" id="date_devolution"></label></li>
                              <li class="list-group-item"><strong>Tipo de Reserva: </strong><label class="text-info" id="keys_type_info"></label></li>
                            </ul>
                        </div>

                        <div class="col-md-12 text-center">
                           <button type="button" class="btn btn-primary" id="save_confirmed_key" title="Irá o recebimento dessa visita" >
                            Confirmar Recebimento
                            <i class="fa fa-check"></i>
                          </button>
                        </div>
                     
                     </div> 
            </div>
 

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetFileldsInfo()">Sair</button>
       
      </div>
     
    </div>
  </div>
</div>