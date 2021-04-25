
<div class="modal fade bs-example-modal-lg" id="modal_ambience" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload das fotos do ambiente da Vistoria {{ $id_survey }}
        <a href="#" id="icon-info" class="text-danger" data-toggle="popover" title="Informações de Upload" data-placement="right" data-trigger="hover" data-content="Arquivo até 6MB, máximo de 10 arquivos, total geral máximo de 50MB de arquivos.">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
        </a></h4>
      </div>
      <div class="modal-body">
       <div class="form-group" id="sucesso_upload_ambiente">
        <div class="alert alert-success">
          <h5 >Arquivos enviado com sucesso</h5> 
        </div>       
      </div>
      {{ Form::open(['url' => '' , 'class' =>'dropzone' , 'enctype' =>'multipart/form-data' , 'id' => 'form-dropzone-upload' ]) }}

      <div class="form-group">

        @if($title_survey === 'Nova Vistoria')
        {{ Form::hidden('ambience_id' , $survey_update->survey_id)}}
        @elseif($title_survey === 'Editar Vistoria')
        {{ Form::hidden('ambience_id' , $id_survey)}}          
        @endif
        @if($title_survey === 'Replicando Vistoria')
        {{ Form::hidden('ambience_id' , $id_survey)}}

        @endif

      </div>

      <div class="form-group">
        <label>Escolha o ambiente da foto</label>

        <select name="ambience" class="form-control" id="ambience_upload">
          <option value="">--Selecione--</option>
          @foreach($ambience as $ambiences)
          <option value="{{$ambiences->ambience_id}}">{{$ambiences->ambience_name}}</option>
          @endforeach 
        </select>
        <h4 id="info_ambience_upload" class="label-danger"></h4>
      </div>

      <div class="form-group">
        <div class="btn-group" data-toggle="buttons">
          <label class="btn btn-primary active">
            <input type="radio" name="foto" value="normal" id="option1" autocomplete="off" checked>   Fotos Padrão
          </label>
          <label class="btn btn-primary">
            <input type="radio" name="foto" value="360" id="option2" autocomplete="off"> Fotos 360
          </label>

        </div>
      </div>


      {{ Form::close() }}
    </div>
    <div class="modal-footer">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
        <button type="button" class="btn btn-success" id="send_file_upload" title="Enviar Arquivos da vistoria"><i class="fa fa-upload" aria-hidden="true"></i>  Upload</button>
      </div>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
