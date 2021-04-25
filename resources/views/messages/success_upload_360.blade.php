@if (session()->has('sucess_update_360'))
    <div class="alert alert-success  alert-dismissible"  role="alert">
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       {{ session('sucess_update_360') }}
		<div class="form-group">			
				<label for="">Deseja fazer upload de outro ambiente?</label>
				<p>
					<button type="button" class="btn btn-default" data-toggle="modal" 
	                  data-target="#modal_ambience_360"> Sim 
	                </button>
            	</p>
		</div>
    </div>
@endif