@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or "DADOS DAS PROPOSTAS PESSOA JURÍDICA" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li>Escolha Azul</li>
                <li class="active">Prop. PJ</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- EDITAR USUARIO FORM -->
              <div class="box box-primary">
                 <div class="box-header with-border">
                  <h3 class="box-title">Dados</h3>

@include('messages.error')
@include('messages.error_message')
@include('messages.success')
@include('messages.info')
<script  type="text/javascript">
    $('document').ready(function() {
          //capturando o dominio com http
   
        $('#searchProposal').autocomplete({
            source: '{{ url('/proposal-all-pj') }}',
            minlength: 3,
             autoFocus: true,
             select: function(event,ui){
              
                   $('#searchProposal').val(ui.item.value);
                   $('#id_proposta').val(ui.item.id);
                   
             }

        });  
      
    $('#pesquisar_proposta').click(function() {
        var dados = {
          'id': $('#id_proposta').val()
         };
        var id = $('#id_proposta').val();
        var route = domain_complet+'/procurar-proposta-pj/'+id;
        
         $.get(route, function(res){
           
            $(res).each(function(index, el) {
              $('#propostas').find('tbody tr').remove();
                row = '<tr><td>'+el.legal_id+'</td>'
                +'<td>'+el.legal_date_cadastre+'</td>'
                +'<td>'+el.legal_location_name_corporation+'</td>'
                +'<td>'+el.legal_location_cnpj+'</td>'
                +'<td>'+el.legal_location_email+'</td>'
                +'<td><a href="'+url+'/escolhaazul/?action=view-legal&id='+btoa(el.legal_id)+' " target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                +'<a href="'+url+'/escolhaazul/view/report/proposal_pj_adm.php?id='+btoa(el.legal_id)+' " class="btn" target="_blank" data-toggle="tooltip" title="Análise de Proposta"><i class="fa fa-pie-chart" aria-hidden="true"></i></a></td>'
                +'</tr>'; 
            $('#propostas > tbody:last').append(row);
            $('#pagination').hide();
            });

         });
      });   

});
</script>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">                              
                                    <label class="sr-only">Pesquisar</label>
                                    <form>                                                                    
                                      <input type="text" name="term" class="form-control ui-widget" id="searchProposal" placeholder="Pesquisar proposta">
                                      <input type="hidden" id="id_proposta" >
                                     <a href="#" class="btn btn-info" id="pesquisar_proposta"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar Proposta</a>
                                     <a href="{{url('/proposta-pj')}}" class="btn btn-default" id="pesquisar_proposta"><i class="fa fa-plus" aria-hidden="true"></i> Nova Pesquisa</a>  
                                    </form>
                            </div>
        
                            <div class="table-responsive">
                              <table id="propostas" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                <th>N. Proposta</th>
                                  <th>Concluída em:</th>
                                  <th>Nome</th>
                                  <th>Atendente</th>
                                  <th>CNPJ</th>
                                  <th>E-mail</th>
                                  <th>Visualizar</th>
                                </tr>
                                </thead>
                                <tbody>
                                  
                                    @foreach($propostas as $proposta)
                                    <?php
                                    //MODAL DELETE
                                      $modal_id_delete = "delete_proposalpj_".$proposta->legal_id; 
                                      $description_modal = "Excluir Proposta PJ";
                                      $url_route = "excluir-propostapj/".$proposta->legal_id;
                                      $text_delete = "Deseja realmente excluir a proposta n° ".$proposta->legal_id;
                                      $name_camp = 'legal_id';
                                      $value_camp = $proposta->legal_id;
                                      //MODAL ALTER FUNCTIONARY
                                      $id_proposal = $proposta->legal_id;
                                      $id_alter_fun = 'modal_alterFunc_'.$proposta->legal_id;
                                      $description_modal = 'ALTERAR ATENDENTE PROPOSTA P.J';
                                    
                                      $text_modal = 'Atendente atual:';
                                      $name_camp = 'legal_id';
                                      $value_camp = $proposta->legal_id;
                                      $table = 'legal';
                                    ?>
                                    <tr>
                                      <td>{{$proposta->legal_id}}</td>
                                      <td>{{(empty($proposta->legal_date_cadastre)) ? 'Não Concluida' : date('d/m/Y' , strtotime($proposta->legal_date_cadastre)) }}</td>
                                      <td>{{ substr($proposta->legal_location_name_corporation, 0, 40)}}  </td>
                                      <td>
                                        <?php 
                                          //CHAMANDO TODOS OS USUARIOS E SE EM PROPOSAL_ID_USER TIVER VALOR EU PASSO COMO PARAMENTRO NA BUSCA PELO USUARIO
                                          if($proposta->legal_id_user == 0 || $proposta->legal_id_user == null){
                                           
                                            echo '<a href="#"  data-toggle="modal" data-target="#'.$id_alter_fun.'" title="Alterar Atendente">Não Informado</a>'; ?>
                                            @include('modal.alter_func')
                                          <?php }else{
                                            $name_user = DB::table('users')->where('id' , '=' , $proposta->legal_id_user)->get(); 
                                              foreach($name_user as $name_users){
                                          ?>     
                                                <a href="#"  data-toggle="modal" data-target="#{{$id_alter_fun}}" title="Alterar Atendente">{{$name_users->name}}</a>
                                                @include('modal.alter_func')
                                          <?php      
                                              }
                                          }  
                                      ?>
                                      </td>
                                      <td>{{$proposta->legal_location_cnpj}}</td>
                                      <td> {{$proposta->legal_location_email}}</td>
                                      <td> <a href="{{$dominio_pdf_externo}}/?action=view-legal&id={{base64_encode($proposta->legal_id)}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                      <a href="{{$dominio_pdf_externo}}/view/report/proposal_pj_adm.php?id={{base64_encode($proposta->legal_id)}}" class="btn" target="_blank" data-toggle="tooltip" title="Análise de Proposta"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
                                      <a href="{{url('download-arquivo/'.$proposta->legal_id.'/inquilino')}}" class="btn" target="_blank" data-toggle="tooltip" title="Arquivos Enviados"><i class="fa fa-download" aria-hidden="true"></i></a>
                                      <a href="{{ '#'.$modal_id_delete }}" data-toggle="modal">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                      </a>
                                      </td>
                                    </tr>
                                    @include('modal.modal_delete')
                                    @endforeach
                                                           
                                </tbody>
                               
                              </table>
                              <div id="pagination">
                                {{ $propostas->links()}}
                              </div>
                              
                            </div>  
                        </div>
                    </div>
                </div>    
              </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->




@endsection
