$(function() {
  $('[data-toggle="tooltip"]').tooltip();
  $('.js-select-combo').comboSelect();
  //$("#reserveKey").modal('show');  
 // $("#modal_edit_key").modal('show');  
  $("#type_manutencao").hide();
  $("#alert_info_delete").hide();
   //VARIÁVEL GLOBAL PARA USAR NO MODAL DE AVALIAÇÃO DE VISITA
   $("#confirmvisited").hide();
  //MUSA O BOTÃO DE ACORDO COM A ESCOLHA SE É VISITA   
  $("#control_keys_finality").change(function(){

    if($("#control_keys_finality").val() == 'visita')
    {
          // $("#reserveKeySave").html("");
          // $("#reserveKeySave").append('<i class="fa fa-print"> </i> Salvar Visita');
          $("#confirmvisited").show();//CONFIRMAR VISITA
          $("#confirmreserved").hide();//CONFIRMAR RESERVA

        }else{
          $("#confirmreserved").show();//CONFIRMAR VISITA
          $("#confirmvisited").hide();//CONFIRMAR RESERVA
          // $("#reserveKeySave").html("");
          // $("#reserveKeySave").append('<i class="fa fa-key"> </i> Reservar Chaves');
        }
        if( $("#control_keys_finality").val() == 'manutencao' )
        {
          $('#type_manutencao').show();
        }else{
          $('#type_manutencao').hide();
        }
      });
});

$(document).ready(function() {
  moment.locale('pt-BR');

  $("#hide_value_delivery").hide();
  $("#erro_fields").hide();
  //LOAD NO MODAL DA RESERVA QUANDO PESQUISA O CLIENTE
  $("#load_find_client").hide();

  $("#value_delivery").change( function() {
    /* Act on the event */
    
    if($(this).find(":selected").val() != 1)
    {
      $("#hide_value_delivery").show();

    }else{

      $("#hide_value_delivery").hide();
    }
  });

  $("#control_keys_cpf").inputmask("999.999.999-99"); 
  $("#control_keys_cpf").inputmask("999.999.999-99"); 
  //$("#reserve_keys_date_devolution").inputmask("99/99/9999 99:99"); 
  var cod_immobiles = $("#code_immobiles_reserve").val();
  modalReserveKey(cod_immobiles , 'VISITA');

});
function dataFormatada(d) {
  var data = new Date(d),
  dia = data.getDate(),
  mes = data.getMonth() + 1,
  ano = data.getFullYear(),
  hora = data.getHours(),
  minutos = data.getMinutes(),
  segundos = data.getSeconds();
  return [dia, mes, ano].join('/') + ' ' + [hora, minutos, segundos].join(':');
}

//RECEBER AS CHAVES - DEVOLUÇÃO
function modal_edit_key(id) {

  // $.get(domain_complet + '/reserva/' + id + '/show', function(data) {

  //   if(data == ""){
  //     $("#save_confirmed_key").hide();
  //   }else{
  //     $("#save_confirmed_key").show(); 
  //   }

  //   //$("#result").html(data[0]['control_keys_type_immobile']);
  //   $("#title_devolution").html('Devolução de chaves para o imóvel ' + data[0]['reserves_ref_immobile'] + ' - COD. CHAVE: ' + data[0]['reserves_code_key']);
  //   $("#ref_imovel").html(data[0]['reserves_ref_immobile']);
  //   $("#cod_key").html(data[0]['reserves_code_key']);
  //   $("#key_status").html(data[0]['keys_status']);
  //   $("#retired_by").html(data[0]['nick']);
  //   $("#date_retired").html(moment(data[0]['reserves_date_exit']).startOf('day').fromNow());
  //   $("#date_devolution").html(moment(data[0]['reserves_date_devolution']).format('DD/MMM/YYYY h:mm:ss'));
  //   $("#control_keys_id").val(data[0]['reserves_id_key']);
  //   $("#keys_type_info").html(data[0]['reserve_finality']);
  //   $("#id_key").val(data[0]['keys_id']);
  // });
  $('#id_key').val(id);
  $('#modal_edit_key').modal('show');
}

