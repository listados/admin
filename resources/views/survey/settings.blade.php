@extends('layouts.layout_settings')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "CONFIGURAÇÃO" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li>Configuração</li>
                 <li class="active">Vistoria'</li>
            </ol>
        </section>

        <!-- Main content -->
<section class="content">
@if ( Session::has('mensagem'))
    <div class="alert alert-info">
        {{ Session::get('mensagem') }}
    </div>
@endif



<CENTER>Em breve as melhores soluções para o mercado imobiliário!!!</CENTER>
</section>
    </div><!-- /.content-wrapper -->




@endsection
