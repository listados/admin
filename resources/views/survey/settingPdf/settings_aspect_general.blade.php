@extends('layouts.admin_template')

@section('content')
{{ Html::script('/local/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}
{{ Html::script('/local/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}
<script>
    $(function () {       
        $('#setting_aspect').ckeditor();  
       
    });       
</script>
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or " Configurar Aspectos Gerais" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li><a href="{{ url('/admin/configuracao') }}">Configuração</a></li>
                <li><a href="#">Configurar Vistoria</a></li>
                <li class="active"><a href="{{ url('configuracao/conf-ressalva') }}">Ressalva</a></li>
                
            </ol>
        </section>

        <!-- Main content -->
<section class="content">
@if ( Session::has('mensagem'))
    <div class="alert alert-info">
        {{ Session::get('mensagem') }}
    </div>
@endif

<div class="row">
@include('setting.menu_setting')
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Texto aspectos gerais atual</h3>
            </div>
            <div class="box-body">
            @foreach($setting as $settings)
                {!! $settings->settings_aspect_general !!}
            @endforeach
            <br>
            {{Form::open(array('url' => '/vistoria/alterar-aspectos'))}}
            <div class="box-body pad">
                <textarea id="setting_aspect" name="settings_aspect_general" rows="10" cols="80"></textarea>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <hr>
                       {{Form::submit('Alterar', array('class' => 'btn btn-primary pull-left btn-flat btn-lg'))}}
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
        </div>

    </div>
</div>

</section>
    </div><!-- /.content-wrapper -->




@endsection
