@extends('layouts.admin_template')

@section('content')

{{ Html::style('dist/css/evaluation.min.css') }}
<!-- Sidebar -->
@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            {{ $page_title or "Relatório de Avalização" }}
            <small>{{ $page_description or 'Imóvel' }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li>Relatório</li>
            <li class="active">Avaliação</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-md-4">
                        <label>Codigo Imóvel</label>                        
                            <div class="input-group">                           
                                <input type="text" class="form-control" name="reserves_ref_immobile" id="code_evaluation_immobile">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-flat" title="Pesquisar Avaliação" id="searchCodeImmobileEvaluarion"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Imprimir avaliação do Imóvel</label>
                        <a href="#" class="btn btn-primary btn-block btn-flat">
                            <i class="fa fa-print"></i>  Imprimir
                        </a>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <table class="table table-borderd display" id="table-evaluation-search">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Visitado por</th>                       
                        <th>Parecer da Visita</th>
                        <th>Informações da Avaliação</th>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>

</section>
</div><!-- /.content-wrapper -->


@push('scripts')
    {{ Html::script('dist/js/evaluation.min.js') }}

@endpush

@endsection
