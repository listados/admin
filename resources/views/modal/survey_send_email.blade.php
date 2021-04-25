{{-- INICIO MODAL ENVIAR EMAIL --}}
<div class="modal fade" id="send_email_{{ $surveys->survey_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Enviar Vistoria Nº {{ $surveys->survey_id }}</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'vistoria/enviar-vistoria/'.$surveys->survey_id, 'method' => 'post')) }}
                <div class="form-group">
                    <div class="col-md-12">
                        {{  Form::label('email_send', 'E-mail para envio') }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {{ Form::email('email', '', array('class' => 'form-control' , 'placeholder' => 'Digite o e-mail do Locatário, Fiador, Vistoriador...', 'style' => 'width:500px' , 'required' => '')) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::text('id' , $surveys->survey_id ) }}
                {{ Form::button('Fechar', ['class' => 'btn btn-default' , 'data-dismiss' => 'modal']) }}
                {{ Form::submit('Enviar', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
{{-- FIM MODAL ENVIAR EMAIL --}}