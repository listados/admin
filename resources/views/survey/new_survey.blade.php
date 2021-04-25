@extends('layouts.admin_template')
@section('content')
<!-- INCLUSÃO DOS ARQUIVOS COMUN ENTRE AS PÁGINAS DA VISTORIA -->
@include('survey.files_all_survey')

<style>
  .no-close .ui-dialog-titlebar-close {
    display: none 
  };
</style>
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- ADICIONAR USUÁRIOS -->
      <script type="text/javascript" src="{{ asset('dist/js/new_add_user.js') }}"></script>  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    {{ Form::hidden('id_vistoria' , $id, ['id' => 'id_vistoria']) }}
    <h1>
      {{ $page_title or $title_survey }}
      <small>{{ $page_description or null }}
      </small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
      <li>
        <a href="#">
          <i class="fa fa-dashboard">
          </i> Menu
        </a>
      </li>
      <li>Imoveis
      </li>
      <li>{{ link_to('vistoria', $title = 'Vistorias', $attributes = array(), $secure = null)}}
      </li>
      <li class="active">Nova Vistoria
      </li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    @include('messages.success_upload_ambience')
    @include('messages.success_upload_360')
<form action="" method="" id="form_survey">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Dados da Vistoria 
        </h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar / Minimizar">
            <i class="fa fa-minus">
            </i>
          </button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
            <div class="container" >
                <div class='elementOccupant' id='div_1'>
                    <a href="#" class="btn btn-default margin btn-flat add" id="" onclick="addUserSurvey('elementOccupant', 'div', 'container', 'remove' , 'locator')" title="Adiciona novo locador dinamicamente"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Locador</a>
                </div>
            </div>

            <div id="occupant">                       
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nome do Locador 
                </label>
                <input type="text" name="survey_locator_name[]" id="nome_locador" value=""  placeholder="Nome do Locador" class="form-control">            
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">CPF ou CNPJ do Locador
                </label>
                <input type="text" name="survey_locator_cpf[]"  value="" placeholder="CPF do Locador" class="form-control" id="cpf_locador"  >
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="">E-mail do Locador
                </label>
                <input type="text" name="survey_locator_email[]" id="survey_locator_email" value="" placeholder="E-mail do Locador" class="form-control">
              </div>
            </div>
            <div class="col-md-12">
                <div class="containerLocatario" >
                    <div class='elementLocatario' id='divLocatario_1'>
                        <a href="#" class="btn btn-default margin btn-flat addLocatario" onclick="addUserSurvey('elementLocatario', 'divLocatario', 'containerLocatario', 'removeLocatario' , 'occupant')" id="" title="Adiciona novo Locatário dinamicamente"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Locatário</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nome do Locatário 
                </label>
                <input type="text" name="survey_occupant_name[]" id="survey_occupant_name"  placeholder="Nome do locatário" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">CPF ou CNPJ do Locatário
                </label>
                <input type="text" name="survey_occupant_cpf[]"   placeholder="CPF do locatário" class="form-control" id="cpf_locatario"  >
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="">E-mail do Locatário
                </label>
                <input type="text" name="survey_occupant_email[]"  placeholder="E-mail do locatário" class="form-control">
              </div>
            </div>
            <div id="loc">                       
            </div>
            <div class="containerFiador" >
                   <div class="divider"> <hr></div>
                <div class="col-md-12">
                    <div class='elementFiador' id='divFiador_1'>
                        <a href="#" class="btn btn-default margin btn-flat addFiador" onclick="addUserSurvey('elementFiador', 'divFiador', 'containerFiador', 'removeFiador' , 'guarantor')" id="" title="Adiciona novo Fiador dinamicamente"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Fiador</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nome do Fiador
                </label>
                <input type="text" name="survey_guarantor_name[]" id="survey_occupant_name" value=""  placeholder="Nome do locatário" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">CPF ou CNPJ do Fiador
                </label>
                <input type="text" name="survey_guarantor_cpf[]" value=""  placeholder="CPF do locatário" class="form-control" id="cpf_locatario">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="">E-mail do fiador
                </label>
                <input type="text" name="survey_guarantor_email[]" value=""  placeholder="E-mail do locatário" class="form-control">
              </div>
            </div>
            
            <div id="div_fiador"></div>
            


            <div class="col-md-12">
              <hr>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Nome do vistoriador
                </label>
                <input type="text" name="survey_inspetor_name" id="survey_inspetor_name"  value="{{ Auth::user()->name }}" placeholder="Nome do Vistoriador" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">CPF ou CNPJ do vistoriador
                </label>
                <input type="text" name="survey_inspetor_cpf"  placeholder="CPF do Vistoriador" class="form-control" id="cpf_vistoriador" value="{{ Auth::user()->cpf }}"  >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Data da vistoria
                </label>
                <input type="text" name="survey_date" class="form-control" id="data_vistoria" 
                       value="{{ date("d/m/Y") }}" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Tipo
                </label>
                <select class="form-control" name="survey_type" id="survey_type">
                  <option value="Não informado" selected="selected">--Selecione--
                  </option>
                  <option>Alteração
                  </option>
                  <option>Entrada
                  </option>
                  <option>Saída
                  </option>
                </select>
              </div>
            </div>
            </div>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Dados do imóvel
          </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus">
              </i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="">Endereço do imóvel
                </label>
                <input type="text" name="survey_address_immobile" id="survey_address_immobile" value="" placeholder="Endereço do imóvel" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Tipo do imóvel
                </label>
                <select class="form-control" name="survey_type_immobile" id="survey_type_immobile">
                  <option value="Não informado" selected="selected">--Selecione--
                  </option>
                     @include('survey.type_immobile')
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Medidor de energia
                </label>
                <input type="text" name="survey_energy_meter" id="survey_energy_meter"  value="" placeholder="Medidor de energia" class="form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Leitura de Energia
                </label>
                <input type="text" name="survey_energy_load" id="survey_energy_load"   placeholder="Leitura de Energia" class="form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Medidor de água
                </label>
                <input type="text" name="survey_water_meter" id="survey_water_meter"  placeholder="Medidor de água" class="form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Leitura de água
                </label>
                <input type="text" name="survey_water_load" id="survey_water_load"  placeholder="Leitura de água" class="form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Medidor de gás
                </label>
                <input type="text" name="survey_gas_meter" id="survey_gas_meter"   placeholder="Medidor de gás" class="form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Leitura do gás
                </label>
                <input type="text" name="survey_gas_load" id="survey_gas_load"  placeholder="Leitura do gás" class="form-control">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM DADOS IMOVEIS --> 
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Aspectos Gerais
            <small>Descreva os detalhes de todos os ambientes do imóvel
            </small>
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
          <textarea id="editor_aspect" name="survey_general_aspects" rows="10" cols="80">
            @if($title_survey == 'Nova Vistoria')
            {!! $settings[0]->settings_aspect_general !!}
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
              <i class="fa fa-minus">
              </i>
            </button>
          </div>
          <!-- /. tools -->
        </div>
        <div class="box-body pad">
          <textarea id="editor_reservation" name="survey_reservation" rows="10" cols="80">
          
            {!! $settings[0]->settings_reservation !!}
           
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
            @if($title_survey == 'Nova Vistoria')
            {!! $settings[0]->settings_provisions !!}
            @endif
          </textarea>
        </div>
      </div>

      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Chaves 
            <small>(e outros itens móveis)
            </small> 
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
          <textarea id="editor_keys" name="survey_keys" rows="10" cols="80">
            @if($title_survey == 'Nova Vistoria')
            {!! $settings[0]->settings_keys !!}
            @endif
          </textarea>
        </div>
      </div>
 
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Upload do ambiente
          </h3>
        </div>
        <div class="box-body">
          <div class="pull-left">
            <button type="button" class="btn btn-primary" data-toggle="modal" 
                    data-target="#modal_ambience">
              <i class="fa fa-upload" aria-hidden="true">
              </i> Fotos Gerais 
            </button>
          </div>
          <div class="col-md-12">
          <hr>
          <div class="form-group">
            <label for="">Link do tour
            </label>
            <input type="text" name="survey_link_tour" placeholder="Digite o link do tour virtual já feito" class="form-control">
          </div>
        </div>
        </div>
      </div>
      <div class="box-footer clearfix">
        @if($title_survey === 'Replicando Vistoria')
        <input type="hidden" name="survey_id"  value="{{ $survey_reply->survey_id }}">
        @else
        <input type="hidden" name="survey_id"  value="{{ $survey_update->survey_id }}">
        @endif
        @if($title_survey === 'Nova Vistoria')
        <input type="hidden" name="survey_id"  value="{{$id}}">
        <button type="button"  class="btn btn-success btn-lg btn-flat pull-left disabled"> 
          <i class="fa fa-check-circle" aria-hidden="true">
          </i> Finalizar Rascunho
        </button>
        @elseif($title_survey === 'Editar Vistoria')
        <input type="hidden" name="survey_id"  value="{{ $survey_update->survey_id }}">
        <button type="button" class="btn btn-success btn-lg pull-left btn-flat"  id="completed_button"> 
          <i class="fa fa-check-circle" aria-hidden="true">
          </i> Finalizar Rascunho
        </button>
        @endif
        @if($title_survey == "Nova Vistoria")
        <input type="hidden" name="type_survey"  value="{{ $title_survey }}">
        @elseif ($title_survey == "Editar Vistoria")
        <input type="hidden" name="type_survey"  value="{{ $title_survey }}">
        @endif
        <button type="button" class="btn btn-primary btn-lg pull-right btn-flat" id="save_button" > 
          <i class="fa fa-save"> Salvar Rascunho
          </i> 
        </button>
        <input type="hidden" name="survey_status" value="" id="survey_status">
      </div>
      </section>
    </form>
</div>
@include('modal.survey_ambience_upload')
@push('scripts')

<script type="text/javascript" src="{{ asset('dist/js/upload_ambience.min.js') }}"></script>
@endpush

<!-- /.content-wrapper -->
@endsection