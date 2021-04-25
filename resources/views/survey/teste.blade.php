@extends('layouts.admin_template')

@section('content')
{{ Html::script('public/dist/js/crud_survey.js') }}
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
       
            <h1>
                {{ $page_title or "EM DESENVOLVIMENTO" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                <li>Proposta</li>
                 <li class="active">Em desenvolvimentox'</li>
            </ol>
        </section>

        <!-- Main content -->
<section class="content">
@if ( Session::has('mensagem'))
    <div class="alert alert-info">
        {{ Session::get('mensagem') }}
    </div>
@endif

<?php
$id_survey = 176;

$photo = DB::table('files_ambience')->where('files_ambience_id_survey', '=', $id_survey)->get();
//list($width, $height, $type, $attr) = getimagesize("img/flag.jpg");


foreach ($photo as $photos) {
    # code...
    $photos->files_ambience_description_file;
    list($width, $height, $type, $attr) = getimagesize(url('public/dist/img/upload/vistoria/'. $photos->files_ambience_description_file));
    echo $width.'-'.$height.'<br>';
}
?>


</section>
    </div><!-- /.content-wrapper -->




@endsection
