/*creadet in 2016/07/06 by Junior Oliveira*/
//atualiza_notificacao();
//FUNCAO QUE TERA O RETORNO DE UM TOTAL DE NOTIFICAÇÕES NAO LIDA VINDO DO BANCO
function total_notificacao_nao_lida(id_user){
		var total_Not = 0;
		var rota =  window.location.origin + '/admin';
		$.get( rota+'/total-notificacao/'+id_user, function(note, total_Not) {

	     $(note).each(function(index, el) {
	     	//COLOCANDO O TOTAL DE NOTIFICAÇÕES NO ELEMENTO VIA HTML
	     	$('#sum_notification').html(el.sum);
	     	$('#li-info-notif').html('Você tem '+el.sum+' Notificação(ões)');	
	     	
	     });
	  	
	});

};

function mostra_notificacoes(rota, id_user){

	$.get( rota+'/notificacao/'+id_user, function(res) {

		 //$( ".result" ).html( data );
		     $(res).each(function(index, elem) {
		     	
		     	console.log(elem.notification_id);			     	
		     	
		     	$('#li-info-notif').find('li a').remove();
	     		if(elem.notification_read == 0){
	     			row ='<li>'
		                +'<a href="#" title="'+elem.notification_description+'">'
		                    +elem.notification_description
		                  +'<input type="radio" name="notification_read"  class="pull-right" title="Lida" onclick="read_notif('+elem.notification_id+')"></a>'
		                +'</li>';
		            $('#notifi-menu').append(row);    
	     		};
		     });
		  	
		});
}

$(document).ready(function() {

	var rota =  window.location.origin + '/admin';
	var id_user = $('#id_user').val();
	console.log("id "+id_user);
	/* ------ RECUPERANDO O TOTAL DE NOTIFICAÇÕES E COLOCANDO NA HEADER---*/

	//CHAMANDO A FUNCAO QUE VERIFICA QUANTAS NOTIFICAÇÃO NAO FORAM LIDAS
	total_notificacao_nao_lida(id_user);
	
	mostra_notificacoes(rota, id_user);

});


//FUNCAO PARA PEGA O RETORNO DO BANCO DE TEM MENSAGENS PARA SER LIDA
function read_notif(id){
	 id_user 		= $('#id_user').val();
	 rota 			= window.location.origin + '/admin';
	var id_notificacao 	= id;
	dados = {
		notification_id : id_notificacao
	};
	$.ajax({
		url: rota + '/notificacao-lida/'+id_notificacao,
		type: 'GET',
		dataType: 'JSON',
		data: dados,
		success:function(){
			alert('Notificação lida');
			total_notificacao_nao_lida(id_user);
			$('#li-info-notif').load();
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
	
	
};

function atualiza_notificacao(){
	setInterval(function(){
		id_user_a 		= $('#id_user').val();
		
		total_notificacao_nao_lida(id_user_a);
	} , 5000);
}
