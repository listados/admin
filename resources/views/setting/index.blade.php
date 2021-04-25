@extends('layouts.admin_template')
@section('content')

 <script type="text/javascript" src="{{ url('dist/js/crud_survey.js') }}"></script>
 
<!-- Sidebar -->
@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ $page_title or "CONFIGURAÇÃO" }}
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
      <li class="active">Configurações
      </li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    @if ( Session::has('mensagem'))
    <div class="alert alert-info">
      {{ Session::get('mensagem') }}
    </div>
    @endif
    <div class="row">
      @include('setting.menu_setting')
      <!-- /.col -->
      <div class="col-md-9">
        <div class="box box-default">
          <div class="row">
            <div class="col-md-12" >
              <h3 class="page-header">
                <i class="fa fa-info-circle" aria-hidden="true">
                </i> Informações gerais
              </h3>
            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                <div class="info-box bg-yellow">
                  <span class="info-box-icon">
                    <i class="fa fa-bar-chart" aria-hidden="true">
                    </i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Vistoria
                    </span>
                    <span class="info-box-number">{{ $count_survey }}
                    </span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 50%">
                      </div>
                    </div>
                    <span class="progress-description">
                      Cod última Vistoria: 
                      @if(empty($last_survey->survey_id))
                        {{'Nao tem dados'}}
                      @else
                        {{$last_survey->survey_id}}
                      @endif
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </div>
              <div class="col-md-4">
                <div class="info-box bg-green">
                  <span class="info-box-icon">
                    <i class="fa fa-exchange" aria-hidden="true">
                    </i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Vistoria Finalizada
                    </span>
                    <span class="info-box-number">{{ count($fininality) }}
                    </span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 50%">
                      </div>
                    </div>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </div>
              <div class="col-md-4">
                <div class="info-box bg-red">
                  <span class="info-box-icon">
                    <i class="fa fa-list-alt" aria-hidden="true">
                    </i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Vistoria rascunho
                    </span>
                    <span class="info-box-number">{{ count($draft) }}
                    </span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 50%">
                      </div>
                    </div>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </div>
            </div>
          </div>{{-- FIM ROW --}}
          <div class="row">
            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Cadastrar Ambiente
                  </h3>
                </div>
                <div class="box-body">
                  <p class="margin">Nome Ambiente
                    <code>Ex: Quarto 01, Cozinha, Varanda, Suite
                    </code>
                  </p>
                  <div class="input-group input-group-sm">
                    <input type="text" name="ambience_name" id="ambience_name" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" id="saveAmbiente" class="btn btn-info btn-flat">Salvar!
                      </button>
                    </span>
                  </div>
                  <!-- /input-group -->
                  <div class="box-footer">
                    <div id="sucess_ambiente">
                      <span class="label label-success" style="padding: 10px;">Ambiente cadastrado com sucesso
                      </span>
                    </div>
                    <div id="delete_ambiente_success">
                      <span class="label label-info" style="padding: 10px;">Ambiente EXCLUIDO com sucesso
                      </span>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <div class="col-md-6">
              <!-- DIRECT CHAT -->
              <div class="box direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Todos Ambiente
                  </h3>
                  <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3
                    </span>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <div class="direct-chat-msg">
                       <table class="table table-bordered" id="table_data_ambience">
                        <thead>
                          <tr>
                            <th>Nome
                            </th>
                            <th>Excluir
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <script>
                            getAmbience();
                          </script>
                        </tbody>
                      </table>
                    </div>
                  </div>
                 
                  <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>
          </div>
        </div>
          </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

    @push('scripts')
       
    @endpush
    @endsection