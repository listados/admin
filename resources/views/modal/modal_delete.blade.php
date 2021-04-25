<!-- Modal
  PARAMETROS NA DOCUMENTAÇÃO
 -->
<div class="modal fade example-modal" id="{{$modal_id_delete}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-danger" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{$description_modal}}</h4>
      </div>
      {{ Form::open(array('url' => $url_route, 'method' => 'delete')) }}
      <div class="modal-body">
        <h3>{{$text_delete}}</h3>
        {{Form::text($name_camp , $value_camp)}}
      </div>
      <div class="modal-footer">       
        {{ Form::button('Não', array('class' => 'btn btn-outline pull-left' , 'data-dismiss' => 'modal')) }}
        {{ Form::submit('Sim', array('class' => 'btn btn-outline')) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>