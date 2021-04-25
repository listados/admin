function deleteImageAmbience(id) {
    var result = confirm("Deseja excluir essa imagem?");
    if (result) {
        $.ajax({
            url: domain_complet+'/vistoria/imagem-ambiente',
            type: 'POST',
            dataType: 'json',
            data: {files_ambience_id: id},
            success: function(){
                location.reload();
             
              
            }
        }).done(function() {
            new PNotify({
                title: 'Sucesso',
                text: 'Ambiente excluido',
                styling: 'fontawesome',       
                type: 'success',
                icon: 'true',
                animation: 'fade',
                delay: 5000,
                animate_speed: "slow"
            });
        })
        
        .fail(function() {
           new PNotify({
                title: 'Erro',
                text: 'Ocorreu um erro',
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
    }else{
        alert('nao confirmou');
    }

            
}
     
$(document).ready(function() {
         
       
        var activeSystemClass = $('.list-group-item.active');
    
    //something is entered in search form
    $('#system-search').keyup( function() {
     var that = this;
        // affect all table rows on in systems table
        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {
    
            //Lower text for case insensitive
            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Pesquisando por: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }
    
            if( rowText.indexOf( inputText ) == -1 )
            {
                //hide rows
                tableRowsClass.eq(i).hide();
                
            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });
        //all tr elements are hidden
        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">Não encontrado registro.</td></tr>');
        }
    });
});