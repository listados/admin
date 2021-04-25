@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "Alterar Perfil das Propostas e Cadastros" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li>Configuração</li>
                <li>Proposta</li>
                <li class="active">Em desenvolvimentox'</li>
            </ol>
        </section>

        <!-- Main content -->
<section class="content">
 	
<div class="col-md-4" data-example-id="simple-list-group">
	<label for="">Perfiis cadastrados</label>
<ul class="list-group">
		@foreach($profile as $profiles)
		  <li class="list-group-item">{{$profiles->profile_name}}<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#mudarPerfilProposta_{{$profiles->profile_id}}">Mudar</button></li>
		
		  <div class="modal fade" id="mudarPerfilProposta_{{$profiles->profile_id}}" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="gridSystemModalLabel">Modal title {{$profiles->profile_id}}</h4>
			      </div>
			      <div class="modal-body">
						<div class="alert alert-success alert-dismissible" id="info_profile_proposal_success_{{$profiles->profile_id}}"  style="display:none;" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Sucesso!</strong> Perfil alterado com sucesso!!.
						</div>			    

			        Deseja realmente mudar o perfil nas propostas?
			        <div class="form-group">
			        <input type="hidden" name="id_profile" value="{{$profiles->profile_id}}">
			        	<button type="button" onclick="editarPerfilProposta({{$profiles->profile_id}})" class="btn btn-primary">Sim</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		   
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		@endforeach  
	</ul>
</div>

<div class="col-md-8 page-header">
<span>Detalhes:</span>
	<ol class="breadcrumb">
	<li><a href="{{url('/perfis')}}"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a></li>
	  <li><label for="">Atualmente o Perfil ativo é: </label> {{ @$profile_present[0]->profile_name}}</li>	  
	</ol>
</div>

</section>
    </div><!-- /.content-wrapper -->




@endsection
