@extends('layouts.admin_template')

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ $page_title or "Painel de Propostas" }}
      <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$count_proposal_pf}}</h3>

            <p>Proposta Pessoa Física</p>
          </div>
          <div class="icon">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
          </div>
          <a href="{{url('/proposta-pf')}}" class="small-box-footer">Todas <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{$count_proposal_pj}}</h3>

            <p>Proposta Pessoa Jurídica</p>
          </div>
          <div class="icon">
            <i class="fa fa-users" aria-hidden="true"></i>
          </div>
          <a href="{{url('proposta-pj')}}" class="small-box-footer">Todas <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$count_guarantor_pf}}</h3>

            <p>Fiador/Locatário P. F</p>
          </div>
          <div class="icon">
            <i class="fa fa-child" aria-hidden="true"></i>
          </div>
          <a href="{{url('/cadastro-pf')}}" class="small-box-footer">Todas<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$count_guarantor_pj}}</h3>

            <p>Fiador/Locatário P. J</p>
          </div>
          <div class="icon">
            <i class="fa fa-building" aria-hidden="true"></i>
          </div>
          <a href="{{url('cadastro-pj')}}" class="small-box-footer">Todas<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <div class="row">
      <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Links mais usados (Atalho)</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="col-md-4">
             <a href="{{ url('imovel') }}" class="btn btn-primary" title="Todos os Imóveis"><i class="fa fa-home"></i> Imóvel</a>
            </div>
            <div class="col-md-4">
             <a href="https://espindolaimobiliaria.com.br/admin/vistoria" target="_blank"  class="btn btn-primary" title="Todas as Vistorias" ><i class="fa fa-pencil-square-o"></i> Vistoria</a>
            </div>
            <div class="col-md-4">
              <a href="{{ url('chaves') }}"  class="btn btn-primary"  title="Controle de chaves/Visitas" ><i class="fa fa-key"></i> Chaves</a>
            </div>
            <div class="row">
             <div class="col-md-12">
              <br>
              <div class="panel panel-default">
                <div class="panel-heading">Escolha Azul</div>
                <div class="panel-body"> 
                <div class="col-md-3">
                  <a href="{{ url('proposta-pf') }}" title="Proposta Pessoa Física" class="btn btn-app"><i class="fa fa-file-powerpoint-o"></i> Pessoa Física</a>
                </div>
                <div class="col-md-3">
                  <a href="{{ url('proposta-pj') }}"  class="btn btn-app" title="Proposta Pessoa Jurídica"><i class="fa fa-file-powerpoint-o"></i> Pessoa Jurídica</a>
                </div>
                <div class="col-md-3">
                  <a href="{{ url('cadastro-pf') }}" class="btn btn-app" title="Cadastro Pessoa Física"><i class="fa fa-pencil-square-o"></i> Cadastro Física</a>

                </div>
                <div class="col-md-3">
                  <a href="{{ url('cadastro-pj') }}" class="btn btn-app" title="Cadastro Pessoa Jurídica"><i class="fa fa-pencil-square-o"></i> Cadastro Jurídica</a>
                </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- /.box -->
    </div>

    <!--chat -->
{{--     <div class="col-md-6">
      <!-- DIRECT CHAT -->
      <div class="box box-warning direct-chat direct-chat-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Bate-papo</h3>

          <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
              <i class="fa fa-comments"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
              <!-- Message. Default to the left -->
              <div class="direct-chat-msg">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-left">Alexander Pierce</span>
                  <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/profile/profile_user.jpg" alt="message user image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  Is this template really for free? That's unbelievable!
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-right">Sarah Bullock</span>
                  <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="http://data.whicdn.com/images/187419238/large.jpg" alt="message user image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  You better believe it!
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

              <!-- Message. Default to the left -->
              <div class="direct-chat-msg">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-left">Alexander Pierce</span>
                  <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/profile/profile_user.jpg" alt="message user image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  Working with AdminLTE on a great new app! Wanna join?
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-right">Sarah Bullock</span>
                  <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="http://data.whicdn.com/images/187419238/large.jpg" alt="message user image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  I would love to.
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->

            </div>
            <!--/.direct-chat-messages-->

            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
              <ul class="contacts-list">
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="http://media-portal.net/role_files/profile2.jpg" alt="User Image">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Count
                        <small class="contacts-list-date pull-right">2/28/2015</small>
                      </span>
                      <span class="contacts-list-msg">How have you been? I was...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="http://s1.favim.com/610/160106/alt-girl-dyed-hair-grey-hair-silver-hair-Favim.com-3848401.jpg" alt="User Image">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Sarah Doe
                        <small class="contacts-list-date pull-right">2/23/2015</small>
                      </span>
                      <span class="contacts-list-msg">I will be waiting for...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="http://s1.favim.com/610/150806/alt-girl-black-hair-bodymods-dyed-hair-Favim.com-3070141.jpg" alt="User Image">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Nadia Jolie
                        <small class="contacts-list-date pull-right">2/20/2015</small>
                      </span>
                      <span class="contacts-list-msg">I'll call you back at...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="http://s6.favim.com/610/150422/beautiful-black-girl-gorgeous-Favim.com-2672926.jpg" alt="User Image">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Nora S. Vans
                        <small class="contacts-list-date pull-right">2/10/2015</small>
                      </span>
                      <span class="contacts-list-msg">Where is your new...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Image">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        John K.
                        <small class="contacts-list-date pull-right">1/27/2015</small>
                      </span>
                      <span class="contacts-list-msg">Can I take a look at...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
                <li>
                  <a href="#">
                    <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Image">

                    <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        Kenneth M.
                        <small class="contacts-list-date pull-right">1/4/2015</small>
                      </span>
                      <span class="contacts-list-msg">Never mind I found...</span>
                    </div>
                    <!-- /.contacts-list-info -->
                  </a>
                </li>
                <!-- End Contact Item -->
              </ul>
              <!-- /.contatcts-list -->
            </div>
            <!-- /.direct-chat-pane -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <form action="#" method="post">
              <div class="input-group">
                <input type="text" name="message" placeholder="Digite sua mensagem" class="form-control">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-warning btn-flat">Enviar</button>
                </span>
              </div>
            </form>
          </div>
          <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
      </div>
      <!-- fim chat -->
    </div> --}}

    <div class="row">

    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box-body">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
            Sistema em versão beta. Todos as informações contida aqui se refere a Janeiro de 2016 até a data atual.
          </div>
        </div>  
      </div>
    </div>


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- ChartJS 1.0.1 -->
<script src="{{ url('plugins/chartjs/Chart.min.js') }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="{{ url('dist/js/app.min.js') }}" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ url('dist/js/demo.js') }}" type="text/javascript"></script>


