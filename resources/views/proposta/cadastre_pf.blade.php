@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or "DADOS DO CADASTRO PESSOA FÍSICA" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li class="active">Cad. PF</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- EDITAR USUARIO FORM -->
              <div class="box box-primary">
                 <div class="box-header with-border">
                  <h3 class="box-title">Pesquisar Proposta</h3>

@if (session('mensagem'))
    <div class="alert alert-info">
        {{ Session::get('mensagem') }}
    </div>
@endif
<script  type="text/javascript">
    $('document').ready(function() {
       var url = window.location.origin;
        $('#searchProposal').autocomplete({
            source: '{{ url('/cadastre-all') }}',
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
         var route = domain_complet +'/procurar-cadastro-pf/'+id;

         $.get(route, function(res){
           
            $(res).each(function(index, el) {
              $('#propostas').find('tbody tr').remove();
              id_fiador = el.guarantor_id;
                row = '<tr><td>'+el.guarantor_id+'</td>'
                +'<td>'+el.date_cadastre+'</td>'
                +'<td>'+el.guarantor_name+'</td>'
                +'<td>'+el.guarantor_cpf+'</td>'
                +'<td>'+el.id_proposal+'</td>'
                +'<td>'+el.guarantor_name_pretended+'</td>'
                +'<td><a href="'+url+'/escolhaazul/?action=view-proposal&id='+btoa(el.guarantor_id)+' "  data-toggle="tooltip" title="Visualizar Proposta"  target="_blank" class="btn"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                +'<a href="'+url+'/escolhaazul/view/report/print_guarantor_adm.php?id='+btoa(el.guarantor_id)+'" target="_blank" class="btn"><i class="fa fa-pie-chart" aria-hidden="true"></i></a></td>'
                +'<a href="'+url+'/escolhaazul/view/report/print_guarantor_adm.php?id='+btoa(el.guarantor_id)+'" data-toggle="tooltip" title="Análise de Cadastro" target="_blank" class="btn"><i class="fa fa-pie-chart" aria-hidden="true"></i></a></td>'
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
                                      <input type="text" name="term" class="form-control ui-widget" id="searchProposal" placeholder="Digite o nome do Fidor">
                                      <input type="hidden" id="id_proposta" >
                                     <a href="#" class="btn btn-info" id="pesquisar_proposta"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar Proposta</a>
                                     <a href="{{url('/proposta-pf')}}" class="btn btn-default" id="pesquisar_proposta"><i class="fa fa-plus" aria-hidden="true"></i> Nova Pesquisa</a>  
                                    </form>
                            </div>
        
                            <div class="table-responsive">
                              <table id="propostas" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                <th>N. Cadastro</th>
                                  <th>Concluída em:</th>
                                  <th>Nome</th>
                                  <th>CPF</th>
                                  <th>N. Prop.</th>
                                  <th>Nome Proponente.</th>
                                  <th>Visualizar</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($propostas as $proposta)
                                    <tr>
                                      <td>{{$proposta->guarantor_id}}</td>
                                      <td>{{(empty($proposta->date_cadastre)) ? 'Não Concluida' : date('d/m/Y' , strtotime($proposta->date_cadastre)) }}</td>                                    
                                      <td>{{$proposta->guarantor_name}}  </td>
                                      <td>{{$proposta->guarantor_cpf}}</td>
                                      <td> {{$proposta->id_proposal}}</td>
                                      <td> {{$proposta->guarantor_name_pretended}}</td>
                                      <td> <a href="{{$dominio_pdf_externo}}/?action=view-guarantor&id={{base64_encode($proposta->guarantor_id)}}" data-toggle="tooltip" title="Visualizar Cadastro" target="_blank" class="btn"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                      <a href="{{$dominio_pdf_externo}}/view/report/print_guarantor_adm.php?&id={{base64_encode($proposta->guarantor_id)}}" target="_blank" data-toggle="tooltip" title="Análise de Cadastro"  class="btn"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
                                      <a href="{{url('download-arquivo/'.$proposta->guarantor_id.'/cadastro-pf')}}" target="_blank" data-toggle="tooltip" title="Arquivos Enviados"  class="btn"><i class="fa fa-download" aria-hidden="true"></i></a>
                                      </td>
                                    </tr>
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
