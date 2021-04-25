<!DOCTYPE html>
<html>
  <head>
    <title>Painel Admin - Espindola</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ url('dist/setting/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- styles -->
    <link href="{{ url('dist/setting/css/styles.css') }}" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ url('plugins/jQuery/jQuery-2.2.0.min.js') }}" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	@include('setting.header')

    <div class="page-content">

    	<div class="row">
		  @include('setting.sidebar')
		  <div class="col-md-10">
		  
		  	<div>
				 @yield('content')
		  	</div>
		  </div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2014 <a href='#'>Website</a>
            </div>
            
         </div>
      </footer>

    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ url('dist/setting/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('dist/setting/js/custom.js') }}"></script>
  </body>
</html>