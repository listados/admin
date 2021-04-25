@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or "DADOS DOS CADASTROS PESSOA JURÍDICA" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li class="active">Prop. PJ</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- EDITAR USUARIO FORM -->
              <div class="box box-primary">
                 <div class="box-header with-border">
                  <h3 class="box-title">Dados</h3>

@if (session('mensagem'))
    <div class="alert alert-info">
        {{ Session::get('mensagem') }}
    </div>
@endif
<script  type="text/javascript">
    $('document').ready(function() {
    //capturando o dominio com http
    
        $('#searchProposal').autocomplete({
            source: '{{ url('/cadastre-all-pj') }}',
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
         //var route = 'http://localhost/dashboard/procurar-cadastro-pj/'+id;
         $.get(route, function(res){
           
            $(res).each(function(index, el) {
              $('#propostas').find('tbody tr').remove();
                row = '<tr><td>'+el.guarantor_legal_id+'</td>'
                +'<td>'+el.guarantor_legal_date_cadastre+'</td>'
                +'<td>'+el.guarantor_legal_location_name_corporation+'</td>'
                +'<td>'+el.guarantor_legal_location_cnpj+'</td>'
                +'<td>'+el.guarantor_id_legal+'</td>'
                +'<td>'+el.guarantor_name_pretended+'</td>'
                +'<td><a href="'+url+'/escolhaazul/?action=view-legal&id='+btoa(el.legal_id)+' " data-toggle="tooltip" title="Visualizar Proposta" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>'
                 +'<td><a href="'+url+'/escolhaazul/?action=view-legal&id='+btoa(el.legal_id)+' " data-toggle="tooltip" title="Análise de Cadastro" target="_blank"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>'
                 +'<td><a href="#" data-toggle="tooltip" title="Arquivos Enviados" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a></td>'
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
                                  <th>CPF</th>
                                  <th>N. Proposta</th>
                                  <th>Nome Proponente</th>
                                  <th>Visualizar</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($propostas as $proposta)
                                  
                                    <tr>
                                      <td>{{$proposta->guarantor_legal_id}}</td>
                                      <td>{{(empty($proposta->guarantor_legal_date_cadastre)) ? 'Não Concluida' : date('d/m/Y' , strtotime($proposta->guarantor_legal_date_cadastre)) }}</td>
                                      <td>{{$proposta->guarantor_legal_location_name_corporation}}  </td>
                                      <td>{{$proposta->guarantor_legal_location_cnpj}}</td>
                                      <td> {{$proposta->guarantor_id_legal}}</td>
                                      <td> {{$proposta->guarantor_name_pretended}}</td>
                                      <td> <a href="{{$dominio_pdf_externo}}/?action=view-legal&id={{base64_encode($proposta->guarantor_legal_id)}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                       <a href="{{$dominio_pdf_externo}}/?action=view-guarantor-legal&id={{base64_encode($proposta->guarantor_legal_id)}}" target="_blank" data-toggle="tooltip" title="Análise de Cadastro"  class="btn"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
                                      <a href="#" target="_blank" data-toggle="tooltip" title="Arquivos Enviados"  class="btn"><i class="fa fa-download" aria-hidden="true"></i></a>
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
