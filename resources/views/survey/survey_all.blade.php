@extends('layouts.admin_template')

@section('content')
<!--PARA A MANIPULAÇÃO DE ORDENS NA TABELA-->
{{ Html::style('/plugins/datatables/dataTables.bootstrap.css') }}
{{ Html::script('plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('plugins/datatables/dataTables.bootstrap.min.js') }}
{{ Html::script('dist/js/crud_survey.js') }}
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "Chaves" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Imóveis</a></li>
                <li class="active">Vistoria</li>
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
              <h3 class="box-title">Todas as Vistorias</h3>
              {{ Form::open(array('url' => '/vistoria/nova')) }}
              {{ Form::hidden('survey_status' , 'Rascunho') }}
                <button type="submit"  class="btn bg-navy pull-right" id="new_survey" ><i class="fa fa-plus"></i> Nova Vistoria</button>
             
              {{ Form::close() }}
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive">
              <table id="table-vistoria" class="display table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Imóvel</th>
                  <th>Data</th>
                  <th>Tipo</th>
                  <th>Vistoriador</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($survey as $surveys)
                <?php
                  $noti_360 = DB::table('files_ambience')->where([
                              ['files_ambience_id_survey' , $surveys->survey_id],
                              ['files_ambience_type' , '360']
                              ])->get();
                  $noti_nor = DB::table('files_ambience')->where([
                              ['files_ambience_id_survey' , $surveys->survey_id],
                              ['files_ambience_type' , 'normal']
                              ])->get();

                ?>
                  @if($surveys->survey_status == 'Finalizada')
                  <?php  $disabled_edit = 'disabled'; $disabled_send = ''; ?>
                  @else
                  <?php  $disabled_edit = ''; $disabled_send = 'disabled'; ?>
                  @endif
                  @if(Auth::User()->adm == 0)
                  <?php $disabled_trash = 'disabled';  ?>  
                  @else
                  <?php $disabled_trash = '';  ?>
                  @endif

                <tr>
                  <td>{{ $surveys->survey_code}}</td>
                  <td>{{ substr($surveys->survey_address_immobile, 0 , 82).'...' }}</td>
                  <td>{{ date("d/m/Y" , strtotime($surveys->survey_date)) }}</td>
                  <td>{{ $surveys->survey_type }}</td>
                  <td>{{ $surveys->survey_inspetor_name }}</td>
                  <td>{{ $surveys->survey_status }}</td>
                  <td>                    
                    {!!  HTML::decode(link_to('vistoria/editar/'.base64_encode($surveys->survey_id) , '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>',['title' => 'Editar Vistoria' , 'class' => 'btn '.$disabled_edit ])) !!}   
                    {!!  HTML::decode(link_to('vistoria/visualizar-360/'.base64_encode($surveys->survey_id) , '<span class="badge-noti">'.count($noti_360).'</span><i class="fa fa-street-view" aria-hidden="true"></i>',['title' => 'Visualizar em 360°', 'class' => 'btn' ])) !!} 

                    {!!  HTML::decode(link_to('#' , '<i class="fa fa-print" aria-hidden="true"></i>',['data-toggle' => 'modal', 'class' => 'btn ' , 
                    'data-target' => '#option_print_'.$surveys->survey_id])) !!}
                     
                    <a href="{{ url('vistoria/replicar/'.$surveys->survey_id) }}" title="{{'Replicar vistoria '.$surveys->survey_id}}"" class="btn" id="reply-survey" >
                      <i class="fa fa-files-o" > </i>
                    </a>

                    {!!  HTML::decode(link_to('#', '<i class="fa fa-envelope-o" aria-hidden="true"></i>',['title' => 'Enviar para cliente', 'data-toggle' => 'modal' , 'data-target' => '#send_email_'.$surveys->survey_id , 'class' => 'btn '.$disabled_send])) !!}

                    {!!  HTML::decode(link_to('vistoria/download/'.base64_encode($surveys->survey_id), '<span class="badge-noti">'.count($noti_nor).'</span><i class="fa fa-picture-o" aria-hidden="true"></i>',['title' => 'Visualizar e Download', 'class' => 'btn '.$disabled_edit])) !!}
                  
                    {!! HTML::decode(link_to('#','<i class="fa fa-trash" aria-hidden="true"></i>',['data-toggle' => 'modal' , 'data-target' => '#delete_survey_'.$surveys->survey_id, 'title' => 'Excluir Vistoria', 'class' => 'btn '.$disabled_trash])) !!}

                    {!! HTML::decode(link_to('vistoria/historico/'.base64_encode($surveys->survey_id),'<i class="fa fa-history" aria-hidden="true"></i>',['title' => 'Histórico Vistoria', 'class' => 'btn '])) !!}


                  
                     
                    @include('modal.survey_send_email')  
                    @include('modal.survey_print')              
                  </td>
                 
                  @include('modal.delete_vistoria')
                </tr>
                @endforeach()
          
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <!-- /.content -->
</section>
    </div><!-- /.content-wrapper -->


<script>
  $(function () {
    $("#example1").DataTable();
    $('#table-vistoria').DataTable({
      "iDisplayLength": 50,
      "language": {
        "lengthMenu": "Exibir _MENU_ vistoria por página",
        "emptyTable": "Não existe nenhum tour criado",
        "infoEmpty": "Mostrando 0 Registros",
        "info": "Mostrando _PAGE_ páginas de _PAGES_",
        "searchPlaceholder": "Digite o nome do tour",
        "search": "Pesquisar",
        "show" : "Mostrar",
        "paginate": {
        "previous": "Anterior",
        "next" : "Próxima",
        "last": "Última",
        "first": "Primeira",
        "loadingRecords": "Aguarde - lendo dados..."
      }
      },
      "order": [ 0, 'desc' ]
    });
  });

  $("#reply-survey").click(function(){
    $("#loading").modal('show');
  });
</script>
@endsection