function resetFileldsInfo()
{
  $("#result").html('');
  $("#title_devolution").html('Não tem informação de devolução');
  $("#ref_imovel").html('');
  $("#cod_key").html('');
  $("#key_status").html('');
  $("#retired_by").html('');
  $("#date_retired").html('');
  $("#date_devolution").html('');
  $("#control_keys_id").val('');
  $("#keys_type_info").html('');
}
//APAGAR CHAVE
function modal_delete_key(id)
{

  $("#modal_title_delete").html('Excluir Chave');
  $("#txt_info").html('Deseja realmente fazer essa exclusão?');
  $("#p_info_delete").html('Exclusão');

  $("#delete_id").attr({
    name: "keys_id",
    value: id
  });

  $("#modal_delete_key").modal('show');

  $("#btn_delete_key").click( function(){
   $.ajax({
    url: domain_complet + '/key/'+id,
    type: 'DELETE',
    dataType: 'json',
    data: $('#form_delete_ajax').serializeJSON(),
    success: function(){
      new PNotify({
        title: 'Sucesso',
        text: 'Chave excluída com sucesso',
        styling: 'fontawesome',       
        type: 'success',
        icon: 'true',
        animation: 'fade',
        delay: 5000,
        animate_speed: "slow"
      });
      $("#modal_delete_key").modal('hide');
      reloadTable('key_control')
    }
  });

 });

}

function reloadTable(name_table)
{
  $("#"+name_table).DataTable().ajax.reload();
}

function modalReserveKey(code_immobile , type)
{
  //$("#reserveKey").modal('show');
  $("#keys_type").val(type);
  if(type ==  'manutencao')
  {
   $("#type_manutencao").show();
  }
  $.get(domain_complet + '/key/get/'+code_immobile, function(data) {
    /*optional stuff to do after success */
    $("#control_keys_ref_immobile").val(data[0].keys_cod_immobile);
    $("#confirm_reserves_id").val(data[0].keys_cod_immobile);    
    $.each(data, function(index, keys) {
      /* iterate through array or object */
      if (keys.keys_status == "Disponível" || keys.keys_status == "Reservado") 
      {
        $("#selectCodeKey").append('<option  value="'+keys.keys_code+'">'+keys.keys_code+'</option>');
      }
    });
  });
}

// $("#selectCodeKey").change(function(event) {
//   $("#confirmvisited input").remove();
//   $("#confirmvisited").append('<input type="text" name="inputvisit" id="inputvisit"  value="'+$("#selectCodeKey").val()+'">');W
//  });
//REMOVANDO OPÇÃO DAS CHAVES
function closeModalReserve()
{
  $("#selectCodeKey option").remove();
  $("#type_manutencao").hide();
}

$("#printreserveKeySave").click(function(event) {

});

// CREATE IN 2017-07-28 BY EXCELLENCE SOFT   
$(document).ready(function() {
    //MASCARANDO OS CAMPOS
    $("#delivery_value").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#control_keys_value_guarantee").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

    $("#closeModalReserve").click(function(){

    });




    PNotify.prototype.options.styling = "fontawesome";
    

}); 

