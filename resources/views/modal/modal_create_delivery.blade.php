<!-- Modal cadastro de delivery-->
<div class="modal fade" id="add_delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastro de Delivery</h4>
            </div>
            {{ Form::open(['id' => 'form_delivery' , 'class' => 'form-horizontal']) }}
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('nome' , 'Nome', ['class' => 'col-sm-2 label_form']) }}
                    <div class="col-sm-10">
                        {{ Form::text('deliveries_name', '' , ['class' => 'form-control' , 'placeholder' => 'Nome do despachante']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('fone' , 'Fone', ['class' => 'col-sm-2 label_form']) }}
                    <div class="col-sm-4">
                        {{ Form::text('deliveries_phone', '' , ['class' => 'form-control' , 'id' => 'deliveries_phone' , 'maxlength' => '15', 'onkeyup' => 'mascara( this, mtel )']) }}
                    </div>
                    {{ Form::label('mobile' , 'Celular', ['class' => 'col-sm-2 label_form']) }}
                    <div class="col-sm-4">
                        {{ Form::text('deliveries_mobile', '' , ['class' => 'form-control' , 'id' => 'deliveries_mobile',  'maxlength' => '15', 'onkeyup' => 'mascara( this, mtel )']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('cpf' , 'CPF', ['class' => 'col-sm-2 label_form']) }}
                    <div class="col-sm-10">
                        {{ Form::text('deliveries_cpf', '' , ['class' => 'form-control' , 'placeholder' => 'CPF do despachante' , 'id' => 'deliveries_cpf']) }}
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                    {{ Form::button('Cadastrar' , ['id' => 'save_delivery' , 'class' => 'btn btn-primary']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>