@extends('layouts.admin_template')
@section('content')
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "Novo Usuário" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Configuração</a></li>
            <li><a href="{{url('/usuarios')}}">Usuários</a></li>
            <li class="active">Adicionar'</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col md-12">
@include('messages.error')

@include('messages.success')

            <div class="col-md-4">
                <div class="box box-success">
                    
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>
                    <div class="box-body">
                      {{Form::open(array('url'=>'/configuracao/adicionar-usuario/', 'enctype' => 'multipart/form-data'))}}  
                        <div class="form-group">
                            <label for="">Nome Completo:</label>
                            <input type="text" name="name"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Apelido:</label>
                            <input type="text" name="nick"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">CPF:</label>
                            <input type="text" name="cpf" onBlur="javascript:validaCPF(this);" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Perfil:</label>
                            <select name="id_profile" id="" class="form-control">
                                <option value="">--Selecione--</option>
                                @foreach($profile as $profiles)
                                <option value="{{$profiles->profile_id}}">{{$profiles->profile_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Status:</label>
                            <select name="status" class="form-control">
                                <option value="">--Selecione--</option>
                                <option value="0">Inativo</option>
                                <option value="1">Ativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">E-mail:</label>
                            <input type="email" name="email"  class="form-control">
                            @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="Celular">Celular:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" name="phone" id="phoneUser" onkeyup="mascara( this, mtel );" maxlength="15" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Recebe proposta:</label><br/>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default ">
                                <input type="radio" name="receive_proposal" id="option1" value="1" autocomplete="off" > Sim
                                </label>
                                <label class="btn btn-default active">
                                <input type="radio" name="receive_proposal" id="option2" value="0" autocomplete="off" checked> Não
                                </label>          
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-flat btn-success pull-right" value="Salvar">
                        <a href="{{url('usuarios')}}" class="btn btn-default pull-left">Voltar</a>
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
