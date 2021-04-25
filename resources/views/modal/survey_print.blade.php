<div class="modal fade" id="option_print_{{ $surveys->survey_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Opção de Impressão</h4>
            </div>
           
            <div class="modal-body">
              <div class="form-group">
                 {{ Form::open(array('url' => 'vistoria/imprimir/'.$surveys->survey_id, 'method' => 'get' )) }}
                
                 {{ Form::hidden('imprimir_com_foto', 'true' ) }}
                 {{ Form::submit('Imprimir com Foto', $attributes = array('class' => 'btn btn-primary' )) }}
                 {{ Form::close() }}
              </div>
              <div class="form-group">
                <hr>
              </div>
              <div class="form-group">
                 {{ Form::open(array('url' => 'vistoria/imprimir-sem-foto/'.$surveys->survey_id, 'method' => 'get' )) }}
                 
                 {{ Form::hidden('imprimir_com_foto', 'false' ) }}
                 {{ Form::submit('Imprimir sem Foto', $attributes = array('class' => 'btn btn-primary' )) }}
                 {{ Form::close() }}
              </div>
                
            </div>
            <div class="modal-footer">                
                {{ Form::button('Sair', $attributes = array('class' => 'btn btn-default' , 'data-dismiss' => 'modal')) }}               
            </div>
            
        </div>
    </div>
</div> 