<!-- Modal -->
<div class="modal fade" id="modal_edit_delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar Delivery</h4>
			</div>
			{{ Form::open(['url' => '', 'id' => 'form_edit_delivery']) }}
			<div class="modal-body">
				<p>Editando delivery</p>
				<div class="row">
					<div class="box-body">
						<div class="row" id="body">
				
						</div>
					</div>
				</div>
				<input type="hidden" name="deliveries_id" id="deliveries_id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
				<button type="button" class="btn btn-primary" id="btn_edit_delivery">Alterar</button>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>