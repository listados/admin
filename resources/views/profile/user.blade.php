@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or "Editar Perfil" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Perfil</a></li>
                <li class="active">Editar perfil</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- EDITAR USUARIO FORM -->
              <div class="box box-primary">
                 <div class="box-header with-border">
                  <h3 class="box-title">Dados</h3>

@include('messages.error')

@include('messages.success')

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
                </div>

                 <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="box box-success">
                                    <div class="box-body box-profile">
                                     {{Form::open(array('url' => 'admin/alterar-avatar' , 'method' =>  'post' , 'enctype' => 'multipart/form-data'))}}
                                        <label>Foto</label>
                                        <img class="profile-user-img img-responsive img-circle" src="{{url('/public/dist/img/upload/profile/'.Auth::user()->avatar)}}" alt="User profile picture">
                                            <input type="file" name="avatar">
                                            <input type="submit" class="btn btn-primary" value="Alterar">
                                      {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                {{Form::open( array('url' => array('configuracao/update')))}}
                                <div class="form-group">
                                <label>Nome</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nome Completo" value="{{ $user->name }}">
                                </div>

                                 <div class="form-group">
                                    <label for="apelido">Apelido</label>
                                    <input type="text" name="nick" value="{{ $user->nick }}"  class="form-control">
                                </div>

                                 <div class="form-group">
                                 <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{$user->email}}">
                                </div>

                                 <div class="form-group">
                                <label for="">Celular</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" name="phone" id="phoneUser" value="{{ $user->phone }}"  onkeyup="mascara( this, mtel );" maxlength="15" >
                                </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Recebe proposta</label><br/>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default ">
                                        <input type="radio" name="receive_proposal" id="option1" value="1" autocomplete="off" > Sim
                                        </label>
                                        <label class="btn btn-default active">
                                        <input type="radio" name="receive_proposal" id="option2" value="0" autocomplete="off" checked> Não
                                        </label>          
                                    </div>
                                </div>


                                 <div class="form-group">
                                 <label>Senha</label>
                                    <input type="password" name="password" class="form-control" placeholder="Senha">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <input type="submit" class="btn  btn-primary" value="Alterar">
                                </div>
                            {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>    
              </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


@endsection
