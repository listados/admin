
$(document).ready(function() {
	
	//CAPTURA O NOME DO HOST EX: HTTP://LOCALHOST
	var rota = window.location.origin+'/admin';
	
	$('#info-perfil').hide();

	

	$('#cadastrar-perfil').click(function() {
		/* Act on the event */

		dados = {
			profile_name : $('#name_profile').val()
		};
		console.log( $('#name_profile').val());
		$.ajax({
			url: rota+'/cadastrar-perfil',
			type: 'POST',
			dataType: 'JSON',
			data: dados,
			success:function(data){
				$('#info-perfil').show();
				$('#name_profile').val('');
			}
		})

		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});//fim cadastrar-perfil

	$('#id_profile').change(function() {
		/* Act on the event */
		var id_profile 	= $(this).val();
		var id_user 	= $('#id_user').val();
		console.log(id_profile);
	
		$.get( rota + '/alterar-perfil/'+id_profile, function( data ) {
			
		})
		.done(function() {
		 	alert('Alterado Perfil');
			console.log("success");
		})
		.fail(function() {
		    alert( "error" );
		  });
	});
	

});
/*ALTERANDO O PERFIL DAS PROSPOTAS*/
//08/07/2016 as 19:20 by Junior Oliveira
function editarPerfilProposta(id){
	var rota_adm = window.location.origin+'/admin';
	id_profile = id;
	
	$.ajax({
		url: rota_adm+'/alterar-perfil-proposta/'+id,
		type: 'POST',
		dataType: 'JSON',
		data: {settings_id_profile :  id_profile},
		success:function(){
			//passando o id do perfil concatenando com o nome da div
			$('#info_profile_proposal_success_'+id).show();
		}
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	

}