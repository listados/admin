<!-- Modal -->
<div class="modal fade" id="reserveKey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="closeModalReserve();" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title_modal_reserve">Reserva de Chaves</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label>Informações de reserva</label>
                </div>
                {{ Form::open(['url' => '' , 'id' => 'formReserveKey']) }}
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <small>Atendente</small>
                            <select class="form-control" name="reserves_id_user">
                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->nick }}</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <small>Finalidade</small>
                            <select class="form-control" id="control_keys_finality"  name="reserve_finality">
                                <option value="visita">Visita</option>
                                <option value="reserva" selected="true">Reserva</option>
                                <option value="manutencao">Manutenção</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <small>Delivery</small>
                            {{ Form::select('reserves_id_delivery', $delivery , 7 , ['id' => 'value_delivery', 'class' => 'form-control' ]) }}
                            
                        </div>
                        <div class="col-md-6" id="hide_value_delivery">
                            <small>Valor delivery*</small><small class="text-danger badge" data-toggle="tooltip" data-placement="top" title="Tooltip on left"><i class="fa fa-info"></i></small>            
                            <input type="text" name="value_delivery" id="delivery_value" class="form-control">           
                        </div>
                        <div class="col-md-12"><samll>Data da entrega e da devolução das chaves</samll></div>
                        <div class="col-xs-6">
                            {{-- <input type="text" value="{{ $carbon->format("d/m/Y H:i") }}" class="form-control" disabled="true"> --}}
                            <input type="text"  name="reserves_date_exit" value="{{ $carbon->format("d/m/Y H:i") }}" class="form-control" id="control_keys_date_exit">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" name="reserves_date_devolution"  required="" id="reserve_keys_date_devolution" class="form-control" placeholder="Devolução - Obrigatório">
                            <small class="text-danger" id="erro_date_exit"></small>
                        </div>
                        <div class="col-xs-6">
                            <samll>Valor do caução</samll>
                            <input type="text"  name="reserves_value_guarante" class="form-control" id="control_keys_value_guarantee" value="20,00">
                        </div>
                        <div class="col-xs-6">
                            <samll>Código da Chave</samll>
                            <select class="form-control" name="selectCodeKey"  id="selectCodeKey">
                                <option value="">--Selecione--</option>
                            </select>
                            <small class="text-danger" id="erro_code_key"></small>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <label>Dados do visitante</label>
                    <div class="alert alert-danger" id="erro_fields">
                       <small>Campos Obrigatórios</small> <br>
                       <small>Data de devolução , Código da chave, Nome do Visitante, Celular do Visitante e CPF do Visitante</small>
                   </div>
               </div>
               <div class="box-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <samll for="">Celular</samll><small class="text-danger"> (cadastrar ou consultar)</small>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <input type="text" class="form-control"  id="keys_visitor_phone_two" name="control_keys_visitor_phone_two" onkeyup="mascara( this, mtel );" maxlength="15" onblur="verifyclient();">
                            </div>
                              
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <samll for="">Fone Fixo</samll>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" name="control_keys_visitor_phone_one" id="keys_visitor_phone_one" class="form-control" onkeyup="mascara( this, mtel );" maxlength="15" disabled="true">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <small class="text-primary" id="load_find_client"> <i class="fa fa-spinner fa-spin fa-2x"></i> <label id="info_load_find_client">Consultando...</label></small>  
                    </div>

                    <div class="col-xs-6 form-group">
                        <input type="text" class="form-control"  id="control_keys_visitor_name" onblur="validFields('control_keys_visitor_name');" name="control_keys_visitor_name" placeholder="Nome e sobrenome" disabled="true">
                        <small class="text-danger" id="erro_name_visitor"></small>
                    </div>
                    <div class="col-xs-6 form-group">
                        <input type="text" class="form-control" name="control_keys_cpf" id="control_keys_cpf" placeholder="C.P.F" disabled="true">
                    </div>
                    <div class="col-xs-12 form-group">
                        <input type="text" class="form-control" id="clients_email" name="control_keys_visitor_email" placeholder="E-mail" disabled="true">
                    </div>


                </div>


                <div class="row"  id="type_manutencao">
                    <div class="box box-success">
                        <div class="col-md-12 col-xs-12">
                            <label>Informações sobre a manutenção</label>
                            <textarea class="form-control" name="reserve_ps"></textarea>

                        </div>
                    </div>
                </div>

                {{ Form::hidden('reserves_ref_immobile' , '' , ['id' => 'control_keys_ref_immobile']) }}

            </div>
            <!-- /.box-body -->
            {{ Form::close() }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="closeModalReserve();">Sair</button>
            <div id="confirmreserved">
             <button type="button" class="btn btn-primary" id="reserveKeySave"><i class="fa fa-key"> </i> Reservar chaves</button> 
         </div>                
         <div id="confirmvisited">
            <button type="button" class="btn btn-primary" onclick="saveReserve();" id="printreserveKeySave"><i class="fa fa-print"> </i> Imprimir Visita</button>


        </div>
    </div>
</div>
</div>
</div>