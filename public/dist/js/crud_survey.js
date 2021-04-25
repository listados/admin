$(document).ready(function () {
    //ESCONDENDO A DIV

    $('#success_ambience').hide();
    $('#success_upload').hide();
    $('#dialog_load').hide();
    // $('#load_360').hide();
    $('#load_up_360').hide();
    $('#sucesso_360').hide();
    $('#load_upload_ambiente').hide();
    $('#sucesso_upload_ambiente').hide();
    $('#sucesso_upload_ambiente_360').hide();
    
    var rota = window.location.origin + project_survey;
       

});

$(function () {

   
    $("#chama_modal_360").click(function (event) {
        /* criado em 05/08/2016 as 12:20 por Junior Oliveira */
        $('#modal_360').modal('show');

    });


    //REPLICANDO VISTORIA [ 01/08/2016 AS 23:07]
    function replicar_vistoria(id) {
        var reply_id = id;
        status_reply = 'Rascunho';
        //chamando dialog de leitura
        
        $("#dialog_load").dialog({
            modal: true,
            resizable: false,
            height: "auto",
            width: 400,
            hide: "puff",
            show: "slide",

        });
        route_reply = window.location.origin + project_survey;

        dados_reply = {
            id_reply: reply_id,
            survey_status: status_reply
        };

        $.ajax({
                url: route_reply + 'vistoria/replicar/',
                type: 'POST',
                dataType: 'JSON',
                data: dados_reply,
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

    $('#new_survey').click(function (event) {
        //DIALOG DE ERRO
        $("#dialog_load").dialog({
            modal: true,
            resizable: false,
            height: "auto",
            width: 400,
            hide: "puff",
            show: "slide",
            dialogClass: 'no-close',
        });


    });

    //FUNCAO PARA REDIRECIONAR APOS O MODAL DE INFORMAÇÃO
    function redirect_route(route) {
        location.href = route;
    }


    $('#save_button').click(function (event) {

       
        $("#dialog_load").dialog({
            modal: true,
            resizable: false,
            height: "auto",
            width: 400,
            hide: "puff",
            show: "slide",
            dialogClass: 'no-close',
        });
        $("#survey_status").val('Rascunho');
        var rota = window.location.origin + project_survey;
        console.log("rota: "+rota);
        var formdata = $("#form_survey").serialize();

        $.ajax({
            url: rota + '/vistoria/update',
            type: 'POST',
            dataType: 'JSON',
            data: formdata,
            success: function (response) {
                $("#dialog_text_sucesso").text('Rascunho registrado com sucesso');
                $('#dialod_success_survey').dialog({
                    modal: true,
                    resizable: false,
                    height: "auto",
                    width: 400,
                    hide: "puff",
                    show: "slide",
                   // dialogClass: 'no-close'

                    buttons: {
                        "Ok": function () {
                            console.log('salvar: ' + rota);
                            redirect_route(rota+'/vistoria');
                        }
                    }
                });
            },
            error: function (data) {
                $.each(data, function (key, value) {
                    console.log(value[0]);
                });

            }
        });
    }); //fim save_button
    $('#completed_button').click(function (event) {

        $("#dialog_load").dialog({
            modal: true,
            resizable: false,
            height: "auto",
            width: 400,
            hide: "puff",
            show: "slide",
            dialogClass: 'no-close'

        });
        //INCLUINDO O STATUS NO CAMPO PARA SER ENVIADO
        $("#survey_status").val('Finalizada');
        var rota = window.location.origin + project_survey;
        var formdata = $("#form_survey").serialize();

        $.ajax({
            url: rota + '/vistoria/update',
            type: 'POST',
            dataType: 'JSON',
            data: formdata,
            success: function (response) {
                
                $('#dialog_success').dialog({
                    modal: true,
                    resizable: false,
                    height: "auto",
                    width: 400,
                    hide: "puff",
                    show: "slide",
                    // dialogClass: 'no-close',

                    buttons: {
                        "Ok": function () {
                            redirect_route(rota + '/vistoria');
                        }
                    }
                });
            },
            error: function (data) {
                $.each(data, function (key, value) {
                    console.log(value[0]);
                });

            }

        });

    }); //fim save_button


    $('#saveAmbiente').click(function (event) {
        /* Criada em 02/08 as 10:45 */
        $("#dialog_load").dialog({
            modal: true,
            resizable: false,
            height: "auto",
            width: 400,
            hide: "puff",
            show: "slide",

        });

        rota_ambiente = window.location.origin + project_survey;

        dados_ambiente = {

            ambience_name: $('#ambience_name').val()

        };

        $.ajax({
            url: rota_ambiente + '/vistoria/salvar-ambiente',
            type: 'POST',
            dataType: 'JSON',
            data: dados_ambiente,
            success: function (data) {
                getAmbience();
                $("#dialog_load").dialog('close');
                $('#sucess_ambiente').show();
                $('#ambience_name').val('');
                setTimeout(function () {
                    $('#sucess_ambiente').fadeOut('fast');
                }, 3000);
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


    });

    /* UPLOAD DAS FOTOS POR AMBIENTE
     */
    $("#send_file_upload").click(function (event) {
        /* criado em 02/08/2016 as 15:01 por Junior Oliveira */
        id_survey_upload = $("#id_survey_upload_photo").val();
        console.log("id vistoria="+id_survey_upload);
        var rota_send_file_upload = window.location.origin + project_survey + '/vistoria/upload';
        //VERIFICANDO SE FOR INFORMADO QL O AMBIENTE
        if ($("#ambience_upload").val() == "") {
            $("#info_ambience_upload").html('Esse campo é obrigatório');

        } else {

            $('#load_upload_ambiente').show();
            $("#info_ambience_upload").hide();
            $("#form_ambience_upload").ajaxForm({
                url: rota_send_file_upload,
                resetForm: true,
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    $('#info_upload_sucess').show();
                    $('#load_upload_ambiente').hide();
                    $('#sucesso_upload_ambiente').show();
                    setTimeout(function () {
                        $('#sucesso_upload_ambiente').fadeOut('fast');
                    }, 2000);
                   
                    getPhotoUpload(id_survey_upload);

                },
                error: function (data) {
                    $('#form_ambience_upload')[0].reset();
                    $('#load_upload_ambiente').hide();
                    $('#error_upload_ambiente').show();
                    setTimeout(function () {
                        $('#error_upload_ambiente').fadeOut('fast');
                    }, 3000);
                    
                }
            }).submit();
        }

    });



});
function getAmbience() {
    route = domain_complet+'/vistoria/todos-ambiente';
   console.log(route);
    $.get(route, function(data) {
        /*optional stuff to do after success */
        manageRow(data);
    });
};

function manageRow(data){
    var rows = '';

    $.each(data, function(index, val) {
             /* iterate through array or object */
        $('#table_data_ambience').find('tbody tr').remove();     
        rows = rows + '<tr>';
        rows = rows + '<td>'+val.ambience_name+'</td>';
   
        rows = rows + '<td data-id="'+val.ambience_id+'">';
                rows = rows + '<a href="#" onclick="delete_ambience('+val.ambience_id+')">Delete</a>';
                rows = rows + '</td>';
        rows = rows + '</tr>';

          $('#table_data_ambience > tbody:last').append(rows);
    });
}; 

/*TRAZENDO AS FOTOS DOS UPLOADS REALIZADO COM SUCESSO*/
function getPhotoUpload(id_survey) {
    route = domain_complet+'/vistoria/fotos-ambiente/'+id_survey;
  
    $.get(route, function(data) {
        /*optional stuff to do after success */
        manageRowUploadPhoto(data);
    });
};

function manageRowUploadPhoto(data){
    var rows = '';

    $.each(data, function(index, val) {
             /* iterate through array or object */
        $('#table_data_photo_upload_success').find('tbody tr').remove();     
        rows = rows + '<tr>';
        rows = rows + '<td>'+val.files_ambience_description_file+'</td>';
   
        rows = rows + '<td data-id="'+val.files_ambience_id+'">';
                rows = rows + '<img src="'+domain_complet+'/dist/img/upload/vistoria/'+val.files_ambience_description_file+'" alt="..." width="64" height="64">';
                rows = rows + '</td>';
        rows = rows + '</tr>';

          $('#table_data_photo_upload_success > tbody:last').append(rows);
    });
};


function delete_ambience(id) {
    // body...
    
    $("#dialog_load").dialog({
            modal: true,
            resizable: false,
            height: "auto",
            width: 400,
            hide: "puff",
            show: "slide",

        });
    route_delete = domain_complet+'/vistoria/excluir-ambiente/'+id;

    var id_amb = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");

    $.ajax({
        url: route_delete,
        type: 'GET',
        dataType: 'JSON',
        data: {ambience_id: id},
        success: function (data) {
                //getAmbience();
                c_obj.remove();
                $("#dialog_load").dialog('close');
                $('#delete_ambiente_success').show();
                $('#ambience_name').val('');
                setTimeout(function () {
                    $('#delete_ambiente_success').fadeOut('fast');
                }, 3000);
            }
    })
    .done(function() {
        console.log("success");
        getAmbience();
    })
    
};

