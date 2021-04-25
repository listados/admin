    $('#delivery-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: domain_complet + '/delivery/all',
        columns: [
        {data: 'deliveries_id', name: 'deliveries_id'},
        {data: 'deliveries_name', name: 'deliveries_name'},
        {data: 'deliveries_phone', name: 'deliveries_phone'},
        {data: 'deliveries_mobile', name: 'deliveries_mobile'},
        {data: 'deliveries_cpf', name: 'deliveries_cpf'},
        {data: 'action', name: 'action', orderable: false, searchable: false}

        ]
    });   
    
    $(document).ready(function() {
      $('#deliveries_cpf').inputmask({"mask": "999.999.999-99"});
      $('#deliveries_cpf_up').inputmask({"mask": "999.999.999-99"});

      
  });  
    $("#save_delivery").click(function(){
        form_delivery = $("#form_delivery").serializeJSON();
        $.ajax({
            url: domain_complet + '/delivery',
            type: 'POST',
            dataType: 'JSON',
            data: form_delivery,
            success: function (response) {
             new PNotify({
                title: 'Sucesso',
                text: 'Delivery Cadastrado',
                styling: 'fontawesome',       
                type: 'success',
                icon: 'true',
                animation: 'fade',
                delay: 5000,
                animate_speed: "slow"
            });
             $("#form_delivery").find("input[type=text], textarea").val("");
             $("#add_delivery").modal('hide');
             reloadTable('delivery-table');
         }
     });
    })

    function edit_delivery(id){

        $("#deliveries_id").val(id);
        getDelivery(id);
        $("#modal_edit_delivery").modal('show');
    }

    function getDelivery(id){
        var rows = '';
        $.get(domain_complet+'/delivery/'+id+'/edit', function(data) {

            rows = rows +'<div class="col-xs-12 col-md-12">'
            +'<label>Nome</label>'
            +'<input type="text" class="form-control" name="deliveries_name" id="deliveries_name" value="'+data.deliveries_name+'">'
            +'</div>';
            rows = rows +'<div class="col-xs-4 col-md-4">'
            +'<label>Fone</label>'
            +'<input type="text" class="form-control" name="deliveries_phone" id="deliveries_phone" maxlength="15" onkeyup="mascara( this, mtel )" value="'+data.deliveries_phone+'">'
            +'</div>';               
            rows = rows +'<div class="col-xs-4 col-md-4">'
            +'<label>Celular</label>'
            +'<input type="text" class="form-control" name="deliveries_mobile" id="deliveries_mobile" maxlength="15" onkeyup="mascara( this, mtel )"  value="'+data.deliveries_mobile+'">'
            +'</div>';                
            rows = rows +'<div class="col-xs-4 col-md-4">'
            +'<label>CPF</label>'
            +'<input type="text" class="form-control" name="deliveries_cpf" id="deliveries_cpf_up" value="'+data.deliveries_cpf+'">'
            +'</div>';

            $("#body").html(rows);
        });
    }

    $("#btn_edit_delivery").click(function(){
        $.ajax({
            url: domain_complet+'/delivery/'+$("#deliveries_id").val(),
            type: 'PUT',
            dataType: 'json',
            data: $("#form_edit_delivery").serializeJSON(),
            success: function(){
                new PNotify({
                    title: 'Sucesso',
                    text: 'Delivery alterado com sucesso',
                    styling: 'fontawesome',       
                    type: 'success',
                    icon: 'true',
                    animation: 'fade',
                    delay: 5000,
                    animate_speed: "slow"
                });
                reloadTable('delivery-table');
                $("#modal_edit_delivery").modal('hide');
            }
        })
        .fail(function() {
            new PNotify({
                title: 'Erro',
                text: 'Ocorreu um erro',
                styling: 'fontawesome',       
                type: 'error',
                icon: 'fa fa-exclamation-triangle',
                animation: 'fade',
                delay: 5000,
                animate_speed: "slow"
            });
        })
        .always(function() {
            console.log("complete");
        });
        
    });