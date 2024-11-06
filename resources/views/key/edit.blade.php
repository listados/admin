@extends('layouts.admin_template')
@section('content')
<!-- CSS INSERIDO APOS O JS SEGUNDO A DOCUMENTAÇAO-->
{{Html::style('plugins/daterangepicker/daterangepicker.css')}}
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Recibo de Chaves
            <small>Editar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Imóveis</a></li>
            <li class="active"><a href="{{ url('chaves') }}">Controle de Chaves</a></li>
            <li class="active">Nova Visita</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <!-- Input addon -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Outras Informações</h3>
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
                                <small>Imóvel</small>
                                <input type="text" value="{{ $immobile->immobiles_code }}" class="form-control" disabled="true" id="code_immobiles_reserve">
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
                            <div class="col-md-12">
                                <small>Data da entrega e da devolução das chaves</small>
                            </div>
                            <div class="col-xs-6">

                                <input type="text"  name="reserves_date_exit" value="{{ $carbon->format("d/m/Y H:i") }}" class="form-control" id="control_keys_date_exit">
                            </div>
                            <div class="col-xs-6">
                                <input type="text" name="reserves_date_devolution"  required="" id="reserve_keys_date_devolution" class="form-control" placeholder="Devolução - Obrigatório">
                                <small class="text-danger" id="erro_date_exit"></small>
                            </div>
                            <div class="col-xs-6">
                                <small>Valor do caução</small>
                                <input type="text"  name="reserves_value_guarante" class="form-control" id="control_keys_value_guarantee" value="20,00">
                            </div>
                            <div class="col-xs-6">
                               <small>Código da Chave</small>
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
                                    <small for="">Celular</small>
                                    <small class="text-danger"> (cadastrar ou consultar)</small>
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
                                    <small for="">Fone Fixo</small>
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
                            <div class="col-xs-3 form-group">
                                <small for="">C.E.P</small>
                                <small class="text-danger"> (números)</small>
                                <input type="text" class="form-control" id="clients_cep" name="control_keys_clients_cep" placeholder="CEP" onblur="requestCEP($(this).attr('name'), ['immobiles_address' , 'immobiles_district' , 'immobiles_city' , 'immobiles_state'] )">
                            </div>
                            <div class="col-xs-9 form-group">
                                <small for="">Logradouro</small>
                                <input type="text" class="form-control" id="clients_address" name="control_keys_clients_address" placeholder="Logradouro">
                            </div>
                            <div class="col-xs-3 form-group">
                                <small for="">Número</small>
                                <input type="text" class="form-control" id="clients_address_number" name="control_keys_clients_address_number" placeholder="Nº">
                            </div>
                            <div class="col-xs-4 form-group">
                                <small for="">Complemento</small>
                                <input type="text" class="form-control" id="clients_address_complement" name="control_keys_clients_address_complement" placeholder="Ex: Ap. 100 BL A">
                            </div>
                            <div class="col-xs-5 form-group">
                                <small for="">Bairro</small>
                                <input type="text" class="form-control" id="clients_district" name="control_keys_clients_district" placeholder="Bairro">
                            </div>
                            <div class="col-xs-7 form-group">
                                <small for="">Cidade</small>
                                <input type="text" class="form-control" id="clients_city" name="control_keys_clients_city" placeholder="Cidade">
                            </div>
                            <div class="col-xs-5 form-group">
                                <small for="">Estado</small>
                                <input type="text" class="form-control" id="clients_state" name="control_keys_clients_state" placeholder="Estado">
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
                    <!-- /.box-body -->
                </div>

                 <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Endereço do imóvel</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <p>
                            <span><strong>Logradouro: </strong> {{$immobile->immobiles_address}}, nº:
                            {{$immobile->immobiles_number}}, {{$immobile->immobiles_complement}} </span> <br>
                            <span>
                                <strong>Bairro: </strong> {{$immobile->immobiles_district}}
                                <strong>Cidade: </strong> {{$immobile->immobiles_city}}
                                <strong>Estado: </strong> {{$immobile->immobiles_state}}
                            </span>
                        </p>
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
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->

            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@push('scripts')

{{Html::script('plugins/jquery-serializejson/jquery.serializejson.min.js')}}
{{Html::script('plugins/input-mask/jquery.inputmask.js')}}
{{Html::script('plugins/input-mask/jquery.inputmask.date.extensions.js')}}
{{Html::script('plugins/input-mask/jquery.inputmask.extensions.js')}}
<!-- MAASCARA MONEY -->
{{Html::script('plugins/jquery/jquery.maskMoney.js')}}
<!-- COMBOSELECT -->
{{Html::script('plugins/combo-select/jquery.combo.select.js')}}
<!-- date-range-picker -->
{{Html::script('dist/js/moment.min.js')}}
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
{{Html::script('plugins/jquery-timepicker/dist/jquery-ui-timepicker-addon.min.js')}}
{{Html::script('plugins/jquery-maskmoney/src/jquery.maskMoney.js')}}
{{Html::script('dist/js/mascaraFone.js')}}

{{Html::script('plugins/daterangepicker/daterangepicker.js')}}
{{Html::script('dist/js/key.js')}}
<script type="text/javascript"></script>
<script type="text/javascript">
    var dateRangePickerSettings = {
        locale: {
                "format": "d/m/Y",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "Para",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "Do",
                    "Se",
                    "Te",
                    "Qu",
                    "Qu",
                    "Se",
                    "Sa"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "dezembro"
                ],
                "firstDay": 1
            },
    };

    $("#keys_date_exit").daterangepicker({
          "timePicker": true,
          "timePicker24Hour": true,
          "singleDatePicker": true,
          "showDropdowns": true,
          "locale": dateRangePickerSettings.locale ,
          "autoApply": true
        }, function(start, end) {

          $('#keys_date_exit').val(start.format('DD/MM/YYYY H:mm') );
    });


    $("#keys_date_devolution").daterangepicker({
          "timePicker": true,
          "timePicker24Hour": true,
          "singleDatePicker": true,
          "showDropdowns": true,
          "locale": dateRangePickerSettings.locale ,
          "autoApply": true
        }, function(start, end) {
          console.log("start: " + start + " end: "+end+" label: ");
          $('#keys_date_devolution').val(start.format('DD/MM/YYYY H:mm') );
         // $('#span_dev').html(start.format('DD/MM/YYYY H:mm'));
    });

    /* CEP */
    function requestCEP(campo_cep , campos)
    {
        var cep = $("#clients_cep").val();
        //Consulta o webservice viacep.com.br/
        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {
                console.log(dados)
                //Atualiza os campos com os valores da consulta.
                $("#clients_address").val(dados.logradouro);
                $("#clients_district").val(dados.bairro);
                $("#clients_city").val(dados.localidade);
                $("#clients_state").val(dados.uf);
                // $("#ibge").val(dados.ibge);
            } //end if.
            else {
                //CEP pesquisado não foi encontrado.
                //limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        });
    }

    //Datemask dd/mm/yyyy
    $("#keys_cpf").inputmask("999.999.999-99", {});
    //$("#control_keys_visitor_state").inputmask("99.999-999",{"placeholder": "999.999.999-99"});
    $("#control_keys_value_guarantee").maskMoney({symbol:'',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
    $("#delivery_value").maskMoney({symbol:'',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});

</script>
@push('daterangepicker')
@endpush
@endpush
@endsection