@extends('layouts.admin_template')
@section('content')
{{ Html::style('dist/css/key.min.css') }}
{{ Html::style('plugins/jquery-timepicker/dist/jquery-ui-timepicker-addon.min.css') }}
<!-- Sidebar -->
@include('sidebar')
<script type="text/javascript">

</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "Controle de Chaves" }}
            <small>{{ $page_description or 'Reserva ou Visita' }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Imóveis</a></li>
            <li class="active">Controle de chaves/Visita</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reserva</h3>
                        <div class="box-tools pull-right">
                            <a href="{{url('chaves/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo </a>
                            <a href="#create_key" data-toggle="modal" class="btn btn-primary" title="Cadastrar Chave" id="modal_create_key">
                                <i class="fa fa-key"></i> Cadastrar Chaves
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#chaves" aria-controls="chaves" role="tab" data-toggle="tab">Chaves</a></li>
                                    <li role="presentation"><a href="#historico" aria-controls="historico" role="tab" data-toggle="tab">Histórico</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="chaves">
                                        <div class="col-md-12">
                                            <div class="table table-responsive margin">
                                                <table id="key_control" class="table display" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Cód. Chave</th>
                                                            <th>Ref. Imóvel</th>
                                                            <th>Status</th>
                                                            <th>Ação.</th>
                                                        </tr>
                                                    </thead>
                                                </table>

                                                @include('modal.modal_create_key')
                                                @include('modal.modal_create_immobile')
                                                @include('modal.modal_delete_key')

                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="historico">
                                        <div class="box-header ui-sortable-handle" style="cursor: move;">
                                            <i class="fa fa-history"></i>
                                            <h3 class="box-title">Pesquisar Histórico do imóvel</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input class="form-control" name="code_key_immobile" id="code_key_immobile" placeholder="Codigo do Imóvel ou da Chave">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-success" id="search_key_immobile"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="history_key_immobile">
                                                <thead>
                                                    <tr>
                                                        <th>Cod Chave</th>
                                                        <th>Cod Imóvel</th>
                                                        <th>Data Retirada</th>
                                                        <th>Data Dev. Prevista</th>
                                                        <th>Visitante</th>
                                                        <th>Status</th>
                                                        <th>Ação</th>
                                                    </tr>
                                                </thead>
                                            </table>

                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('modal.modal_edit_key')
        @include('modal.modal_evaluation')
        @include('modal.modal_reserve_key')
        @include('modal.modal_confirm_print')
        @include('modal.modal_update_code_key')
    </section>
</div>
<!-- /.content-wrapper -->
@push('scripts')
{{ Html::script('plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('plugins/datatables/dataTables.bootstrap.min.js') }}
{{ Html::script('plugins/jquery-serializejson/jquery.serializejson.min.js') }}
{{ Html::script('plugins/input-mask/jquery.inputmask.js') }}
{{ Html::script('plugins/input-mask/jquery.inputmask.date.extensions.js') }}
{{ Html::script('plugins/input-mask/jquery.inputmask.extensions.js') }}
{{ Html::script('plugins/combo-select/jquery.combo.select.js') }}
{{ Html::script('dist/js/moment.min.js') }}
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.js"></script>
{{-- <script src="https://gist.github.com/fernandosavio/680a2549e417befea930.js"></script> --}}
{{ Html::script('plugins/jquery-timepicker/dist/jquery-ui-timepicker-addon.min.js') }}
{{ Html::script('plugins/jquery-maskmoney/src/jquery.maskMoney.js') }}
{{ Html::script('dist/js/mascaraFone.js') }}
{{ Html::script('dist/js/key.js') }}
<script type="text/javascript">

$(document).ready(function() {
    
});

$(function () {
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });

    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });


    //Evita que o formulário seja enviado.
    // $('form').submit(function(event) {
    //     event.preventDefault();
    //     return false;
    // });
    // $('#form_conf_print').submit(function(event) {
    //     event.preventDefault();
    //     return true;
    // })
});
</script>
@endpush
@endsection
