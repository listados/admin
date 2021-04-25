@extends('layouts.admin_template')

@section('content')


<!-- Sidebar -->
@include('sidebar')

<link rel="stylesheet" href="{{ asset('dist/css/immobile.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/key.min.css') }}">
<style>
    #map {
    height: 400px;
    width: 100%;
    }
    .item img{
    max-height: 250px;
    }
    .errorValidate{
        border-color: red;
    }
    .image_align{
        max-width: 140px;
        max-height: 100px;
        margin-bottom: 40px;
       
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            {{ $page_title or "Imóveis" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li class="active">Imóvel</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('messages.general')
        </div>
           <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Todos Imóveis</h3>
                    <div class="box-tools pull-right">
                        {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button> --}}
                        <div class="btn-group">
                            <a type="button" class="btn btn-box-tool" id="Controle de chave" href="{{ url('chaves') }}"><i class="fa fa-key"></i></a>
                            <a href="#create_key" class="btn btn-box-tool" data-toggle="modal" title="Cadastro de Chave"><i class="fa fa-plus-circle"></i></a>
                            <a type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></a>
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#create_immobile" data-toggle="modal" title="Cadastrar Imóvel" id="modal_create_key">Cadastrar Imóvel</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">

                        @include('modal.modal_create_immobile')
                        @include('modal.modal_create_key')
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped display" id="table_immobile">
                                    <thead>
                                        <tr>
                                            <th>Código Imóvel</th>
                                            <th>Tipo</th>
                                            <th>Endereço</th>
                                            <th>Complemento</th>
                                            <th>Bairro</th>
                                            <th>Condomínio</th>
                                            <th>Locação</th>
                                            <th>Finalidade</th>
                                            <th>Status</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                
                <!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <strong><small id="total_active" class="text-primary">Total Ativos:</small></strong> 
                            @include('modal.modal_alter_status_immobile')
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>

@include('modal.modal_details_immobiles')
@include('modal.modal_reserve_key')
</section>
</div><!-- /.content-wrapper -->

@push('scripts')

{{ Html::script('dist/js/immobile.min.js') }}

{{ Html::script('dist/js/key.min.js') }}

<script type="text/javascript">
$(function () {
    loadTableImmobile();
});

</script>
@endpush

@endsection
