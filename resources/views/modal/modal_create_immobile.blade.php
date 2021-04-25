<!-- /.modal cadsatro de imovel -->
<div class="modal fade" id="create_immobile" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cadastrar Imóvel</h4>
      </div>
      {{ Form::open(['route' => 'imovel.store']) }}
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 breadcrumb">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="form-group">
                    
                    <label>Código Imóvel <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="left" title="O mesmo código usado no Ingaia"></i></label>
                    {{ Form::text('immobiles_code' , '', ['class' => 'form-control' , 'id' => 'immobiles_code' , 'required' => 'true']) }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                    
                    <label>Código da Chave <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="left" title="O mesmo código usado no Ingaia"></i></label>
                    {{ Form::text('keys_code' , '', ['class' => 'form-control' , 'id' => 'keys_code' , 'required' => 'true']) }}
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('C.E.P') }}
                    <input type="text" name="immobiles_cep" class="form-control" onblur="requestCEP($(this).attr('name'), ['immobiles_address' , 'immobiles_district' , 'immobiles_city' , 'immobiles_state'] )" id="immobiles_cep">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    {{ Form::label('Endereço') }}
                    {{ Form::text('immobiles_address' , '', ['class' => 'form-control' , 'id' => 'immobiles_address']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Número') }}
                    {{ Form::text('immobiles_number' , '', ['class' => 'form-control' , 'id' => 'immobiles_number' ]) }}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    {{ Form::label('Complemento') }}
                    {{ Form::text('immobiles_complement' , '', ['class' => 'form-control' ,'id' => 'immobiles_complement']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Bairro') }}
                    {{ Form::text('immobiles_district' , '', ['class' => 'form-control' , 'id' => 'immobiles_district']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Cidade') }}
                    {{ Form::text('immobiles_city' , '', ['class' => 'form-control' , 'id' => 'immobiles_city']) }}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::label('Estado') }}
                    {{ Form::text('immobiles_state' , '', ['class' => 'form-control' , 'id' => 'immobiles_state']) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Ponto de referência') }}
                    {{ Form::text('immobiles_reference_point' , '', ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
        
        {{ Form::submit('Cadastrar' , ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->