@extends('layouts.admin_template')
@section('content')
<!--PARA A MANIPULAÇÃO DE ORDENS NA TABELA-->
{{ Html::style('/public/plugins/datatables/dataTables.bootstrap.css') }}
{{ Html::script('public/plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('public/plugins/datatables/dataTables.bootstrap.min.js') }}
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "HISTÓRICO DE VISTORIA" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i> Imóveis</a></li>
            <li><a href="{{url('vistoria')}}"><i class="fa fa-dashboard"></i> Vistória</a></li>
            <li class="active">Histórico </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if ( Session::has('mensagem'))
        <div class="alert alert-info">
            {{ Session::get('mensagem') }}
        </div>
        @endif
        <div class="box box-header">
            <label for="">Histórico da Vistoria {{$history[0]->history_survey_id_survey}}</label>
        </div>
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
                <!-- /.box -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- DIRECT CHAT -->
                        <div class="box box-warning direct-chat direct-chat-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Histórico de Vistoria</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- CONTEUDO DO HISTORICO DE VISTORIA -->
                                <div class="direct-chat-messages">
                                    @foreach($history as $historys)
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left">{{$historys->nick}}</span>
                                            <span class="direct-chat-timestamp pull-right">
                                            @if($historys->history_survey_date == '0000-00-00 00:00:00' || $historys->history_survey_date == NULL)
                                            @else
                                            {{date("d/m/Y H:i:s" , strtotime($historys->history_survey_date)) }}
                                            @endif
                                            
                                            </span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="{{url('public/dist/img/upload/profile/'.$historys->avatar)}}" alt="message user image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            {{$historys->history_survey_action}}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    @endforeach
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
                    <!-- /.col -->
                    <div class="col-md-6">
                        <!-- USERS LIST -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Histórico de Contestação</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="col-md-12">
                                    <!-- Custom Tabs (Pulled to the right) -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs pull-right">
                                            <li class="active"><a href="#tab_1-1" data-toggle="tab">Histórico</a></li>
                                            <li><a href="#tab_2-2" data-toggle="tab">Contestar</a></li>
                                            <li class="pull-left header"><i class="fa fa-th"></i></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1-1">
                                             The European languages are members of the same family. Their separate existence is a myth.
                                                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                                new common language would be desirable: one could refuse to pay expensive translators. To
                                                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                                words. If several languages coalesce, the grammar of the resulting language is more simple
                                                and regular than that of the individual languages.
                                               
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_2-2">
                                                <div class="input-group">
                                                    <textarea name="" id="" cols="65" rows="10" form="form-control" placeholder="Descreva o que você não concorda com a vistoria"></textarea>
                                                </div>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger btn-flat">Salvar Contestação</button>
                                                </span>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- nav-tabs-custom -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!--/.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>
<!-- /.content-wrapper -->
<script>
    $(function () {
      $("#example1").DataTable();
      $('#table-vistoria').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
</script>
@endsection
