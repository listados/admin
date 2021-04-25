$(document).ready(function () {

	function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#distict_client").val("");
        $("#city_client").val("");
        $("#estate_client").val("");

    }

    //Quando o campo cep perde o foco.
    $("#cep_client").blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.

                $("#logradouro").val("...");
                $("#distict_client").val("...");
                $("#city_client").val("...");
                $("#estate_client").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                	if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);
                        $("#distict_client").val(dados.bairro);
                        $("#city_client").val(dados.localidade);
                        $("#estate_client").val(dados.uf);
                        $("#number_client").focus();
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
    /*dados do cliente*/
    $("#clients_cpf").inputmask("999.999.999-99");
    $("#clients_birth_date").inputmask("99/99/9999");
    /*mascara CEP*/
    $("#cep_client").inputmask("99.999-999");

    
});//fim ready

$(function () {
	/*ADICIONANDO TELEFONE DE CLIENTE*/
	var click = 2;
	$("#addPhoneClient").click(function () {
		count = (click++);
		add_phone = '<div class="col-xs-6 col-md-4">' +
		'<span>Fone ' + count + '</span>' +
		'<input type="text" name="phones_number[]" class="form-control" onkeyup="mascara( this, mtel );" maxlength="15">' +
		'</div>';
		$("#phoneClient").append(add_phone);
	})

	$("#clients_rental_finance").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

	$("#save_client").click(function(){

		$.ajax({
			url: domain_complet + '/clientes',
			type: 'POST',
			dataType: 'json',
			data:  $("#form_client").serializeJSON(),
			success: function(){
				new PNotify({
					title: 'Sucesso',
					text: 'Cliente Cadastrado com sucesso',
					styling: 'fontawesome',       
					type: 'success',
					icon: 'true',
					animation: 'fade',
					delay: 3000,
					animate_speed: "slow"
				});
				$("#title_info_body").html('Cliente cadastrado com sucesso');
				$("#title_description_body").html('Deseja cadastrar um novo cliente?');
				$("#success_redirect").modal('show');
	   		//ADICIONANDO REDIRECIONAMENTO NO BOTÃO
	   		$("#redirect_message_sim").attr('href', domain_complet + '/clientes');
	   		$("#redirect_message_nao").attr('href', domain_complet + '/');

	   	}
	   })
		.fail(function() {
			new PNotify({
				title: 'Erro no cadastro',
				text: 'Atualize a página ou tente mais tarde',
				styling: 'fontawesome',       
				type: 'error',
				icon: 'true',
				animation: 'fade',
				delay: 5000,
				animate_speed: "slow"
			});
		})
		.always(function() {
			console.log("complete");
		});
		
});//fim save_client

});
