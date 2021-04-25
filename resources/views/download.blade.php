@extends('layouts.admin_template')
@section('content')
<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    {{ Html::style('public/plugins/bootstrap-fileinput/css/fileinput.min.css') }}
    {{ Html::style('public/plugins/lightbox/dist/ekko-lightbox.min.css') }}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $page_title or "DOWNLOAD DE ARQUIVOS" }}
            <small>{{ $page_description or null }}</small>
        </h1>

        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li>Proposta</li>
            <li class="active">Download de Arquivos </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- EDITAR USUARIO FORM -->
        <!-- Default box -->
      
        @include('messages.general')
        @include('messages.info')

        <div class="col-md-12 box">
            <div class="box-body">
                <div class="col-md-3 col-xs-12">
                    <label for="" class="text-danger">Baixar todos os arquivos</label>
                    <a href="{{url('baixar-todos/'.$proposta[0]->$campo.'/'.$tipo)}}" class="btn btn-default" title="Baixar Zip" ><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-3 col-xs-12">
                    {{ Form::label('upload','Fazer Upload') }}
                    <!-- Button trigger modal -->
                    <a href="#upload" class="btn btn-default"  title="Fazer upload de novos arquivos" data-toggle="modal">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12">
                    {{ Form::label('upload','Atualizar') }}
                    <!-- Button trigger modal -->
                    <a href="{{ url('download-arquivo/'.$id_survey.'/'.$tipo) }}" class="btn btn-default"  title="Atualizar Arquivos" >
                    <i class="fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

        @include('modal.modal_upload_file')

        </div>
        <div class="box col-md-9">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Arquivo da proposta</strong> 
                    @foreach($proposta as $propostas)
                    {{$propostas->$campo}} <strong>de</strong> {{-- {{$propostas->proposal_name}} --}}
                    @endforeach
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimiar">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remover">
                    <i class="fa fa-times"></i></button>
                    
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>NomeArquivo</th>
                                    <th>Data Envio</th>
                                    <th>N. Proposta</th>
                                    <th>Imagem</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{ Form::open(['url' => 'delete-image']) }}
                                @foreach($files as $arq)
                                <tr>
                                    <td>{{$arq->files_name}}</td>
                                    <td>{{date('d/m/Y', strtotime($arq->files_date))}}</td>
                                    <td>{{$arq->files_id_proposal}}</td>
                                    <td>
                                        <?php
                                            $extensao = '.pdf';
                                            
                                              if(strripos($arq->files_name, $extensao) == true){
                                                echo '<iframe src="'.$dominio_pdf_externo.'/public/img/upload/'.$arq->files_name.'" frameborder="0" width="128" height="128"></iframe>';
                                              }else{
                                                echo '<a href="'.$dominio_pdf_externo.'/public/img/upload/'.$arq->files_name.'" data-toggle="lightbox" data-title="Imagem" data-footer="'.$arq->files_name.'">                                                    
                                                    <img src="'.$dominio_pdf_externo.'/public/img/upload/'.$arq->files_name.' "  width="128" class="img-fluid">
                                                </a>';
                                              }
                                            ?>
                                    </td>
                                    <td>
                                    <a href="{{url('file/'.base64_encode($arq->files_id).'/delete')}}" title="Excluir esse arquivo" class="btn" onclick="return confirm('Deseja realmente excluir esse arquivo?');">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{url('baixar/'.$arq->files_name)}}"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="array_delete[]" value="{{ $arq->files_id }}" title="Excluir Arquivos">                
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach()
                                {{ Form::submit( 'Excluir Arquivos' ,['class' => 'pull-right btn-danger']) }}
                                {{ Form::close() }}
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Download de arquivos
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@push('scripts')
{{ Html::script('public/plugins/bootstrap-fileinput/js/fileinput.min.js') }}
{{ Html::script('public/plugins/bootstrap-fileinput/js/locales/pt-BR.js') }}
{{ Html::script('public/plugins/lightbox/dist/ekko-lightbox.min.js') }}

<script type="text/javascript">
    $("#new_files").fileinput({
        language: "pt-BR",
        uploadUrl: domain_complet+'/files-upload/'+'{{ $id_survey }}/tipo/'+'{{ $tipo }}', // server upload action
        uploadAsync: true,
        maxFileCount: 5,
        allowedFileExtensions: ['jpg', 'gif', 'png', 'txt', 'doc' , 'docx' , 'xls' , 'pdf' , 'xlsx']
    });

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>
@endpush
@endsection
