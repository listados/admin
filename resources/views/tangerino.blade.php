@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">       
            <h1>
                {{ $page_title or "PONTO ELETRÔNICO" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li class="active">Tangerino</li>
            </ol>
        </section>

        <section class="content">
              <iframe src="http://app.tangerino.com.br/Tangerino/pages/LoginPage;jsessionid=ea7d206bb5752efb6a4efc466760" width="1180" height="900" style="background: #FFF;"></iframe>

        </section>
    </div><!-- /.content-wrapper -->




@endsection
