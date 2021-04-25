
$(document).ready(function () {
/*
Link exemplo : http://makitweb.com/dynamically-add-and-remove-element-with-jquery/
@autor: Excellence Soft - Junior Oliveira
Para locador nome do campo é: locator
Para Locatário nome do campo é: occupant
Para Fiador o nome do campo é: guarantor

 */
  // Removendo elemento
  $('.container').on('click', '.remove', function () {
      var id = this.id;
      var split_id = id.split("_");
      var deleteindex = split_id[1];
      // Remove <div> with id
      $("#div_" + deleteindex).remove();
  });

  $('.containerLocatario').on('click', '.removeLocatario', function () {
      var id = this.id;
      var split_id = id.split("_");
      var deleteindex = split_id[1];
      // Remove <div> with id
      $("#divLocatario_" + deleteindex).remove();
  });  
  $('.containerFiador').on('click', '.removeFiador', function () {
      var id = this.id;
      var split_id = id.split("_");
      var deleteindex = split_id[1];
      // Remove <div> with id
      $("#divFiador_" + deleteindex).remove();
  });
});

  /* ========= FIM LOCADOR ===========*/
  //PARA LOCATARIO : elementLocatario
  //divLocatario
  //removeLocatario
function addUserSurvey(nameElement, nameDiv, nameContainer, nameRemove , nameField)
{
      var placeholder = "";
      if(nameField == 'locator')
      {
        placeholder = 'Locador';
      }else if(nameField == 'occupant')
      {
        placeholder = 'Locatário';
      }else if(nameField == 'guarantor')
      {
        placeholder = 'Fiador';
      } 
        
       // Finding total number of elements added
      var total_element = $("."+nameElement).length;

      // last <div> with element class id
      var lastid = $("."+nameElement+":last").attr("id");
      var split_id = lastid.split("_");
      var nextindex = Number(split_id[1]) + 1;

      var max = 5;
      // Check total number elements
      if (total_element < max) {
          // Adding new div container after last occurance of element class
          $("."+nameElement+":last").after("<div class='"+nameElement+" row'  id='"+nameDiv+"_" + nextindex + "'></div>");

          // Adding element to <div>
          $("#"+nameDiv+"_" + nextindex).append('<div class="col-md-5">\
          <label>Nome <span class="text-success">+</span></label>\
          <input type="hidden" id="id_user[]">\
          <input type="text" name="survey_'+nameField+'_name[]" id="txt_' + nextindex + '"  value="" placeholder="Nome do '+placeholder+'" class="form-control"></div>\
          <div class="col-md-2"><label>CPF ou CNPJ <span class="text-success">+</span></label>\
          <input type="text" name="survey_'+nameField+'_cpf[]"   value="" placeholder="CPF ou CNPJ do '+placeholder+'" class="form-control" id="cpf_locador"></div>\
      </div>\
      <div class="form-group col-md-4">\
  <label>E-mail <span class="text-success">+</span></label>\
    <div class="input-group">\
        <input type="text" class="form-control" name="survey_'+nameField+'_email[]" placeholder="Email do '+placeholder+'">\
        <span  class="input-group-btn">\
            <a href="#" class="btn btn-primary '+nameRemove+' " title="Remover este locador" id="remove_' + nextindex + '">\
          <i class="fa fa-minus-circle"></i></a>\
        </span>\
    </div>\
  </div>');

}
  }//FIM ADDUSERSERVEY