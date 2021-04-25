function modal_delete_ajax(id, route, input_name, text_info, redirect)
{

    $("#modal_title_delete").html('Excluir');
    $("#txt_info").html(text_info);
  
    $("#delete_id").attr({
        name: input_name,
        value: id

    });
    $("#modal_delete_key").modal('show');
    $("#btn_delete_ajax").click( function(){
        alert('excluir');
       $.ajax({
        url: domain_complet + '/'+route+'/'+id,
        type: 'DELETE',
        dataType: 'json',
        data: $('#form_delete_ajax').serializeJSON(),
        success: function(){
            new PNotify({
                title: 'Sucesso',
                text: 'Registro excluído com sucesso',
                styling: 'fontawesome',       
                type: 'success',
                icon: 'true',
                animation: 'fade',
                delay: 5000,
                animate_speed: "slow"
            });
            $("#modal_delete_ajax").modal('hide');
            window.location.href = domain_complet + redirect;
        }
    });

   });
    

}

/*PARA MASCARAR OS TELEFONES PARA 9 DIGITOS*/
/* Máscaras ER*/
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
    
    id('').onkeyup = function(){
        mascara(this, mtel);
    };      
};

/*  FUNÇÃO GERALMENTE USADA NO MODAL DE CONFIMAÇÃO APOS UMA AÇÃO  */
function redirect(route)
{
    window.location.href = domain_complet + '/' + route;
}

function reloadTable(name_table)
{
$("#"+name_table).DataTable().ajax.reload();
}

