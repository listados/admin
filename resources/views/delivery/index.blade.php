@extends('layouts.admin_template')
@section('content')
<!-- Sidebar -->
@include('sidebar')
{{ Html::style('/plugins/datatables/dataTables.bootstrap.css') }}
<style type="text/css">
    .label_form{
    font-size: 18px;
    font-weight: inherit;
    }
</style>
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
        <li>Configurações</li>
        <li class="active">Delivery</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    @include('messages.message_general')
    <div class="row">
        @include('setting.menu_setting')
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-default">
                <div class="row">
                    <div class="col-md-12" >
                        <div class="row page-header">
                            <div class="col-md-12">
                                <label>Delivery</label>
                                {!! Html::decode(link_to('#','<i class="fa fa-plus" aria-hidden="true"></i>',['data-toggle' => 'modal' , 'data-target' => '#add_delivery', 'title' => 'Cadastrar Delivery', 'class' => 'btn pull-right btn-primary'])) !!}
                            </div>
                        </div>    
                            @include('modal.modal_create_delivery')
                            <div class="box-body">
                                <table class="table table-bordered display" id="delivery-table">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nome</th>
                                            <th>Fone</th>
                                            <th>Celuar</th>
                                            <th>CPF</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                                {{-- @include('modal.modal_delete_ajax') --}}
                                @include('modal.modal_edit_delivery')
                            </div>
                        
                    </div>
                    {{-- FIM ROW --}}
                </div>
            </div>
        </div>
</section>
</div>
<!-- /.content-wrapper -->
@push('scripts')

{{ Html::script('plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('plugins/datatables/dataTables.bootstrap.min.js') }}
{{ Html::script('plugins/jquery-serializejson/jquery.serializejson.min.js') }}

{{Html::script('plugins/input-mask/jquery.inputmask.js')}}
{{Html::script('plugins/input-mask/jquery.inputmask.date.extensions.js')}}
{{Html::script('plugins/input-mask/jquery.inputmask.extensions.js')}}

{{ Html::script('dist/js/key.min.js') }}
{{ Html::script('dist/js/delivery.js') }}
{{ Html::script('dist/js/function_all.js') }}


@endpush
@endsection

