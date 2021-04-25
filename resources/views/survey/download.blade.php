@extends('layouts.admin_template')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/survey.min.css') }}">
<!-- Sidebar -->
@include('sidebar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "Imagens por ambiente" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li><a href="{{ url('vistoria') }}">Vistoria</a></li>
            <li class="active">Imagens de Ambiente</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
<div class="form-group">
    <!-- CAMPO PARA PASSAR O VALOR DA VISTORIA PARA A REQUISIÇÃO -->
     <input type="hidden" name="id_survey_ambience" id="id_survey_ambience" value="{{ $id_survey }}">
 </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col md-8">
                    @include('messages.general')
                </div>
                <div class="col md-4">
                    <a href="#modal_ambience" data-toggle="modal" class="btn pull-right bg-navy margin" title="Incluir foto por ambiente">
                        <i class="fa fa-upload"></i> Inlcuir Foto
                    </a>
                </div>
            </div>
        </div>

    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">

                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-ambience-survey">
                            <thead>
                                <tr>
                                    <th>Ambiente</th>
                                    <th>Arquivo</th>
                                    <th>Alterar Ambiente</th>
                                    <th>Excluir</th>                                        
                                </tr>
                            </thead>

                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Ambiente</td>
                                    <td>Arquivo</td>
                                    <td>Alterar</td>
                                    <td>Excluir</td>
                                </tr>
                            </thead>
                   {{--          <tbody>
                                @foreach($files_ambience as $files_ambiences)
                                    <tr>
                                        <td>{{ $files_ambiences->files_ambience_id_ambience }}</td>
                                        <td>{{ $files_ambiences->files_ambience_description_file }}</td>                                        
                                        <td>Alterar</td>
                                        <td>Excluri</td>
                                    </tr>

                                @endforeach
                            </tbody> --}}
                            <tr>

                                <th></th>
                                <th></th>
                                <th>
                                    {!!  Html::decode(link_to('#', '<i class="fa fa-edit" aria-hidden="true"></i>',['title' => 'Alterar todos ambiente marcados', 'data-toggle' => 'modal' , 'data-target' => '#alter_ambience' , 'class' => 'btn btn-flat btn-primary pull-right'])) !!}
                                </th>
                                <th>
                                    {!!  Html::decode(link_to('#', '<i class="fa fa-trash" aria-hidden="true"></i>',['title' => 'Excluir todos ambiente marcados', 'id' => 'sendDeleteAmbience' , 'class' => 'btn btn-flat btn-danger pull-right'])) !!}
                                </th>
                            </tr>
                        </table>
                    </div> 
                    @include('modal.survey_ambience_upload')
                    @include('modal.modal_alter_ambience')
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<!-- /.content-wrapper -->
@push('scripts')

{{ Html::script('dist/js/upload_ambience.js') }}
{{ Html::script('plugins/datatables/jquery.dataTables.min.js') }}
{{ Html::script('dist/js/image_ambience.min.js') }}
<script type="text/javascript" src="{{ asset('dist/js/survey.min.js') }}"></script>
@endpush()
@endsection
