   var id_vis = $('#id_vistoria').val();

function save_locator(id , x) {
	console.log("x: "+x);
	if(x == null){
		name_locator  = $("#nome_locador").val();
		email_locator = $("#survey_locator_email").val();		
		cpf_locator   = $("#cpf_locador").val(); 
		//alert("id: "+id+" nome: "+name_locator+ " email: "+email_eccupant + " cpf: "+cpf_occupant);
	}else{
		  name_locator  = $("#nome_locador_"+x).val();
    	email_locator = $("#email_locador_"+x).val();
    	cpf_locator   = $("#cpf_locador_"+x).val(); 
    	//alert("nome: "+name_locator+ " email: "+email_eccupant + " cpf: "+cpf_occupant);
	}

   //  name_locator = $("#nome_locador_"+x).val();
   //  cpf_occupant  = $("#cpf_locador_"+x).val();
   //  email_eccupant= $("#email_locador_"+x).val();
   // // alert("vistoria: " + id + " cpf: "+ cpf_grava + " email: "+email_grava);
     rota = domain_complet;

        data_new_survey = {

            survey_id: id_vis, name: name_locator, password: cpf_locator, email: email_locator, relation_survey_user_type: "Locador"

        };

        $.ajax({
            url: rota + '/vistoria/cadastrar-locador-adicional',
            type: 'POST',
            dataType: 'JSON',
            data: data_new_survey,
            success: function (data) {
                console.log('ok');
            }
        })
        .done(function () {
            console.log("success");
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
}  

function save_loc(id , x) {
    name_locatario = $("#nome_locatario_"+x).val();
    cpf_locatario  = $("#cpf_locatario_"+x).val();
    email_locatario= $("#email_locatario_"+x).val();
   // alert("vistoria: " + id + " cpf: "+ cpf_grava + " email: "+email_grava);
     rota = domain_complet;

        data_new_loc = {

            survey_id: id_vis, name: name_locatario, password: cpf_locatario, email: email_locatario, relation_survey_user_type: "Locatário"

        };

        $.ajax({
            url: rota + '/vistoria/cadastrar-locatario-adicional',
            type: 'POST',
            dataType: 'JSON',
            data: data_new_loc,
            success: function (data) {
                console.log('ok');
            }
        })
        .done(function () {
            console.log("success");
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
}    
