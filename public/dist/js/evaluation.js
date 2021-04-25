       $("#searchCodeImmobileEvaluarion").click(function(){

        $('#table-evaluation-search').DataTable().destroy();
        $('#table-evaluation-search').DataTable({
            processing: true,
            //serverSide: true,
            ajax: {
              url: domain_complet + '/search-reserve',
              type: 'POST',
              dataType: 'json',
              data: {reserves_ref_immobile: $("#code_evaluation_immobile").val()}
            },
            columns: [
               
                {data: 'date_evaluation' , name: 'date_evaluation'},
                {data: 'clients_name', name: 'clients_name'},
                {data: 'reserves_feedback', name: 'reserves_feedback'},
                {data: 'reserves_conservation', name: 'reserves_conservation'}
            ],
             "searching": false,
             "iDisplayLength": 50
        });

    })  