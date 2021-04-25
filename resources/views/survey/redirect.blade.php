@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar-->
    @include('sidebar') 

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "Vistoria" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li>Proposta</li>
                 <li class="active">Em desenvolvimentox'</li>
            </ol>
        </section>

        <!-- Main content -->
<section class="content">

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Informação</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="alert alert-danger">
                        <p><i class="fa fa-info-circle fa-2x"></i>
                                Por motivo de desempenho, as vistorias serão feita em uma outro link
                            </p>
                </div>
                <p>
                    <label for="">Acesse esse <a href="http://espindolaimobiliaria.com.br/admin/login" class="btn btn-primary" target="_black"> Link aqui</a> , 
                        faça o login e faça a sua vistoria.  </label>
                </p>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
</div>


</section>
</div><!-- /.content-wrapper -->

@endsection
