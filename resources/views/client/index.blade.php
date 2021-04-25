@extends('layouts.admin_template')
@section('content')
{{ Html::style('public/dist/css/clients.min.css') }}

<!-- Sidebar -->
@include('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			{{ $page_title or "Clientes" }}
			<small>{{ $page_description or null }}</small>
		</h1>
		<!-- You can dynamically generate breadcrumbs here -->
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
			<li>Clientes</li>
			<li class="active"><a href="{{ url('clientes') }}">Clientes</a></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				{{ Form::open(['url' => '', 'id' => 'form_client']) }}
				<div class="box box-primaru">
					<div class="box-header with-border">
						<h3 class="box-title">Dados Pessoais</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<label>Tipo de Cliente: </label>
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-primary active ">
										<input type="radio" name="clients_option" checked="true" value="Proprietário" id="option1" autocomplete="off" title="Cadastrar Cliente Proprietário">
										<span class="glyphicon glyphicon-ok"></span> Proprietário
									</label>
									<label class="btn btn-primary">
										<input type="radio" name="clients_option" value="Interessado" id="option1" autocomplete="off" title="Cadastrar Cliente Intessado">
										<span class="glyphicon glyphicon-ok"></span> Interessado
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<label>Tipo de Pessoa: </label>
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-primary active ">
										<input type="radio" name="clients_type" value="Pessoa Física" checked="true" id="option2" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span> Pessoa Físca
									</label>
									<label class="btn btn-primary">
										<input type="radio" name="clients_type" id="option2" value="Pessoa Jurídica" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span> Pessoa Jurídica
									</label>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<span>Nome Completo</span>
								<input type="text" class="form-control" name="clients_name" >
							</div>
							<div class="col-xs-12 col-md-6">
								<span>E-mail</span>
								<input type="text" class="form-control" name="clients_email"
								>
							</div>
							<div class="col-xs-6 col-md-4">
								<span>CPF</span>
								<input type="text" class="form-control" name="clients_cpf" id="clients_cpf">
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Data de Nascimento</span>
								<input type="text" class="form-control" name="clients_birth_date" id="clients_birth_date">
							</div>
							<div class="col-xs-6 col-md-4">
								<span>RG</span>
								<input type="text" class="form-control" name="clients_rg">
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Midia de Origem</span>
								<select id="cboClienteMidia" name="clients_media"  class="form-control">
									<option value="Selecione">Selecione</option>
									<optgroup label="Internet">
										<option value="E-mail MKT">E-mail MKT</option>
										<option value="Facebook">Facebook</option>
										<option value="Google">Google</option>
										<option value="inGaia Imob (Radar)">inGaia Imob (Radar)</option>
										<option value="Instagram">Instagram</option>
										<option value="O Povo Online">O Povo Online</option>
										<option value="OLX">OLX</option>
										<option value="Site da Imobiliária" selected="true">Site da Imobiliária</option>
										<option value="Viva Real">Viva Real</option>
										<option value="ZAP">ZAP</option>
									</optgroup>
									<optgroup label="Jornal">
										<option value="Diario do Nordeste">Diario do Nordeste</option>
									</optgroup>
									<optgroup label="Mídias externas">
										<option value="Outdoor">Outdoor</option>
									</optgroup>
									<optgroup label="Outros">
										<option value="Captação">Captação</option>
										<option value="Evento">Evento</option>
										<option value="Indicação">Indicação</option>
										<option value="Não informado">Não informado</option>
										<option value="Placa">Placa</option>
									</optgroup>
									<optgroup label="Revista">
										<option value="Revista">Revista</option>
									</optgroup>
								</select>
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Sexo</span>
								{{ Form::select('clients_sex', ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'], 'Masculino' , ['class' => 'form-control']) }}
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Estado Civil</span>
								<select id="cboEstadoCivil" name="clients_marital_status"  class="form-control">
									<option value="Não informado">Não informado</option>
									<option value="Solteiro(a)">Solteiro(a)</option>
									<option value="Casado(a)" selected="true">Casado(a)</option>
									<option value="Divorciado(a)">Divorciado(a)</option>
									<option value="Viúvo(a)">Viúvo(a)</option>
									<option value="União estável">União estável</option>
								</select>
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Naturalidade</span>
								<input type="text" class="form-control" name="clients_naturalness">
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Nacionalidade</span>
								<input type="text" class="form-control" name="clients_nationality">
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Renda</span>
								<input type="text" class="form-control" name="clients_rental_finance" id="clients_rental_finance">
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Escolaridade</span>
								<select id="cboNivelCultural" class="form-control" name="clients_scholarity">
									<option value="Não especificado">Não especificado</option>
									<option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
									<option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
									<option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
									<option value="Ensino Medio Completo">Ensino Medio Completo</option>
									<option value="Superior Incompleto" selected="true">Superior Incompleto</option>
									<option value="Superior Completo">Superior Completo</option>
									<option value="Pós-graduado Incompleto">Pós-graduado Incompleto</option>
									<option value="Pós-graduação Completo">Pós-graduação Completo</option>
									<option value="Mestrado Incompleto">Mestrado Incompleto</option>
									<option value="Mestrado">Mestrado</option>
									<option value="Doutorado Incompleto">Doutorado Incompleto</option>
									<option value="Doutorado">Doutorado</option>
								</select>
							</div>
							<div class="col-xs-6 col-md-4">
								<span>Corretor</span>
								<input type="text" class="form-control" name="clients_id_user" id="clients_id_user">
							</div>
							<div class="col-lg-4">
								<span>Fone</span>
								<div class="input-group">
									<input type="text" name="phones_number[]" class="form-control" onkeyup="mascara( this, mtel );" maxlength="15">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" id="addPhoneClient"><i class="fa fa-plus"></i></button>
									</span>
								</div>
								<!-- /input-group -->
							</div>
							<!-- /.col-lg-6 -->
							<div id="phoneClient"></div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!--ENDEREÇO DO CLIENTE -->
				<!--collapsed-box FAZ O BOX JÁ INICIAR PEQUENO -->
				<div class="box box-primary collapsed-box">
					<div class="box-header with-border">
						<h4>Endereço</h4>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="col-xs-12 col-md-2">
							<span>Cep</span>
							<input type="text" class="form-control" id="cep_client" name="clients_cep">
						</div>
						<div class="col-xs-12 col-md-4">
							<span>Logradouro</span>
							<input type="text" class="form-control" name="clients_address" id="logradouro">
						</div>
						<div class="col-xs-12 col-md-2">
							<span>Número</span>
							<input type="text" class="form-control" name="clients_address_number" id="number_client" value="168">
						</div>
						<div class="col-xs-12 col-md-4">
							<span>Complemento</span>
							<input type="text" class="form-control" name="clients_address_complement">
						</div>
						<div class="col-xs-12 col-md-4">
							<span>Bairro:</span>
							<input type="text" class="form-control" name="clients_district" id="distict_client">
						</div>
						<div class="col-xs-12 col-md-4">
							<span>Cidade</span>
							<input type="text" class="form-control" name="clients_city" id="city_client">
						</div>
						<div class="col-xs-12 col-md-2">
							<span>Estado</span>
							<input type="text" class="form-control"  name="clients_state" id="estate_client">
						</div>
					</div>
				</div>

				<div class="box-footer">              
					<button type="button" id="save_client" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Salvar Cliente</button>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->
@push('scripts')
{{ Html::script('public/dist/js/clients.min.js') }}
@endpush
@endsection
<!--                            <div class="col-xs-6 col-md-8">
    <span>Observação</span>
    <textarea class="form-control" cols="10"></textarea>
</div>-->
