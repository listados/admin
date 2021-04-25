<div class="modal fade" id="alter_ambience" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alterar Ambiente</h4>
      </div>
      <div class="modal-body">
      
         
          <h3 class="text-info">Escolha o ambiente da Imagem.</h3>
          <br>
          
         {{--  {{Form::select('files_ambience_id_ambience' ,$ambience , null,  ['class' => 'form-control' ])}} --}}

           <select name="files_ambience_id_ambience" class="form-control" id="files_ambience_id_ambience">
            <option value="">--Selecione--</option>
             @foreach($ambience as $ambiences)
              <option value="{{$ambiences->ambience_id}}">{{$ambiences->ambience_name}}</option>
             @endforeach 
          </select>
         
          {{Form::submit('Alterar Ambiente' , ['class' => 'btn btn-primary' , 'id' => 'sendAlterAmbience'])}}
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->