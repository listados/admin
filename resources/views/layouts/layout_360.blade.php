<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

{{ Html::style('public/plugins/360/dist/photo-sphere-viewer.css') }}
<script>
  //GLOBALIZANDO URL
      var project_survey = '/admin';
      domin  =  window.location.protocol + "//" + window.location.hostname;
      var domain_complet = domin + project_survey; 
      var url = window.location.origin;
</script>
  <style>
    html, body {
      width: 100%;
      height: 100%;
      overflow: hidden;
      margin: 0;
      padding: 0;
    }
    #photosphere {
      width: 100%;
      height: 100%;
    }

    .psv-button.custom-button {
      font-size: 22px;
      line-height: 20px;
    }
  </style>
</head>
<body>

 @yield('content')

</body>
</html>
