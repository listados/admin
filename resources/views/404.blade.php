@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "Erro 404." }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            
        </section>

    <section class="content">

      <div class="error-page">
        <h2 class="headline text-red">404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Página não encontrada.</h3>

          <p>
            @if ( Session::has('mensagem'))
			    <div class="alert alert-warning">
			        {{ Session::get('mensagem') }}
			    </div>
			@endif
			@if (session('mensagem'))
			<div class="alert alert-success">
				{{ session('mensagem') }}
			</div>
			@endif

          </p>
          <p>
            Não foi possível encontrar a página que você estava procurando. Enquanto isso, você pode retornar a <a href="{{ url('/') }}">página inicial</a> e tentar novamente.
          </p>

       
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
    </div><!-- /.content-wrapper -->




@endsection
