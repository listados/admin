<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ url('/public/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/public/dist/css/AdminLTE.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="../../index2.html"><b>Admin</b>Espíndola</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name ">
   <img src="{{ url('/public/dist/img/upload/profile/user-default-avatar.jpg') }}" class="profile-user-img img-responsive img-circle"  alt="User Image" width="128">
    <p style="margin: 10px; padding: 5px;">{{$user->nick}}</p>
  </div>
   <div class="lockscreen-image">
     
    </div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="">
    <!-- lockscreen image -->
   
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
   
    {{Form::open(array('url'=> '/alterar-senha', 'class'=>'' , 'onsubmit' => 'return conf_password()'))}}
      <div class="form-group">
        <input type="password" class="form-control" name="password" id="passwords" required="" placeholder="Senha">
       
        <input type="hidden" name="id" value="{{$user->id}}" >
        
      </div>
   
    <!-- /.lockscreen credentials -->
     <div class="form-group">
        {{--  --}}
         <div class="input-group">
          <input type="password" class="form-control" name="password" id="confirmacao" required="" placeholder="Confirmar Senha">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default" type="button"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
          </span>
        </div><!-- /input-group --
      </div>
  </div>
     
  
 {{Form::close()}}
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Digite o seu password para acesso ao sistema
  </div>
  <div class="text-center">
    <a href="{{url('/imobiliaria/login')}}">Já sou cadastrado</a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2015-2016 <b><a href="http://excellencesoft.com.br" class="text-black">Espíndola imobiliária</a></b><br>
    
  </div>
</div>
<!-- /.center -->

<!-- jQuery 2.2.0 -->
<script src="{{ url('/public/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ url('/public/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ url('/public/dist/js/funcao.js') }}"></script>
</body>
</html>
