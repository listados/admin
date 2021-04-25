@extends('layouts.admin_template')

@section('content')


    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "Tour Virtual" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Imóveis</a></li>
                <li class="active">Tour Virtual</li>
            </ol>
        </section>

        <!-- Main content -->
<section class="content">
@include('messages.error')
@include('messages.error_message')
@include('messages.success')
@include('messages.info')



<div class="box">
            <div class="box-header">
              <h3 class="box-title">Todos os Tour Virtual</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nome do Tour</th>
                  <th>Criado em</th>
                  <th>Ação</th>
                 
                </tr>
                </thead>
                <tbody>
                @foreach($tour as $tours)
                <tr>
                  <td>{{$tours->tour_name}}</td>
                  <td>{{ date("d/m/Y" , strtotime($tours->created_at))}}
                  </td>
                  <td>
                  	<a href="http://localhost/360/ver-360.php?id={{$tours->tour_name}}" title="Ver tuor virtual" target="_blank" ><i class="fa fa-street-view" aria-hidden="true"></i></a>
                  </td>
                  
                </tr>
               
               @endforeach
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</section>
</div><!-- /.content-wrapper -->




@endsection
