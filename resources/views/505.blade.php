@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "Acesso negado" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            
        </section>

    <section class="content">

      <div class="error-page">
        <h2 class="headline text-red">500</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Acesso negado.</h3>

          <p>
           Você não tem permissão para acessar essa página, então, dirija-se ao administrador e passa a permissão para ele.

          </p>

       
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
    </div><!-- /.content-wrapper -->




@endsection
