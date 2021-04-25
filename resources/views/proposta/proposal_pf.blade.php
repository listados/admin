@extends('layouts.admin_template')
@section('content')
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<style type="text/css">
    .badge{
        padding: 1px 4px !important;
        font-size: 10px !important;
    }
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "DADOS DA PROPOSTA PESSOA FÍSICA" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li class="active">Prop. PF</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- EDITAR USUARIO FORM -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pesquisar Proposta </h3>
               @include('messages.error')
                @include('messages.error_message')
                @include('messages.success')
                @include('messages.info')

                <script  type="text/javascript">
                    $('document').ready(function() {
                    //capturando o dominio com http
                      // body...
                    
                         $('#searchProposal').autocomplete({
                            source: '{{ url('/proposal-all') }}',
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
                       
                        var route = domain_complet + '/procurar-proposta/'+id;
                         console.log(route);
                         $.get(route, function(res){
                           
                            $(res).each(function(index, el) {
                              $('#propostas').find('tbody tr').remove();
                                row = '<tr><td>'+el.proposal_id+'</td>'
                                +'<td>'+el.date_cadastre+'</td>'
                                +'<td>'+el.proposal_name+'</td>'
                                +'<td>'+el.proposal_cpf+'</td>'
                                +'<td>'+el.proposal_status+'</td>'
                                +'<td>'+el.proposal_email+'</td>'
                                +'<td><a href="'+url+'/ea/?action=view-proposal&id='+btoa(el.proposal_id)+' " target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                                +'<a href="'+url+'/ea/view/report/proposal_pf_adm.php?id='+btoa(el.proposal_id)+' " class="btn" target="_blank" data-toggle="tooltip" title="Análise de Proposta"><i class="fa fa-pie-chart" aria-hidden="true"></i></a></td>'
                               
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
                            <label class="sr-only" for="exampleInputAmount">Pesquisar</label>
                            <form>                                                                    
                                <input type="text" name="term" class="form-control ui-widget" id="searchProposal" placeholder="Digite o nome do Proponente">
                                <input type="hidden" id="id_proposta" >
                                <a href="#" class="btn btn-info" id="pesquisar_proposta"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar Proposta</a>
                                <a href="{{url('/proposta-pf')}}" class="btn btn-default" id="pesquisar_proposta"><i class="fa fa-plus" aria-hidden="true"></i> Nova Pesquisa</a>  
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
                                        <th>E-mail</th>
                                        <th>Status</th>
                                        <th>Visualizar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($propostas as $proposta)
                                    <tr>
                                        <td>{{$proposta->proposal_id}}</td>
                                        <td>{{(empty($proposta->date_cadastre)) ? 'Não Concluida' : date('d/m/Y' , strtotime($proposta->date_cadastre)) }}</td>
                                        <td>{{substr($proposta->proposal_name, 0, 50)}}  </td>
                                        <td>
                                        <?php 
                                        $id_proposal = $proposta->proposal_id;
                                        $id_alter_fun = 'modal_alterFuncPF_'.$proposta->proposal_id;
                                        $description_modal = 'ALTERAR ATENDENTE PROPOSTA P.F';
                                        $url_route = '';
                                        $text_modal = 'Atendente atual:';
                                        $name_camp = 'proposal_id';
                                        $value_camp = $proposta->proposal_id;
                                        $table = 'proposal';
                                        //CHAMANDO TODOS OS USUARIOS E SE EM PROPOSAL_ID_USER TIVER VALOR EU PASSO COMO PARAMENTRO NA BUSCA PELO USUARIO
                                        if($proposta->proposal_id_user == 0){
                                         
                                          echo '<a href="#"  data-toggle="modal" data-target="#'.$id_alter_fun.'" title="Alterar Atendente">Não Informado</a>';
                                        ?>
                                            @include('modal.alter_func')
                                        <?php
                                        }else{
                                          $name_user = DB::table('users')->where('id' , '=' , $proposta->proposal_id_user)->get(); 
                                            foreach($name_user as $name_users){
                                        ?>     
                                              <a href="#"  data-toggle="modal" data-target="#{{$id_alter_fun}}" title="Alterar Atendente">{{$name_users->name}}</a>
                                               @include('modal.alter_func')
                                        <?php      
                                            }
                                        }                                       

                                         ?></td>
                                        <td> {{$proposta->proposal_email}}</td>
                                        <td> <a href="#" data-toggle="modal" data-target="#editStatus_{{$proposta->proposal_id}}"> {{$proposta->proposal_status}}</a></td>                                        
                                        <td> <a href="{{$dominio_pdf_externo}}/?action=view-proposal&id={{base64_encode($proposta->proposal_id)}}" target="_blank" class="btn" data-toggle="tooltip" title="Visualizar Proposta"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{$dominio_pdf_externo}}/view/report/proposal_pf_adm.php?id={{base64_encode($proposta->proposal_id)}}" class="btn" target="_blank" data-toggle="tooltip" title="Análise de Proposta"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
                                            <a href="{{url('download-arquivo/'.$proposta->proposal_id.'/proposta-pf')}}" class="btn" target="_blank" data-toggle="tooltip" title=""><i class="fa fa-download" aria-hidden="true"></i><span class="badge bg-green">{{ DB::table('files')->where('files_id_proposal' , $proposta->proposal_id)->count() }}</span></a>
                                            @if(Auth::user()->adm == 1)
                                            <a href="#"  data-toggle="modal" data-target="#delete_proposal_pf_{{$proposta->proposal_id}}" title="Excluir Proposta"><i class="fa fa-trash" aria-hidden="true"></i>
                                            
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                  @include('modal.editModalProposal')
                                  @include('modal.delete_proposal_pf')
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
