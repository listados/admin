@extends('layouts.admin_template')

@section('content')

{{ Html::style('public/dist/css/style.css') }}


    <!-- Sidebar -->
@include('sidebar')

    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
        <h1>
            {{ $page_title or "RELATÓRIOS" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li class="active">Relatórios</li>
            
        </ol>
    </section>

        <!-- Main content -->
<section class="content">

@include('sidebar_report')
@include('modal.modal_gerar_delivery')
</section>
</div><!-- /.content-wrapper -->




@endsection
