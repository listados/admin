<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Espindola Admin - Painel Administrativo</title>
      <!-- Fonts -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
      <!-- Styles -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      {{-- 
      <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
      --}}
      <style>
         body {
         font-family: 'Lato';
         padding-top: 120px;
         padding-bottom: 40px;
         background-color: #6E83F1;
         }
         .fa-btn {
         margin-right: 6px;
         }
         body#app-layout{ background-image:url("http://espindolaimobiliaria.com.br/escolhaazul/public/img/menina02.jpg");
         background-repeat:no-repeat; 
         background-position:center; 
         background-position: 50% 50%;
         height: auto;
         overflow: hidden;
         -webkit-background-size: cover;
         -moz-background-size: cover;
         -o-background-size: cover;
         background-size: cover;
         }
         .panel_login{
         margin-bottom: 20px;
         background-color: #fff0;
         border: 1px solid transparent;
         border-radius: 4px;
         -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
         border-color: #fff;
         color:#fff;
         }
      </style>
   </head>
   <body id="app-layout">
      @yield('content')
      <!-- JavaScripts -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
      {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
   </body>
</html>