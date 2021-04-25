@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "CONFIGURAR IMÓVEL" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li><a href="{{ url('/configuracao') }}">Configuração</a></li>
                <li class="active"><a href="#">Configurar Imóvel</a></li>                
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
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Informações da Última sincronização</h3>
            </div>
            <div class="box-body">
            <div class="col-md-6">
                <ul class="list-group">
                  <li class="list-group-item">
                    <span class="badge">{{ $setting[0]->settings_total_immobile_sync }}</span>
                    Total de Imóveis
                  </li>
                  <li class="list-group-item">
                   <span class="badge bg-green">{{ $carbon->parse($setting[0]->settings_date_last_sync)->format('d/m/Y H:i:s') }}</span>
                    Data da Sinc. 
                  </li>
                  <li class="list-group-item">
                   <span class="badge bg-green">{{ $user }}</span>
                    Sincronizado por:  
                  </li>
                </ul>
            </div>
            <br>
   
           
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <hr>
                      
                        <a href="{{ url('imovel-xml') }}" class="btn btn-primary pull-left btn-flat btn-lg" id="sincronizar_imovel" title="Sincronizar Imóveis com Ingaia"><i class="fa fa-refresh"></i> Sincronizar</a>
                    </div>
                </div>
            </div>
            
        </div>
        </div>

    </div>
</div>

</section>
    </div><!-- /.content-wrapper -->

<script type="text/javascript">
    $("#sincronizar_imovel").click(function(event) {
        $("#loading").modal('show');
    });
</script>


@endsection
