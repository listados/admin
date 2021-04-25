function mascaraValor(valor) {
    valor = valor.toString().replace(/\D/g, "");
    valor = valor.toString().replace(/(\d)(\d{8})$/, "$1.$2");
    valor = valor.toString().replace(/(\d)(\d{5})$/, "$1.$2");
    valor = valor.toString().replace(/(\d)(\d{2})$/, "$1,$2");
    return valor
}


$(function () {


    $("#table_immobile_filter").find('input').attr("id", 'search_immobile');
    //CONFIGURAÇÃO DO LIGHTBOX2
    lightbox.option({
        'alwaysShowNavOnTouchDevices': true,
        'wrapAround': true,
        'albumLabel': "Imagem %1 de %2"
    });

});
$("#immobiles_cep").inputmask("99.999-999", {
    "placeholder": "99.999-999"
});

function alterStatusImmobile(id_immobile) {

    $.get(domain_complet + '/imovel/' + id_immobile + '/edit', function (data) {
        /*optional stuff to do after success */
        $("#p_status_immobile").html("Status atual: <strong>" + data[0].immobiles_status + "</strong>");
    });
    $('#modal_alter_status_immobile').modal('show');
}

function excluirImovel(id) {
    alert('Excluri: ' + id);
}

$.get(domain_complet + '/imovel/show', function (data) {
    $('#total_active').html('Total de Registro: ' + data.recordsTotal);

});

function getImmobile(immobiles_code) {
    $('#modal_details_immobiles').modal({
        show: true,
        keyboard: false,
        backdrop: 'static'
    });

    $('#modal_details_immobiles').modal('show');
    var immobile_code = immobiles_code;
    $.get(domain_complet + '/imovel-mostra/' + immobiles_code, function (data) {
        /*optional stuff to do after success */
        imovel = data[0];

        $("#titleImobile").html(imovel.immobiles_property_title + ' - ' + immobiles_code);
        $("#addressImmobile").html(imovel.immobiles_address + ', ' + imovel.immobiles_number + ', ' + imovel.immobiles_complement + ', ' +
            imovel.immobiles_district + ', ' + imovel.immobiles_city + ' CEP: ' + imovel.immobiles_cep);
        $("#locationImmobile").attr('href', 'https://maps.google.com/maps?q=' + data[0].immobiles_latitude + ',' + data[0].immobiles_longitude);
        $("#linkImmobile").attr("href", "http://www.alugaemfortaleza.com/imovel-detalhes.aspx?ref=" + imovel.immobiles_code);
        $("#linkImmobile").html('http://www.alugaemfortaleza.com/imovel-detalhes.aspx?ref=' + imovel.immobiles_code);
        $("#areaImmobile").html(imovel.immobiles_useful_area + ' área útil');
        //$("#salePriceImmobile").html('Preço Venda R$: ' + mascaraValor(imovel.immobiles_selling_price.toFixed(2)));
        $("#rentalImmobile").html('Locação R$: ' + mascaraValor(imovel.immobiles_rental_price));
        $("#iptuImmobile").html('IPTU R$: ' + mascaraValor(imovel.immobiles_iptu_price));
        condo = imovel.immobiles_condominium_price;
        $("#condomiumImmobile").html('Cond. R$: ' + mascaraValor(condo));
        totalPacote = (imovel.immobiles_rental_price + imovel.immobiles_iptu_price + imovel.immobiles_condominium_price);
        //$("#packImmobile").html('Pacote: ' + totalPacote);
        $("#descriptionImmobile").html(imovel.immobiles_ps);

        $("#nameCondominium").html('Cond.: ' + imovel.immobiles_name_condo);
        $("#finalityImmobile").html('Finalidade: ' + imovel.immobiles_finality);
        $("#pointRefImmobile").html('Ponto Ref.: ' + imovel.immobiles_reference_point);
        $("#defaultImmobile").html('Padrão Imóvel: ' + imovel.immobiles_property_default);
        $("#faceImmobile").html('Face do Imóvel: ' + imovel.immobiles_face_immobile);
        $("#qtdToiletImmobile").html('Qtde Banheiro: ' + imovel.immobiles_qtd_dormitory + ' - Suíte: ' + imovel.immobiles_qtd_suite);

    });
    getPhotoImmobile(immobile_code);

    getInfoKey(immobile_code);

}

function getPhotoImmobile(data) {
    //console.log("data photo: " + data.immobiles_code);
    $.get(domain_complet + '/foto-imovel/' + data, function (camp) {
        /*optional stuff to do after success */

        $.each(camp, function (index, val) {
            $("#photos-immobiles").append('<div class="col-md-3">' +
                '<a href="' + val.photo_immobiles_url + '" data-lightbox="roadtrip" class="thumbnail">' +
                '<img src="' + val.photo_immobiles_url + '" class="image_align">' +
                '</a><div>');
        });

    });

}

function getInfoKey(code_immobile) {

    $.get(domain_complet + '/key/get/' + code_immobile, function (data) {

        $.each(data, function (index, val) {

            $("#infoKey").append('<li class="list-group-item"><strong>Codigo:</strong> ' + val.keys_code + ' <br><strong>Status:</strong> ' + val.keys_status + '</li>');
        });
    });
}

function clearInfoModal() {
    $("#carousel-inner-photo div").remove()
    $("#infoKey li").remove();
    $("#photos-immobiles a").remove();
}

function loadTableImmobile() {
    $('#table_immobile').DataTable({
        processing: true,
        serverSide: true,
        ajax: domain_complet + '/imovel/show',
        columns: [

            {
                data: 'immobiles_code',
                name: 'immobiles_code'
            },
            {
                data: 'immobiles_type_immobiles',
                name: 'immobiles_type_immobiles'
            },
            {
                data: 'immobiles_address',
                name: 'immobiles_address'
            },
            {
                data: 'immobiles_complement',
                name: 'immobiles_complement'
            },
            {
                data: 'immobiles_district',
                name: 'immobiles_district'
            },
            {
                data: 'immobiles_name_condo',
                name: 'immobiles_name_condo'
            },
            {
                data: 'immobiles_rental_price',
                name: 'immobiles_rental_price'
            },
            {
                data: 'immobiles_finality',
                name: 'immobiles_finality'
            },
            {
                data: 'immobiles_status',
                name: 'immobiles_status'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }


        ],
        "language": {
            "lengthMenu": "Exibir _MENU_ imóveis por página",
            "emptyTable": "Não existe nenhum tour criado",
            "infoEmpty": "Mostrando 0 Registros",
            "info": "Mostrando _PAGE_ páginas de _PAGES_",
            "searchPlaceholder": "Digite sua pesquisa",
            "search": "Pesquisar: ",
            "show": "Mostrar",
            "infoFiltered": " - Encontrado _TOTAL_  imoveis",
            "paginate": {
                "previous": "Anterior",
                "next": "Próxima",
                "last": "Última",
                "first": "Primeira",
                "loadingRecords": "Aguarde - lendo dados..."
            },

        },
        "iDisplayLength": 50,
        "search": {
            "caseInsensitive": false
        }
    });


}
