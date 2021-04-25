@extends('layouts.admin_template')
@section('content')
<!-- INCLUSÃO DOS ARQUIVOS COMUN ENTRE AS PÁGINAS DA VISTORIA -->
@include('survey.files_all_survey')


<style type="text/css">
.no-close .ui-dialog-titlebar-close {display: none };
hr.style13 {
    height: 10px;
    border: 0;
    box-shadow: 0 10px 10px -10px #8c8b8b inset;
}            
</style>

<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <script type="text/javascript" src="{{ asset('dist/js/new_add_user.js') }}"></script>   
    <section class="content-header">
        <h1>
            {{ $page_title or $title_survey }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li>Imoveis</li>
            <li>{{ link_to('vistoria', $title = 'Vistorias', $attributes = array(), $secure = null)}}</li>
            <li class="active">Editar Vistoria</li>
        </ol>
    </section>
    <!-- Main content -->
    <form action="" method="" id="form_survey" >
        <section class="content">
            @include('messages.success_upload_ambience')
            @include('messages.success_upload_360')
            @include('messages.error')
            @include('messages.error_message')
            @include('messages.success')
            @include('messages.info')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dados da Vistoria {{$id_survey}} </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="container" >
                            <div class='elementOccupant' id='div_1'>
                                <a href="#" class="btn btn-default margin btn-flat add" id="" onclick="addUserSurvey('elementOccupant', 'div', 'container', 'remove' , 'locator')" title="Adiciona novo locador dinamicamente"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Locador</a>
                            </div>
                        </div>
                        {{-- ADD NOVO LOCADOR --}}
                        <div id="occupant"></div>
                        @foreach(@$survey_update as $dados)    
                        @if(@$dados->relation_survey_user_type == 'Locador')    
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="hidden" name="id_user[]" value="{{ $dados->id }}">    
                                <label for="">Nome do Locador </label>
                                <input type="text" name="survey_locator_name[]" id="nome_locatario" value="{{ $dados->name }}" placeholder="Nome do Locador" class="form-control">            
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">CPF ou CNPJ</label>
                                <input type="text" name="survey_locator_cpf[]"  value="{{ $dados->relation_survey_user_cpf }}" placeholder="CPF ou CNPJ do Locador" class="form-control" id="cpf_locador">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">E-mail do Locador</label>
                                <div class="input-group">
                                    <input type="text"  name="survey_locator_email[]" id="survey_locator_email" value="{{$dados->email }}" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button"  onclick="deleteUserSurvey({{ $dados->id }},  {{ $id_survey }})" class="btn btn-primary btn-flat"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        @endif
                        @endforeach
                    </div>

                    <hr class="style13">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="containerLocatario" >
                                <div class='elementLocatario' id='divLocatario_1'>
                                    <a href="#" class="btn btn-default margin btn-flat addLocatario" onclick="addUserSurvey('elementLocatario', 'divLocatario', 'containerLocatario', 'removeLocatario' , 'occupant')" id="" title="Adiciona novo Locatário dinamicamente"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Locatário</a>
                                </div>
                            </div>
                        </div>
                    @foreach(@$survey_update as $dados)  
                    @if(@$dados->relation_survey_user_type == 'Locatário')    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nome do Locatário </label>
                            <input type="hidden" name="id_user_occupant[]" value="{{ $dados->id }}">  
                            <input type="text" name="survey_occupant_name[]" id="survey_occupant_name" value="{{ $dados->name }}"  placeholder="Nome do locatário" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">CPF ou CNPJ do Locatário</label>
                            <input type="text" name="survey_occupant_cpf[]" value="{{ $dados->relation_survey_user_cpf }}"  placeholder="CPF ou CNPJ do locatário" class="form-control" id="cpf_locatario" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">E-mail do Locatário</label>
                            <input type="text" name="survey_occupant_email[]" id="survey_occupant_email" value="{{ $dados->email }}"  placeholder="E-mail do locatário" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Excluir</label>
                            <a href="#" onclick="deleteUserSurvey({{ $dados->id }},  {{ $id_survey }})">
                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                            </a> 
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="containerFiador" >
                           <div class="divider"> <hr></div>
                        <div class="col-md-12">
                            <div class='elementFiador' id='divFiador_1'>
                                <a href="#" class="btn btn-default margin btn-flat addFiador" onclick="addUserSurvey('elementFiador', 'divFiador', 'containerFiador', 'removeFiador' , 'guarantor')" id="" title="Adiciona novo Fiador dinamicamente"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Fiador</a>
                            </div>
                        </div>
                    </div>
                @php
                        //INICIANDO A VARIAVEL BOOLEAN
                $exist_guarantor = false; 
                @endphp 
                @foreach($survey_update as $dados)    
                @if($dados->relation_survey_user_type == 'Fiador')   
                @php $exist_guarantor = true; @endphp
               
                <div class="col-md-4">
                    <div class="form-group">
                         <label for="">Nome do Fiador</label>
                        <input type="hidden" name="id_user_guarantor[]" value="{{ $dados->id }}">  
                        <input type="text" name="survey_guarantor_name[]" value="{{ $dados->name }}" id="survey_guarantor_name" placeholder="Nome do locatário" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">CPF ou CNPJ do Fiador</label>
                        <input type="text" name="survey_guarantor_cpf[]" value="{{ $dados->relation_survey_user_cpf }}" id="survey_guarantor_cpf" placeholder="CPF ou CNPJ do Fiador" class="form-control" id="cpf_locatario">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">E-mail do Fiador</label>
                        <input type="text" name="survey_guarantor_email[]" value="{{ $dados->email }}" id="survey_guarantor_email" placeholder="E-mail do locatário" class="form-control">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">Excluir</label>
                        <a href="#" onclick="deleteUserSurvey({{ $dados->id }},  {{ $id_survey }})">
                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                        </a> 
                    </div>
                </div>
                @endif

                @endforeach

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <hr>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nome do Vistoriador</label>
                        <input type="text" name="survey_inspetor_name" id="survey_inspetor_name"  value="{{ $survey_update[0]->survey_inspetor_name }}" placeholder="Nome do Vistoriador" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">CPF do Vistoriador</label>

                        <input type="text" name="survey_inspetor_cpf"  value="{{$survey_update[0]->survey_inspetor_cpf  }}" placeholder="CPF do Vistoriador" class="form-control" id="cpf_vistoriador">

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Data</label>
                        @if(!empty(@$survey_update[0]->survey_date))
                        <input type="text" name="survey_date" class="form-control" id="data_vistoria" 
                        value="{{ date("d/m/Y" , strtotime(@$survey_update[0]->survey_date)) }}" >
                        @endif
                        @if(empty(@$survey_update[0]->survey_date))
                        <input type="text" name="survey_date" class="form-control" id="data_vistoria" 
                        value="{{ date("d/m/Y" , strtotime(@$survey_update[0]->survey_date)) }}" >
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Tipo</label>
                        <select class="form-control" name="survey_type" id="survey_type">
                                    {{-- 
                                    <option selected="selected">{{ ($title_survey == 'Editar Vistoria') ? $survey_update[0]->survey_type : '' }}</option>
                                    --}}
                                    @if(!empty($survey_update[0]->survey_type))
                                    <option value="{{ $survey_update[0]->survey_type }}">{{ $survey_update[0]->survey_type }}</option>
                                    @endif
                                    <option value="Não Informado">--Selecione--</option>
                                    <option>Alteração</option>
                                    <option>Entrada</option>
                                    <option>Saída</option>
                                </select>
                            </div>
                        </div>
                    </div><!-- fim col-md-12 -->
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dados do imóvel</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Endereço do imóvel</label>
                                <?php
                                $survey_address = DB::table('survey')->where('survey_id' , $id_survey)->first();
                                ?>
                                <input type="text" name="survey_address_immobile" id="survey_address_immobile" 
                                value="{{ $survey_address->survey_address_immobile }}" placeholder="Endereço do imóvel" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tipo do imóvel</label>
                                <select class="form-control" name="survey_type_immobile" id="survey_type_immobile">
                                    @if(!empty($survey_update[0]->survey_type_immobile))
                                    <option value="{{ $survey_update[0]->survey_type_immobile }}">{{ $survey_update[0]->survey_type_immobile }}</option>
                                    @endif
                                    <option>--Selecione--</option>
                                    @include('survey.type_immobile')
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Medidor de energia</label>
                                @if(!empty($survey_update->survey_energy_meter))
                                <input type="text" name="survey_energy_meter" id="survey_energy_meter"  value="{{ $survey_update->survey_energy_meter }}" placeholder="Medidor de energia" class="form-control">
                                @else
                                <input type="text" name="survey_energy_meter" id="survey_energy_meter"  value="{{ $survey_update[0]->survey_energy_meter }}" placeholder="Medidor de energia" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Leitura de Energia</label>
                                @if(!empty($survey_update->survey_energy_load))
                                <input type="text" name="survey_energy_load" id="survey_energy_load"  value="{{ $survey_update->survey_energy_load }}" placeholder="Leitura de Energia" class="form-control">
                                @else
                                <input type="text" name="survey_energy_load" id="survey_energy_load"  value="{{ $survey_update[0]->survey_energy_load }}" placeholder="Leitura de Energia" class="form-control">
                                @endif
                                {{--   --}}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Medidor de água</label>
                                @if(!empty($survey_update->survey_water_meter))
                                <input type="text" name="survey_water_meter" id="survey_water_meter"  value="{{ $survey_update->survey_water_meter }}" placeholder="Medidor de água" class="form-control">
                                @else
                                <input type="text" name="survey_water_meter" id="survey_water_meter"  value="{{ $survey_update[0]->survey_water_meter }}" placeholder="Medidor de água" class="form-control">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Leitura de água</label>
                                @if(!empty($survey_update->survey_water_load))
                                <input type="text" name="survey_water_load" id="survey_water_load"  value="{{ $survey_update->survey_water_load }}" placeholder="Leitura de água" class="form-control"> 
                                @else
                                <input type="text" name="survey_water_load" id="survey_water_load"  value="{{ $survey_update[0]->survey_water_load }}" placeholder="Leitura de água" class="form-control"> 
                                @endif
                                {{----}}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Medidor de gás</label>
                                @if(!empty($survey_update->survey_gas_meter))
                                <input type="text" name="survey_gas_meter" id="survey_gas_meter"  value="{{ $survey_update->survey_gas_meter }}" placeholder="Medidor de gás" class="form-control"> 
                                @else
                                <input type="text" name="survey_gas_meter" id="survey_gas_meter"  value="{{ $survey_update[0]->survey_gas_meter }}" placeholder="Medidor de gás" class="form-control">
                                @endif
                                {{--  --}}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Leitura do gás</label>
                                @if(!empty($survey_update->survey_gas_load))
                                <input type="text" name="survey_gas_load" id="survey_gas_load"  value="{{ $survey_update->survey_gas_load }}" placeholder="Leitura do gás" class="form-control">
                                @else
                                <input type="text" name="survey_gas_load" id="survey_gas_load"  value="{{ $survey_update[0]->survey_gas_load }}" placeholder="Leitura do gás" class="form-control">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIM DADOS IMOVEIS --> 
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Aspectos Gerais
                        <small>Descreva os detalhes de todos os ambientes do imóvel</small>
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Maximizar / Minimizar">
                            <i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body pad">
                        <textarea id="editor_aspect" name="survey_general_aspects" rows="10" cols="80">
                            @if(!empty($survey_update->survey_general_aspects))
                            {!! $survey_update->survey_general_aspects !!}
                            @else
                            {!! $survey_update[0]->survey_general_aspects !!}
                            @endif
                        </textarea>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Ressalvas por Ambientes / Cômodos
                        </h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Maximizar / Minimizar">
                                <i class="fa fa-minus"></i></button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <div class="box-body pad">
                            <textarea id="editor_reservation" name="survey_reservation" rows="10" cols="80">
                                @if(!empty($survey_update->survey_reservation))
                                {!! $survey_update->survey_reservation !!}
                                @else
                                {!! $survey_update[0]->survey_reservation !!}
                                @endif
                            </textarea>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Chaves <small>(e outros itens móveis)</small> 
                            </h3>
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Maximizar / Minimizar">
                                    <i class="fa fa-minus"></i></button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="box-body pad">
                                <textarea id="editor_keys" name="survey_keys" rows="10" cols="80">
                                    @if(!empty(@$survey_update->survey_keys))
                                    {!! @$survey_update->survey_keys !!}
                                    @else
                                    {!! @$survey_update[0]->survey_keys !!}
                                    @endif    
                                </textarea>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Disposições Gerais
                                </h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Maximizar / Minimizar">
                                        <i class="fa fa-minus">
                                        </i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="box-body pad">
                                <textarea id="editor_provisions" name="survey_provisions" rows="10" cols="80">
                                    {!! $survey_update[0]->survey_provisions !!}
                                </textarea>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Upload do ambiente</h3>
                            </div>
                            <div class="box-body">
                                <div class="pull-left">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" 
                                    data-target="#modal_ambience"><i class="fa fa-upload" aria-hidden="true"></i> Fotos Gerais 
                                </button>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="form-group">
                                    <label for="">Link do tour
                                    </label>
                                    <input type="text" name="survey_link_tour" value="{{$survey_update[0]->survey_link_tour}}" placeholder="Digite o link do tour virtual já feito" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        @if($title_survey === 'Replicando Vistoria')
                        <input type="hidden" name="survey_id"   value="{{ $survey_reply->survey_id }}">
                        @endif
                        @if($title_survey === 'Nova Vistoria')
                        <input type="hidden" name="survey_id"  id="new" value="{{base64_decode($id)}}">
                        <button type="button"  class="btn btn-success btn-lg btn-flat pull-left disabled"> <i class="fa fa-check-circle" aria-hidden="true"></i> Finalizar Rascunho</button>
                        @elseif($title_survey === 'Editar Vistoria')
                        <input type="hidden" name="survey_id" id="edit"  value="{{base64_decode($id)}}">
                        <button type="button" class="btn btn-success btn-lg pull-left btn-flat"  id="completed_button"> <i class="fa fa-check-circle" aria-hidden="true"></i> Finalizar Rascunho</button>
                        @endif
                        @if($title_survey == "Nova Vistoria")
                        <input type="hidden" name="type_survey"  value="{{ $title_survey }}">
                        @elseif ($title_survey == "Editar Vistoria")
                        <input type="hidden" name="type_survey"  value="{{ $title_survey }}">
                        <input type="hidden" name="survey_id"  value="{{base64_decode($id)}}">
                        @endif
                        @if($title_survey == "Replicando Vistoria")
                        <input type="hidden" name="type_survey"  value="{{ $title_survey }}">
                        @endif
                        <button type="button" class="btn btn-primary btn-lg pull-right btn-flat" id="save_button" > <i class="fa fa-save"> Salvar Rascunho</i> </button>
                        <input type="hidden" name="survey_status" value="" id="survey_status">
                    </div>
                </section>
            </form>
        </div>
        @include('modal.survey_ambience_upload')
        <div class="col-md-12">
            <div id="dialog-confirm" title="Excluir usuário" style="background: #dd4b39; color: #fff;">
                <p><span class="ui-icon ui-icon-alert" style="float:left;"></span>
                    Deseja realmente excluir?
                </p>
            </div>
        </div>


        @push('scripts')

        <script type="text/javascript" src="{{ url('plugins/dropzone/src/dropzone.js') }}"></script>
        <script type="text/javascript" src="{{ url('dist/js/upload_ambience.js') }}"></script>
        @endpush
        @endsection
