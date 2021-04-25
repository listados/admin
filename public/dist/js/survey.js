$(document).ready(function() {
   
    $("#editor_aspect").ckeditor();
    $("#editor_reservation").ckeditor();
    $("#editor_keys").ckeditor();
    $("#editor_provisions").ckeditor();
});

    $('#table-ambience-survey').DataTable({
        processing: true,
        serverSide: true,
        ajax: domain_complet+'/vistoria/show/'+$("#id_survey_ambience").val(),
        columns: [        
            {data: 'ambience_name', name: 'ambience_name'},
            {data: 'files_ambience_description_file', name: 'files_ambience_description_file'},
            {data: 'alter', name: 'alter', orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false}
        ]
    });


$("#sendDeleteAmbience").click(function(event) {
    /* Act on the event */
    var arr = [];
    $("input:checkbox[name=surveyDelete]:checked").each(function() {
        arr.push($(this).val());
        
    });        

    $.ajax({
        url: domain_complet + '/vistoria/delete-files',
        type: 'DELETE',
        dataType: 'json',
        data: {'surveyDelete' : arr},
        success: function(data)
        {
            $("#table-ambience-survey").DataTable().ajax.reload();
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

//RECEBENDO O ID DO AMBIENTE AO SER SELECIONADO A OPÇÃO PARA SER ENVIADO NA REQUISIÇÃO
ambience_id    = [];
$("#files_ambience_id_ambience").change(function(){
    ambience_id = $("#files_ambience_id_ambience").val();        
});

$("#sendAlterAmbience").click(function(event){
    
    var arr            = [];
    $("input:checkbox[name=surveyAlter]:checked").each(function() {
        arr.push($(this).val());        
    }); 

    $.ajax({
        url: domain_complet+'/vistoria/alterar-ambiente',
        type: 'PUT',
        dataType: 'JSON',
        data: { 'ambience_id' : ambience_id, 'files_ambience_id': arr},
        success: function(data)
        {
            $("#table-ambience-survey").DataTable().ajax.reload();
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
