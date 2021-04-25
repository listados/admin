@extends('layouts.admin_template')
@section('content')
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "CADASTRAR CLIENTE" }}
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
                                        <span class="info-box-text">Logado pela empresa
                                        </span>
                                        <span class="info-box-number">
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 50%">
                                            </div>
                                        </div>
                                        <span class="progress-description">
                                        
                                        @if(Session::get('business_name'))
                                        {{ Session::get('business_name') }}
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
                                        <span class="info-box-number">
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
                                        <span class="info-box-number">
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
                    </div>
                    {{-- FIM ROW --}}
                </div>
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Cadastro</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Razão Social</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                        </div>
                                       
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </div>
                <!--/.col (left) -->
            </div>
            <!--/.col (9) -->
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
@endsection