<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho"],
      datasets: [
      {
        label: "Proposta Ano 2016",
        fillColor: "rgba(210, 214, 222, 1)",
        strokeColor: "rgba(210, 214, 222, 1)",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [{{$tol_jan_16}}, {{$tot_fev_16}}, {{$tol_mar_16}}, {{$tol_abr_16}}, {{$tol_mai_16}}, {{$tol_jun_16}}, {{$tol_jul_16}}]
      },
      {
        label: "Proposta Ano 2015",
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [{{$tol_jan_15}}, {{$tot_fev_15}}, {{$tol_mar_15}}, {{$tol_abr_15}}, {{$tol_mai_15}}, {{$tol_jun_15}}, {{$tol_jul_15}}]
      }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
    {
      value: 700,
      color: "#f56954",
      highlight: "#f56954",
      label: "Chrome"
    },
    {
      value: 500,
      color: "#00a65a",
      highlight: "#00a65a",
      label: "IE"
    },
    {
      value: 400,
      color: "#f39c12",
      highlight: "#f39c12",
      label: "FireFox"
    },
    {
      value: 600,
      color: "#00c0ef",
      highlight: "#00c0ef",
      label: "Safari"
    },
    {
      value: 300,
      color: "#3c8dbc",
      highlight: "#3c8dbc",
      label: "Opera"
    },
    {
      value: 100,
      color: "#d2d6de",
      highlight: "#d2d6de",
      label: "Navigator"
    }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>
@endsection
