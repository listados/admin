@extends('layouts.admin_template')

@section('content')


<!-- Sidebar -->
@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

    <h1>
        {{ $page_title or "Editar usuário" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li>Condfiguração</li>
        <li><a href="{{url('/admin/usuarios')}}" title="Todos usuários">Usuário</a></li>
         <li class="active">Editar Usuário</li>
    </ol>
</section>

        <!-- Main content -->
<section class="content">
<div class="col md-12">

@include('messages.error')

@include('messages.success')

	<div class="col-md-4">
		<div class="box box-success">
			<div class="box-body box-profile">
         {{Form::open(array('url' => 'admin/alterar-avatar' , 'method' =>  'post' , 'enctype' => 'multipart/form-data'))}}
            <label>Foto</label>
            <img class="profile-user-img img-responsive img-circle" src="{{url('/bower_components/adminlte/dist/img/upload/profile/'.$user[0]->avatar)}}" alt="User profile picture">
                <input type="file" name="avatar">
                <input type="submit" class="btn btn-primary" value="Alterar">
          {{Form::close()}}
        </div>
		</div>
	</div>
	<div class="col-md-8">
		   <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Dados</h3>
            </div>
            <div class="box-body">
            {{Form::model($user, array('url' => array(url('/admin/editar-usuario/'.$user[0]->id), $user[0]->id))) }}
              <div class="form-group">
              <label for="">Nome Completo:</label>
              	<input type="text" name="name" value="{{$user[0]->name}}" class="form-control">
              </div>
              <div class="form-group">
              	<label for="">Nome de Usuário:</label>
              	<input type="text" name="nick" value="{{$user[0]->nick}}" class="form-control">
              </div>
              <div class="form-group">
                            <label for="">CPF:</label>
                            <input type="text" name="cpf" onBlur="javascript:validaCPF(this);" value="{{$user[0]->cpf}}" class="form-control">
                        </div>
              <div class="form-group">
              	<label for="">Perfil:</label>
                <select name="id_profile" id="" class="form-control">
                  <option value="{{$user[0]->id_profile}}">{{$user[0]->profile_name}}</option>
                  @foreach($profile as $profiles)
                    <option value="{{$profiles->profile_id}}">{{$profiles->profile_name}}</option>
                  @endforeach
                </select>
           
              </div>
              <div class="form-group">
              	<label for="">Status:</label>
              	
                 <select name="status" class="form-control">
                  <option value="{{$user[0]->status}}">{{($user[0]->status == 1) ? 'Ativo' : 'Inativo'}}</option>
                    <option value="0">Inativo</option>
                    <option value="1">Ativo</option>
                </select>
              </div>
              <div class="form-group">
              	<label for="">E-mail:</label>
              	<input type="text" name="email" value="{{$user[0]->email}}" class="form-control">
              </div>
              <div class="form-group">
              	<label for="">Celular:</label>
              	
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="phone" class="form-control" value="{{$user[0]->phone}}">
                </div>
              </div>
              <div class="form-group">
              	<label for="">Recebe proposta:</label><br/>
              	<div class="btn-group" data-toggle="buttons">
              	<?php
              		if($user[0]->receive_proposal == 0){
              			$check_yes  ='';
              			$check_no	='active';
              		}else{
              			$check_yes  ='active';
              			$check_no	='';
              		}
              	?>
		            <label class="btn btn-default {{$check_yes}}">
		              <input type="radio" name="receive_proposal" id="option1" value="1" autocomplete="off" > Sim
		            </label>
		            <label class="btn btn-default {{$check_no}}">
		              <input type="radio" name="receive_proposal" id="option2" value="0" autocomplete="off" checked> Não
		            </label>          
		        </div>    
              </div>
              <div class="form-group">
              	<hr>
              	<input type="hidden" value="{{$user[0]->id}}" name="id" >
              	<input type="submit" class="btn btn-flat btn-success pull-right" value="Alterar">
              </div>
              {{Form::close()}}
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>
</section>
</div><!-- /.content-wrapper -->




@endsection
