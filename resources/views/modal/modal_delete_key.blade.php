
<div class="modal modal-danger fade in" id="modal_delete_key" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_title_delete">Deletar</h4>
      </div>
       {{ Form::open(['url' => '', 'id' => 'form_delete_ajax']) }}
      <div class="modal-body">
        <h3 id="txt_info" class="">Excluir</h3>
        <div class="row">
          <div class="col-md-12">
            <div id="alert_info_delete" class="">
              <i class="fa fa-info-circle" aria-hidden="true"></i>
            <p id="p_info_delete">
              
            </p>
          </div>
          </div>
        </div>
      
        <input type="hidden" id="delete_id">
      </div>
      <div class="modal-footer">
        <script type="text/javascript">
          var id = $("#delete_id").val();
        </script>
        <a href="#" class="btn btn-outline" id="btn_delete_key"> Excluir Chave </a>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

