@extends('layouts.admin_template')

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "Pesquisa de Proposta" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Proposta</a></li>
            <li class="active">Pesquisa de Proposta</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
         <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::open()}}
                                    <label class="sr-only" for="exampleInputAmount">Pesquisar</label>
                                                                    
                                      <input type="text" name="term" class="form-control ui-widget" id="searchProposal" placeholder="Pesquisar proposta">
                                      <input type="hidden" name="proposal_id" id="id_proposta" >
                                     <a href="" class="btn btn-info" id="pesquisar_proposta"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar Proposta</a> 
                               {{Form::close()}}
                            </div>
        
                            <div class="table-responsive">
                              <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th>Concluída em:</th>
                                  <th>Nome</th>
                                  <th>CPF</th>
                                  <th>E-mail</th>
                                  <th>Visualizar</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($propostas as $proposta)
                                    <tr>
                                      <td>{{date("d/m/Y" , strtotime($proposta->proposal_completed))}}</td>
                                      <td>{{$proposta->proposal_name}}  </td>
                                      <td>{{$proposta->proposal_cpf}}</td>
                                      <td> {{$proposta->proposal_email}}</td>
                                      <td> <a href="http://localhost/escolhaazul/?action=view-proposal&id=".base64_encode($proposta->proposal_id)><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                    </tr>
                                    @endforeach
                                                           
                                </tbody>
                               
                              </table>
                          
                            </div>  
                        </div>
                    </div>
                </div>   
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->



@endsection
