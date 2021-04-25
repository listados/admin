@extends('layouts.admin_template')

@section('content')


<!-- Sidebar -->
@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
          {{ $page_title or "Usuários" }}
          <small>{{ $page_description or null }}</small>
      </h1>
      <!-- You can dynamically generate breadcrumbs here -->
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Configuração</a></li>
          <li class="active">Usuários</li>
      </ol>
  </section>

    <section class="content">

@include('messages.error')
@include('messages.success')

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-body">
          Painel de usuários
        </div>
      </div>
      </div>
    </div>

      <div class="row">
        <div class="col-md-3">
          <div class="well well-sm">
            <a href="{{url('/configuracao/adicionar-usuario')}}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Adicionar Usuário</a>
          </div>

          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Informações</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#" ><i class="fa fa-circle-o text-red"></i> Total de Usuários: {{$total_user}}</a> </li>
                <li><a href="#" ><i class="fa fa-circle-o text-yellow"></i> Total de usuários ativos: {{$user_active}}</a></li>                
              </ul>
            </div>
            <!-- /.box-body -->

          </div>

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de usuários</h3>

              <div class="box-tools pull-right">
                
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Último Acesso:</th>
                        <th>Status</th>
                        <th>Perfil</th>
                        <th>Ação</th>                       
                      </tr>
                    </thead>
                     <tbody>                       
                        @foreach ($user as $users)
                          <tr>
                            <td>{{$users->name}}</td>
                            <td>{{date("d/m/Y H:i:s" , strtotime($users->updated_at)) }}</td>
                            <td><?php if($users->status == 1){
                                echo 'Ativo';
                              }else{
                                echo 'Desativado';
                              } ?>                                
                             </td>
                              <td> 
                              {{$users->profile_name}}
                              </td>
                            <td>
                              <a href="{{url('/admin/editar-usuario/'.$users->id)}}" class="btn btn-primary" title="Editar Usuário" ><i class="fa fa-pencil" aria-hidden="true"></i>
                              </a>
                              <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser_{{$users->id}}" title="Excluir Usuário"><i class="fa fa-trash" aria-hidden="true"></i>
                              </a>
                               <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#redefinir_senha_adm_{{$users->id}}" title="Redefinir Senha"><i class="fa fa-unlock-alt" aria-hidden="true"></i>
                              </a>
                                                            
                            </td>
                          </tr>
                          @include('modal.editUser')
                          @include('modal.deleteUser')
                          @include('modal.redefinir_senha_adm')
                        @endforeach
                            </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
</div><!-- /.content-wrapper -->


@endsection
      