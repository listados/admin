<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title or "Administrativo - Configuração" }}</title>
   
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ url('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('bootstrap/css/fileinput.min.css') }}" rel="stylesheet" type="text/css" />
    

    <!-- Font Awesome Icons -->
    <link href="{{url('bootstrap/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{url('bootstrap/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ url('dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- JQUERY UI -->
     <link href="{{ url('jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />



    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ url('dist/css/skins/_all-skins.css')}}" rel="stylesheet" type="text/css" />
    <!-- jQuery 1.12.4 -->
    <script src="{{ url('plugins/jquery/jQuery-2.2.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('dist/js/url.js') }}" type="text/javascript"></script>
    <script src="{{ url('bootstrap/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('dist/js/ajax_crud.js') }}" type="text/javascript"></script>
    {{ Html::script('dist/js/crud_survey.js') }}
    <script src="{{ url('dist/js/header.js') }}" type="text/javascript"></script>
    <script src="{{ url('dist/js/funcao.js') }}" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
     
     <script type="text/javascript">
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
     //GLOBALIZANDO URL
      var project_survey = '/admin';
      domin  =  window.location.protocol + "//" + window.location.hostname;
      var domain_complet = domin + project_survey; 
      var url = window.location.origin;
      //console.log("url admin template: "+domain_complet);
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <!-- Header -->
    @include('header')
    @include('sidebar_settings')
    
    @yield('content')

        <!-- Footer -->
    @include('footer')
</div><!-- ./wrapper -->

<!-- Modal Editar Usuario-->
<div class="modal fade bs-example-modal-sm" id="loading" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel"> Aguarde...</h4>
      </div>
      <div class="modal-body">
      <p class="text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></p>
      
      </div>
      
    </div>
  </div>
</div>
         

<div id="dialog" title="Erro">
    <div id="dialog_text">
        
    </div>
</div>
<!-- REQUIRED JS SCRIPTS -->
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ url('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="{{ url('dist/js/app.min.js') }}" type="text/javascript"></script>
<!-- JQUERY UI -->
<script src="{{ url('/jquery-ui/jquery-ui.js') }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
</body>
</html>