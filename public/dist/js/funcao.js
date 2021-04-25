$(document).ready(function() {
	$('#info_profile_proposal_success').hide();
	$('#dialog_link_reset').hide();
	$('#dialog').hide();
	$('#dialog_load').hide();
	$('#dialog_success').hide();
	$('#dialog-confirm').hide();
	$('#sucess_ambiente').hide();
	$('#delete_ambiente_success').hide();
	$('#error_upload_ambiente').hide();


});
/*PARA MASCARAR OS TELEFONES PARA 9 DIGITOS*/
/* Máscaras ER */
function mascara(o,f){
    v_obj=o;
    v_fun=f;
    setTimeout("execmascara()",1);
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value);
}
function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function id( el ){
	return document.getElementById( el );
}
window.onload = function(){
	
	id('phoneUser').onkeyup = function(){
		mascara(this, mtel);
	};
	
	id('').onkeyup = function(){
		mascara(this, mtel);
	};		
};

$('#reset_link').click(function(event) {
    /* 11/07/2016 as 10:53 by Junior Oliveira
		Informação que foi enviado um link para o usuário
    */
  	$( "#dialog_link_reset" ).dialog({
    		
	    height: 280,
	    width: 450,
	    title: "Enviado link!",
	    modal: true
	    
	});	

 
});

		//VALIDAÇÃO E FORMATAÇÃO DO CPF
		//FONTE: GUI
		function validaCPF(cpf)   
		{  
		  erro = new String;  
		  console.log(cpf);
		    if (cpf.value.length == 11)  
		    {     
		            cpf.value = cpf.value.replace('.', '');  
		            cpf.value = cpf.value.replace('.', '');  
		            cpf.value = cpf.value.replace('-', '');  
		  
		            var nonNumbers = /\D/;  
		      
		            if (nonNumbers.test(cpf.value))   
		            {  
		                    erro = "A verificacao de CPF suporta apenas números!";   
		            }  
		            else  
		            {  
		                    if (cpf.value == "00000000000" ||   
		                            cpf.value == "11111111111" ||   
		                            cpf.value == "22222222222" ||   
		                            cpf.value == "33333333333" ||   
		                            cpf.value == "44444444444" ||   
		                            cpf.value == "55555555555" ||   
		                            cpf.value == "66666666666" ||   
		                            cpf.value == "77777777777" ||   
		                            cpf.value == "88888888888" ||   
		                            cpf.value == "99999999999") {  
		                              
		                            erro = "Número de CPF inválido!"  
		                    }  
		      
		                    var a = [];  
		                    var b = new Number;  
		                    var c = 11;  
		  
		                    for (i=0; i<11; i++){  
		                            a[i] = cpf.value.charAt(i);  
		                            if (i < 9) b += (a[i] * --c);  
		                    }  
		      
		                    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }  
		                    b = 0;  
		                    c = 11;  
		      
		                    for (y=0; y<10; y++) b += (a[y] * c--);   
		      
		                    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }  
		      
		                    if ((cpf.value.charAt(9) != a[9]) || (cpf.value.charAt(10) != a[10])) {  
		                        erro = "Número de CPF inválido.";  
		                    }  
		            }  
		    }  
		    else  
		    {  
		        if(cpf.value.length == 0)  
		            return false  
		        else  
		            erro = "Número de CPF inválido.";  
		    }  
		    if (erro.length > 0) {  
		            //alert(erro); 
		            chama_dialog_erro('O erro: ', erro, 'alert alert-danger');
		            
		            console.log($(this).attr('id')).focus();  
		            return false;  
		    }     
		    //return true; 
	    	//SE O RETORNO FOR VERDADEIRO O CAMPO FICARÁ MASCARADO CHAMANDO A FUNCAO FORMATACPF
		    formataCPF(cpf);  
		}  
  	
	//envento onkeyup  
	function maskCPF(CPF) {  
	    var evt = window.event;  
	    kcode=evt.keyCode;  
	    if (kcode == 8) return;  
	    if (CPF.value.length == 3) { CPF.value = CPF.value + '.'; }  
	    if (CPF.value.length == 7) { CPF.value = CPF.value + '.'; }  
	    if (CPF.value.length == 11) { CPF.value = CPF.value + '-'; }  
	}  
	  
	// evento onBlur  
	function formataCPF(CPF)  
	{  
	    with (CPF)  
	    {  
	        value = value.substr(0, 3) + '.' +   
	                value.substr(3, 3) + '.' +   
	                value.substr(6, 3) + '-' +  
	                value.substr(9, 2);  
	    }  
	}  
	function retiraFormatacao(CPF)  
	{  
	    with (CPF)  
	    {  
	        value = value.replace (".","");  
	        value = value.replace (".","");  
	        value = value.replace ("-","");  
	        value = value.replace ("/","");  
	    }  
	}

	//DIALOG JQUERY PARA ERRO
	function chama_dialog_erro(texto , erro, classe)
	{
		/*A DIV COM O DIALOG ESTA NO ARQUIVO admin_template*/
		//formatando o conteudo do dialog
		$("#dialog_text").addClass(classe);
		$( "#dialog_text" ).html(texto + erro);
		$( "#dialog" ).dialog({
	      modal: true,
	     
	    });
	}


	function conf_password() {
 		camp_password = $('#passwords').val();
 		camp_conf_pas = $('#confirmacao').val();
 		console.log("01: "+$('#passwords').val()+ " 02: "+$('#confirmacao').val());
		
		if( camp_password.length < 6 || camp_conf_pas.length < 6 ){
			alert("Senhas precisam ter no mínimo 6 digitos");
			return false;
		}
		if(camp_password != camp_conf_pas){
			alert("Senhas não confere");
			$('#passwords').focus();
			return false;

		}
	}

	function show_modal_load() {
		$("#loading").modal('show');
	}

function requestCEP(campo_cep , campos)
{
  $.ajax({
    url: "http://correiosapi.apphb.com/cep/"+$("#"+campo_cep).inputmask("unmaskedvalue"),
    dataType: 'jsonp',
    jsonp: 'callback',
    async: false,
    success: function(data){
      $("#"+campos[0]).val(data.tipoDeLogradouro + " " + data.logradouro);
      $("#"+campos[1]).val(data.bairro);
      $("#"+campos[2]).val(data.cidade);
      $("#"+campos[3]).val(data.estado);

    },
    statusCode: {
      200: function(data) { console.log(data); } // Ok
      ,400: function(msg) { console.log(msg);  } // Bad Request
      ,404: function(msg) { console.log("CEP não encontrado!!"); } // Not Found
    }
  });
}

$(function() {

});

/* FUNCAO GENERICA PARA EXCLUSAO */

    