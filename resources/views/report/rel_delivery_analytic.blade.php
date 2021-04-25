@extends('layouts.admin_template')

@section('content')


<!-- Sidebar -->
@include('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">

		<h1>
			{{ $page_title or "RELATÓRIOS" }}
			<small>{{ $page_description or null }}</small>
		</h1>
		<!-- You can dynamically generate breadcrumbs here -->
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
			<li class="active">Relatórios</li>

		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-3">


				<div class="list-group">
					<a href="{{ url('report') }}" class="list-group-item active">
						<i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
					</a>

				</div>
			</div>

			<div class="col-md-9">

				<div class="box box-body box-primary">
					@if($type_report == 0)
					<table class="table table-bordered"> 
						<thead> 
							<tr> 
								<th>Nome Despachante</th>  
								<th>Data Serviço</th>
								<th>Cod Imóvel</th>
								<th>Solicitado por</th>
								<th>Valor para pagar</th> 
								<th>Ação</th>
							</tr> 
						</thead> 
						<tbody> 
							@foreach ($delivery as $deliveries)
							@php $text_info = "Deseja realmente excluir esse Despachante?" @endphp
								<tr> 								
									<td>{{ $deliveries->deliveries_name }}</td> 
									<td>{{ $carbon->parse($deliveries->date_visit)->format('d/m/Y H:i:s') }}</td>
									<td>{{ $deliveries->report_deliveries_code_immobile }}</td>
									<td>{{ \AdminEspindola\Helpers::getNameUser($deliveries->report_deliveries_id_user) }}</td>
									<td>{{ number_format($deliveries->report_deliveries_value, 2 , ',' , '.') }}</td>
									<td><a href="#" onclick="modal_delete_ajax({{$deliveries->report_deliveries_id}} , 'report-delivery' , 'deliveries_id' , '{{$text_info}}' , '/report' ); " class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
								</tr> 
							@endforeach
							
						</tbody> 
					</table>

					@elseif($type_report == 1)
					<table class="table table-bordered"> 
						<thead> 
							<tr> 
								<th>Nome Despachante</th>  <th>Valor a receber</th> 
							</tr> 
						</thead> 
						<tbody> 
							@foreach ($delivery as $deliveries)
								<tr> 								
									<td>{{ $deliveries->deliveries_name }}</td> 
									<td>{{ \AdminEspindola\ReportDelivery::getTotalValue($deliveries->deliveries_id) }}</td>
								</tr> 
							@endforeach
							
						</tbody> 
					</table>
					@endif
				</div>
			</div>

		</div>
		<!-- Modal -->
		@include('modal.modal_delete_ajax')
	</section>
</div><!-- /.content-wrapper -->

@push('scripts')

{{ Html::script('public/dist/js/function_all.min.js') }}

@endpush


@endsection
