@extends('layouts.admin_template')
@section('content')
{{ Html::style('public/plugins/datatables/dataTables.bootstrap.css') }}
{{ Html::script('public/plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('public/plugins/datatables/dataTables.bootstrap.min.js') }}
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "Download de arquivos" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li>Imóveis</li>
            <li class="active"> <a href="{{url('vistoria')}}">Vistoria</a> </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
@include('messages.error')
@include('messages.error_message')
@include('messages.success')
@include('messages.info')

        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Imagens em 360° da vistoria {{ $id_survey }}</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Nome do arquivo</th>
                  <th>Data</th>
                  <th>Imagem</th>
                  <th>Excluir</th>
                  
                </tr>
                @foreach($file as $files)
                <?php  
                  $modal_id_delete    = "modalDelete360_".$files->files_ambience_id; 
                  $description_modal  = "Excluir imagem 360º";
                  $url_route          = "vistoria/excluir-imagem/".base64_encode($files->files_ambience_id)."/".$files->files_ambience_type;
                  $text_delete        = "Deseja realmente excluir essa foto?";
                  $name_camp          = "files_ambience_id";
                  $value_camp         = $files->files_ambience_id;
                  $adm = AdminEspindola\Helpers::verify_auth_delete_image($files->survey_id , Auth::user());
                                 
                ?>
                <tr>
                    <td>{{$files->files_ambience_description_file}}</td>
                    <td>{{date("d/m/Y H:i:s" , strtotime($files->created_at))}}</td>
                    <td>
                        <a href="{{url('vistoria/ver-360/'.$files->files_ambience_description_file)}}" target="_blank">
                             <img src="{{ url('public/dist/img/upload/vistoria/'.$files->files_ambience_description_file) }}" alt="" style="max-width: 256px; max-height: 256px;">
                        </a>
                       
                    </td>
                    <td><a href="#{{"modalDelete360_".$files->files_ambience_id}}" class="btn btn-danger {{ $adm }}" title="Excluir foto 360" data-toggle="modal" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                </tr>
                @include('modal.modal_delete')
                @endforeach
                
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
   
    </section>
</div>
<!-- /.content-wrapper -->
@endsection