$("#save_confirmed_key").click(function(event) {
  /* Act on the event */

  $.ajax({
    url: domain_complet + '/key/'+$("#id_key").val(),
    type: 'PUT',
    dataType: 'json',
    data: {keys_status: 'Disponível' , keys_devolution: 1},
    success: function(data){
      new PNotify({
        title: data.title,
        text: data.text,
        styling: data.styling,       
        type: data.type,
        icon: data.icon,
        animation: data.animation,
        delay: data.delay,
        animate_speed: data.animate_speed
      });
      //PREENCHENDO O VALOR DO COD OD IMOVEL NO CAMPO DO NODAL, PARA SER REGISTRADO A AVALIAÇÃO
      $("#evaluations_id_reserve").attr('value', data.reserves_id);
      $("#confirm_receipt").modal('show');
      $("#id_key_confirm").val($("#id_key").val());
      reloadTable('key_control');

    }


  }) .fail(function() {
    new PNotify({
      title: 'Erro',
      text: 'Ocorreu um erro, tente novamente',
      styling: 'bootstrap3',       
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
  })

});

// 


$("#keys_code_immobile").blur(function(event) {
  code_key = $("#keys_code_immobile").val();
  $.get(domain_complet + '/key/show/'+code_key, function(data) {
    new PNotify({
      title: data.title,
      text: data.text,
      styling: data.styling,       
      type: data.type,
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });  
    if(data.type == 'error')
    {
     $("#keys_code_immobile").focus(); 
   }
   return false;

 });   /* Act on the event */
});

$("#save_key").click(function(event) {
  /* create 2017-08-04 by excellence soft */
  if($("#keys_code_immobile").val() == "")
  {
    new PNotify({
      title: 'Ops!',
      text: 'O Campo do código da Chave é obrigatório',
      styling: 'bootstrap3',       
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
    return false;
  }

  $.ajax({
    url:  domain_complet + '/key/store',
    type: 'POST',
    dataType: 'json',
    data: $('#form_save_key').serializeJSON(),
    success:function(){
      new PNotify({
        title: 'Sucesso',
        text: 'Chave Cadastrada com sucesso',
        styling: 'bootstrap3',       
        type: 'success',
        icon: 'true',
        animation: 'fade',
        delay: 5000,
        animate_speed: "slow"
      });
      $("#form_save_key")[0].reset();
      reloadTable('key_control');
    }
  })
  .done(function() {
    //console.log("success");
  })
  .fail(function() {
    new PNotify({
      title: 'Erro',
      text: 'Ocorreu um erro, tente novamente',
      styling: 'bootstrap3',       
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
  })
  .always(function() {
    //console.log("complete");
  });

});

$("#immobiles_cep").blur(function(){
  $("#immobiles_number").focus();
});

function loadTableKey()
{
 $('#key_control').DataTable({
  processing: true,
  serverSide: true,

  ajax: domain_complet + '/chaves/show',
  columns: [{
    data: 'keys_code',
    name: 'keys_code'
  },
  {
    data: 'keys_cod_immobile',
    name: 'keys_cod_immobile'
  },
  {
    data: 'keys_status',
    name: 'keys_status'
  },

  {
    data: 'action',
    name: 'action',
    orderable: false,
    searchable: false
  }

  ],
  "language": {
    "lengthMenu": "Exibir _MENU_ chaves por página",
    "emptyTable": "Não existe nenhum tour criado",
    "infoEmpty": "Mostrando 0 Registros",
    "info": "Mostrando _PAGE_ páginas de _PAGES_",
    "searchPlaceholder": "Digite sua pesquisa",
    "search": "Pesquisar: ",
    "show": "Mostrar",
    "paginate": {
      "previous": "Anterior",
      "next": "Próxima",
      "last": "Última",
      "first": "Primeira",
      "loadingRecords": "Aguarde - lendo dados..."
    }
  },
  "iDisplayLength": 50,
  "search": {
   "caseInsensitive": false
 }
});
}
var dateRangePickerSettings = {
  locale: {
    "format": "d/m/Y",
    "separator": " - ",
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar",
    "fromLabel": "De",
    "toLabel": "Para",
    "customRangeLabel": "Custom",
    "weekLabel": "W",
    "daysOfWeek": [
    "Do",
    "Se",
    "Te",
    "Qu",
    "Qu",
    "Se",
    "Sa"
    ],
    "monthNames": [
    "Janeiro",
    "Fevereiro",
    "Março",
    "Abril",
    "Maio",
    "Junho",
    "Julho",
    "Agosto",
    "Setembro",
    "Outubro",
    "Novembro",
    "dezembro"
    ],
    "firstDay": 1
  },
};

$(function() {

  $("#reserve_keys_date_devolution").datetimepicker({ 
    minDate: 0, 
    maxDate: "+1M +10D"
  });
});

function validFields()
{
    //VERIFICAÇÃO PARA OS CAMPOS DO MODAL DE RESERVA DE CHAVES
    if($("#selectCodeKey").val() === "")
    {
      new PNotify({
        title: 'Ops! Ocorreu um erro',
        text: 'Por favor, preencher o código da Chave',
        styling: 'bootstrap3',       
        type: 'error',
        icon: 'true',
        animation: 'fade',
        delay: 5000,
        animate_speed: "slow"
      });
      return false;
    }

    if($("#keys_visitor_phone_two").val() === "")
    {
     new PNotify({
      title: 'Ops! Ocorreu um erro',
      text: 'Por favor, preencher o número do telefone celular',
      styling: 'bootstrap3',       
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
     return false;
   }

   if($("#reserve_keys_date_devolution").val() === "")
   {
     new PNotify({
      title: 'Ops! Ocorreu um erro',
      text: 'Por favor, preencher a data de devolução',
      styling: 'bootstrap3',       
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
     return false;
   }


   if($("#control_keys_visitor_name").val() === "")
   {
     new PNotify({
      title: 'Ops! Ocorreu um erro',
      text: 'Por favor, preencher o nome do cliente',
      styling: 'bootstrap3',       
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
     return false;
   }   

   if($("#control_keys_clients_address").val() === "")
   {
     new PNotify({
      title: 'Ops! Ocorreu um erro',
      text: 'Por favor, preenchero o endereço do cliente',
      styling: 'bootstrap3',       
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
     return false;
   }

   return true;

 }

//VERIFICA SE JA EXISTE UMA PESSOA COM ESSE FONE CADASTRADO
function verifyclient(){
  if($("#keys_visitor_phone_two").val().length >= 14)
  {
  //LOAD NO MODAL DA RESERVA QUANDO PESQUISA O CLIENTE
  $("#load_find_client").show();
  // console.log(domain_complet+'/verify-phone-client');
  // console.log($("#keys_visitor_phone_two").val());
    $.ajax({
      url: domain_complet+'/verify-phone-client',
      type: 'POST',
      dataType: 'JSON',
      data: {keys_visitor_phone_two: $("#keys_visitor_phone_two").val()},
      success: function(data){
      $("#load_find_client").hide();
        //SE O OBJETO NÃO FOR VAZIO
        console.log(data);
        if(jQuery.isEmptyObject(data) == false)
        {
          //LIBERANDO OS CAMPOS PARA EDIÇÃO SE PRECISAR
          $("#control_keys_cpf").removeAttr( "disabled" );
          $("#control_keys_visitor_name").removeAttr( "disabled" );
          $("#clients_email").removeAttr( "disabled" );
          $("#keys_visitor_phone_one").removeAttr( "disabled" );

          $("#control_keys_cpf").val(data.client_cpf);
          $("#control_keys_visitor_name").val(data.client_name);
          $("#clients_email").val(data.client_email);
          $("#keys_visitor_phone_one").val(data.phone_fixed);
          $("#clients_cep").val(data.clients_cep);
          $("#clients_address").val(data.clients_address);
          $("#clients_address_number").val(data.clients_address_number);
          $("#clients_address_complement").val(data.clients_address_complement);
          $("#clients_district").val(data.clients_district);
          $("#clients_city").val(data.clients_city);
          $("#clients_state").val(data.clients_state);

        }else{
        $("#control_keys_cpf").removeAttr( "disabled" );
        $("#control_keys_visitor_name").removeAttr( "disabled" );
        $("#clients_email").removeAttr( "disabled" );
        $("#keys_visitor_phone_one").removeAttr( "disabled" );
        }
      }
    });

  }else if($("#keys_visitor_phone_two").val().length < 14){
    $("#load_find_client").removeClass('text-primary');
    $("#load_find_client").addClass('text-danger');
    $("#info_load_find_client").html('Número telefônico incompleto');
    //$("#load_find_client").show();
  }else{
    $("#load_find_client").load();
  }

}


$("#reserveKeySave").click(function(){

  saveReserve();

});   

function saveReserve()
{
 valida = validFields();

 if(valida === true)
 {
  var form = $('#formReserveKey').serializeJSON();
  //console.log(form);
  $.ajax({
    url: domain_complet + '/create-reserve',
    type: 'POST',
    dataType: 'JSON',
    data: $('#formReserveKey').serializeJSON(),
    success: function(data)
    {
      //console.log(data);
      //reloadTable('key_control');

      if (data.reserve_finality == 'reserva') {
        new PNotify({
          title: 'Sucesso',
          text: 'Chave reservada com sucesso',
          styling: 'bootstrap3',       
          type: 'success',
          icon: 'true',
          animation: 'fade',
          delay: 5000,
          animate_speed: "slow"
        });
        window.open(domain_complet+'/chaves/receipt?reserves_id='+data.reserves_id+'&key=on&auto=on&delivery=on');
      }        
      
      if (data.reserve_finality == 'visita') {
        new PNotify({
          title: 'Sucesso',
          text: 'Chave reservada com sucesso',
          styling: 'bootstrap3',       
          type: 'success',
          icon: 'true',
          animation: 'fade',
          delay: 5000,
          animate_speed: "slow"
        });
        $("#reserveKey").modal('hide');
        $("#confirm_reserves_id").val(data.reserves_id);
        $("#confSaveKey").modal('show');
      }
    }
  });
}

} 

window.onload = function(){

  // id('keys_visitor_phone_two').onkeyup = function(){
  //   mascara(this, mtel);
  // };
}

$("#save_receipt_key").click(function(){
 $.ajax({
   url: domain_complet + '/reserva/'+$("#evaluations_id_reserve").val(),
   type: 'PUT',
   dataType: 'JSON',
   data: $('#form_confirm_receipt_key').serializeJSON(),
   success: function(data){
    new PNotify({
      title: 'Sucesso',
      text: 'Avaliação concluída com sucesso',
      styling: 'bootstrap3',       
      type: 'success',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
    $("#confirm_receipt").modal('hide');
    $("#modal_edit_key").modal('hide');
    reloadTable('key_control');

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

});

$("#immobiles_cep").inputmask("99.999-999", {"placeholder": "99.999-999"});

$("#search_key_immobile").click(function(){
 // $("#code_key_immobile").attr('disabled' , 'true');
 val = $('#code_key_immobile').val();
  //APAGANDO QUALQUER REQUISIÇÃO
  $('#history_key_immobile').DataTable().destroy();
  $('#history_key_immobile').DataTable({
    processing: true,
      //serverSide: true,
      ajax: {
        url: domain_complet + '/key/search',
        type: 'POST',
        dataType: 'json',
        data: {code_key_immobile: val}
      },
      columns: [
      {data: 'reserves_code_key', name: 'reserves_code_key'},
      {data: 'reserves_ref_immobile', name: 'reserves_ref_immobile'},
      {data: 'reserves_date_exit', name: 'reserves_date_exit'},
      {data: 'reserves_date_devolution', name: 'reserves_date_devolution'},
      {data: 'reserves_id_client' , name: 'reserves_id_client'},
      {data: 'reserves_status' , name: 'reserves_status'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
      ],
      "searching": false,
      "language": {
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "show": "Mostrar",
      },
      "iDisplayLength": 50,
      "pagingType": "full_numbers",
      "search": {
       "caseInsensitive": false
     }
   });        
});

//CHAMANDO O MODAL DE CONFIRMAÇÃO
function modal_confirm_reserve(id, code)
{
  $("#confirm_reserves_id").val(id);
  $("#confSaveKey").modal('show');
}
function modal_update_key(id, code_key)
{
  $("#info_update_code_key").html('Código atual é: <small class="label label-info">'+code_key+'</smal>');
  $("#update_keys_code").val(id);
  $("#update_code_key").modal('show');
}

$("#save_update_code_key").click(function(data){

  $.ajax({
    url: domain_complet + '/update-code-key',
    type: 'POST',
    dataType: 'JSON',
    data:  $('#form_update_code_key').serializeJSON(),
    success: function(data){
      new PNotify({
        title: 'Sucesso',
        text: 'Código alterado com sucesso',
        styling: 'fontawesome',       
        type: 'success',
        icon: 'fa fa-check',
        animation: 'fade',
        delay: 5000,
        animate_speed: "slow"
      });
      reloadTable('key_control');
      $("#update_code_key").modal('hide');
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
  
});


