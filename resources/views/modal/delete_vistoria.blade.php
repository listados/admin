<!-- Modal -->
<div class="modal fade example-modal" id="delete_survey_{{ $surveys->survey_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-danger" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Excluir Vistoria {{ $surveys->survey_id }}</h4>
      </div>
      {{ Form::open(array('url' => 'vistoria/excluir/'.$surveys->survey_id, 'method' => 'delete')) }}
      <div class="modal-body">
        <h3>Deseja realmente excluir essa Vistoria?</h3>
      </div>
      <div class="modal-footer">       
        {{ Form::button('Não', array('class' => 'btn btn-outline pull-left' , 'data-dismiss' => 'modal')) }}
        {{ Form::submit('Sim', array('class' => 'btn btn-outline')) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>