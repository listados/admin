@extends('layouts.admin_template')
@section('content')
<!-- CSS INSERIDO APOS O JS SEGUNDO A DOCUMENTAÇAO-->
{{Html::style('public/plugins/daterangepicker/daterangepicker.css')}}
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Recibo de Chaves
            <small>Visita</small>
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
            @if (count($errors) > 0)
                <div class="alert alert-info">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Imóvel</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        {{Form::open(['url' => 'chaves'])}}
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Tipo de Imóvel</label>
                                    <select class="form-control" name="control_keys_type_immobile">
                                        <option>Apartamento</option>
                                        <option>Casa</option>
                                        <option>Kitnet</option>
                                        <option>Sala</option>
                                        <option>Loja</option>
                                        <option>Terreno</option>
                                        <option>Galpão</option>
                                        <option>Outros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <label for="">Ref. Imóvel</label>
                                <input type="text" name="control_keys_ref_immobile" class="form-control" value="{{ (isset($_GET['immobile']) ?  $_GET['immobile'] : '')   }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="">CEP</label>
                                <input type="text" name="control_keys_cep" value="{{ (empty($immobile)?"":$immobile[0]->immobiles_cep) }}" class="form-control" onblur="requestCEP($(this).attr('name'), ['control_keys_address' , 'control_keys_district' , 'control_keys_city' , 'control_keys_state'] )" id="control_keys_cep">
                            </div>
                            <div class="col-xs-7">
                                <label for="">Endereço</label>
                                <input type="text" name="control_keys_address" value="{{ (empty($immobile)?"":$immobile[0]->immobiles_address) }}"  id="control_keys_address" class="form-control"  placeholder="Rua/Av. Santos Dumont">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-4">
                                <label for="">Número</label>
                                <input type="number" name="control_keys_number"  value="{{ (empty($immobile)?"":$immobile[0]->immobiles_number) }}" class="form-control"  placeholder="1010">
                            </div>
                            <div class="col-xs-5">
                                <label for="">Complemento</label>
                                <input type="text" name="control_keys_complements"  value="{{ (empty($immobile)?"":$immobile[0]->immobiles_complement) }}" class="form-control"  placeholder="Ap. 801, Bloco A">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-4">
                                <label for="">Bairro</label>
                                <input type="text" name="control_keys_district" id="control_keys_district" value="{{ (empty($immobile)?"":$immobile[0]->immobiles_district) }}"  class="form-control"  placeholder="Aldeota">
                            </div>
                            <div class="col-xs-4">
                                <label for="">Cidade</label>
                                <input type="text" name="control_keys_city" value="{{ (empty($immobile)?"":$immobile[0]->immobiles_city) }}"  id="control_keys_city" class="form-control"  placeholder="Fortaleza">
                            </div>
                            <div class="col-xs-3">
                                <label for="">Estado</label>
                                <input type="text" name="control_keys_state"  value="{{ (empty($immobile)?"":$immobile[0]->immobiles_state) }}"  id="control_keys_state" class="form-control"  placeholder="CE">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Ponto de referência</label>
                            <input type="text" name="control_keys_point_reference" value="{{ (empty($immobile)?"":$immobile[0]->immobiles_reference_point) }}" class="form-control"  placeholder="Especificar...">
                        </div>
                    </div>
                </div>
                <!-- /.box -->
                <!-- Form Element sizes -->
                <!-- /.box -->
                <!-- /.box -->
                <!-- Input addon -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Outras Informações</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Atendente</label>
                                    <select class="form-control" name="control_keys_id_user">
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->nick }}</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Finalidade</label>
                                    <select class="form-control" name="control_keys_finality">
                                        <option>Visita</option>
                                        <option>Reserva</option>
                                        <option>Manutenção</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Delivery</label>
                                    <select class="form-control" name="control_keys_id_delivery" id="value_delivery">
                                        <option value="Não" selected="">Não</option>
                                        @foreach($delivery as $deliveries)
                                        <option value="{{ $deliveries->deliveries_id }}">{{ $deliveries->deliveries_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="hide_value_delivery">
                                <label>Valor delivery*</label><small class="text-danger"> (*Digite o valor que a imobiliária pagará)</small>            
                                <input type="text" name="value_delivery" id="delivery_value" class="form-control">           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><label>Data da entrega e da devolução das chaves</label></div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        {{-- <input type="text"  name="control_keys_date_exit" id="keys_date_exit" class="form-control" placeholder="Retirada"> --}}
                                        <input type="text"  name="control_keys_date_exit" value="{{ $carbon->format("d/m/Y H:i") }}" class="form-control" placeholder="Retirada">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" name="control_keys_date_devolution" required="" id="keys_date_devolution" class="form-control" placeholder="Devolução">
                                    </div>
                                    <span id="span_dev"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text"  name="control_keys_value_guarantee" class="form-control" id="control_keys_value_guarantee" value="20,00">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa  fa-key"></i></span>
                                    <input type="text" name="control_keys_key_number" class="form-control" required="true" value="{{ (isset($_GET['key']) ?  $_GET['key'] : '')   }}">
                                </div>
                            </div>
                        </div>
                        <br>  
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados do Visitante</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-7">
                                <label for="">Nome</label>
                                <input type="text" name="control_keys_visitor_name" class="form-control"  placeholder="Nome completo">
                            </div>
                            <div class="col-xs-4">
                                <label for="control_keys_visitor_cpf">CPF</label>
                                <input type="text" name="control_keys_cpf" id="keys_cpf" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="control_keys_visitor_email" class="form-control" placeholder="E-mail">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Fone Fixo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" name="control_keys_visitor_phone_one" id="keys_visitor_phone_one" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                        <input type="text" class="form-control" id="keys_visitor_phone_two" name="control_keys_visitor_phone_two">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="">CEP</label>
                                <input type="text" name="control_keys_visitor_cep"  id="control_keys_visitor_cep" class="form-control" onblur="requestCEP($(this).attr('name') , ['control_keys_visitor_address' , 'control_keys_visitor_district' , 'control_keys_visitor_city' , 'control_keys_visitor_state'] )" >
                            </div>
                            <div class="col-xs-7">
                                <label for="">Endereço</label>
                                <input type="text" class="form-control" name="control_keys_visitor_address" id="control_keys_visitor_address" placeholder="Rua/Av. Santos Dumont">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-4">
                                <label for="">Número</label>
                                <input type="number" class="form-control" name="control_keys_visitor_address"  id="control_keys_visitor_address" placeholder="1010">
                            </div>
                            <div class="col-xs-5">
                                <label for="">Complemento</label>
                                <input type="text" class="form-control" name="control_keys_visitor_complements" placeholder="Ap. 801, Bloco A">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-4">
                                <label for="">Bairro</label>
                                <input type="text" class="form-control" name="control_keys_visitor_district" id="control_keys_visitor_district">
                            </div>
                            <div class="col-xs-4">
                                <label for="">Cidade</label>
                                <input type="text" class="form-control" name="control_keys_visitor_city" id="control_keys_visitor_city">
                            </div>
                            <div class="col-xs-3">
                                <label for="">Estado</label>
                                <input type="text" class="form-control" name="control_keys_visitor_state" id="control_keys_visitor_state">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="">Anexar Identidade</label>
                            <input type="file" name="">
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-default">Voltar</button>
                        <a href="#confSaveKey" class="btn btn-primary pull-right" data-toggle="modal"> Salvar </a>
                    </div>
                    <!-- /.box-footer -->
                    @include('modal.modal_confirm_print')
                    {{Form::close()}}
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@push('scripts')
{{Html::script('public/plugins/input-mask/jquery.inputmask.js')}}
{{Html::script('public/plugins/input-mask/jquery.inputmask.date.extensions.js')}}
{{Html::script('public/plugins/input-mask/jquery.inputmask.extensions.js')}}
<!-- MAASCARA MONEY -->
{{Html::script('public/plugins/jquery/jquery.maskMoney.js')}}
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
{{Html::script('public/plugins/daterangepicker/daterangepicker.js')}}
{{Html::script('public/plugins/datepicker/bootstrap-datepicker.js')}}
{{Html::script('public/dist/js/key.js')}}
<script type="text/javascript"></script>
<script type="text/javascript">

    /* CEP */
    function requestCEP(campo_cep , campos)
    {
      $.ajax({
        url: "http://correiosapi.apphb.com/cep/"+$("#"+campo_cep).inputmask("unmaskedvalue"),
        dataType: 'jsonp',
        jsonp: 'callback',
        async: false,
        success: function(data){
          $("#"+campos[0]).val(data.tipoDeLogradouro + " " + data.logradouro);
          $("#"+campos[1]).val(data.bairro);
          $("#"+campos[2]).val(data.cidade);
          $("#"+campos[3]).val(data.estado);
    
        },
        statusCode: {
        200: function(data) { console.log(data); } // Ok
        ,400: function(msg) { console.log(msg);  } // Bad Request
        ,404: function(msg) { console.log("CEP não encontrado!!"); } // Not Found
      }
    });
    }
    
    //Datemask dd/mm/yyyy
    $("#control_keys_cep").inputmask("99.999-999", {"placeholder": "99.999-999"});
    $("#keys_cpf").inputmask("999.999.999-99", {});
      //$("#control_keys_visitor_state").inputmask("99.999-999",{"placeholder": "999.999.999-99"});
    $("#keys_visitor_phone_one").inputmask("(99) 9999-9999", {"placeholder": "(99) 9999-9999"});
    $("#keys_visitor_phone_two").inputmask("(99) 99999-9999", {"placeholder": "(99) 99999-9999"});
    $("#keys_visitor_cep").inputmask("99.999-999", {"placeholder": "99.999-999"});
    $("#control_keys_visitor_cep").inputmask("99.999-999", {"placeholder": "99.999-999"});


    $("#control_keys_value_guarantee").maskMoney({symbol:'',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
    $("#delivery_value").maskMoney({symbol:'',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
    
</script>
@push('daterangepicker')
@endpush
@endpush
@endsection
