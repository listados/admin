<!-- Modal finalizar vistoria -->
<div class="modal fade  modal-warning" id="end_survey_{{ $survey_update->survey_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Finalizar Rascunho</h4>
      </div>
      <div class="modal-body">
        <p>Você está ciente que irá finalizar a vistoria de nº {{ $survey_update->survey_id }} ?</p>
        <label for="lenbrando">Lembramos que essa ação é <strong> <u>irreversível</u> </strong> .</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left"  data-dismiss="modal">Sair</button>
        <button type="button" class="btn btn-outline" id="completed_button"  >Finalizar</button>
      </div>
    </div>
  </div>
</div>