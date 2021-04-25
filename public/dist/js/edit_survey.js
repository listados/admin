

function managerData(id_survey){
	var route = domain_complet+'/vistoria/editar-vistoria/'+id_survey;
	console.log("Dominio comp: ".route);
	$.get(route, function(data) {
		/*optional stuff to do after success */
		console.log('dados: '+data);
		$(data).each(function(index, el) {
			row = 	'<div class="col-md-4">'+
					'<div class="form-group">'+
					'<input type="hidden" name="id_user[]" value="'+el.survey_id+'">'+
					'<label for="">Nome do Locador </label>'+
					'<input type="text" name="survey_locator_name[]" id="nome_locatario" value="'+el.survey_inspetor_name+'" placeholder="Nome do Locador" class="form-control">'+
					'</div>'+
					'</div>';
			$("#locator").append(row);
		});
	});
}
//FUNCAO PARA REDIRECIONAR APOS O MODAL DE INFORMAÇÃO
function redirect_route(route) {
    location.href = route;
}
function deleteUserSurvey(id, id_survey) {
	// body...
	//alert('excluir id: '+ id);
	route = domain_complet+'/vistoria/excluir-usuario-vistoria/'+id+'/vistoria/'+id_survey;
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      show: "slide",
      dialogClass: 'no-close',
      buttons: {
        "Sim": function() {
          redirect_route(route);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

}