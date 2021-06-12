<?php

//ROTA DE AUTENTICAÇÃO DEVE FICAR FORA DO MIDDLEWARE WEB PARA PODER INFORMAR AS MENSAGENS DE ERROS
Route::auth();
//ROTA DAS PROPOSTAS
	Route::get('/proposta-pf' , 'ProposalController@index');
	Route::get('/proposal-all' , 'ProposalController@getProposal');
	Route::get('/procurar-proposta/{id}' , 'ProposalController@search_proposta');
	Route::get('/download-arquivo/{id}/{tipo}' , 'ProposalController@download');
	Route::delete('/excluir-proposta-pf' , 'ProposalController@delete_proposal_pf');


//ROTAS DE AUTENTICAÇÃO
    
    //PÁGINA INICIAL
    Route::get('/', 'ProposalController@home');
	//ROTA DAS PROPOSTAS PESSOA JURIDICA
	Route::get('/proposta-pj' , 'ProposalController@all_pj');
	Route::get('/proposal-all-pj' , 'ProposalController@getProposalPJ');
	Route::get('/procurar-proposta-pj/{id}' , 'ProposalController@search_proposta_pj');
	Route::delete('excluir-propostapj/{id}' , 'ProposalController@delete_proposal_pj');

	//ROTA CADASTRO PESSOA FÍSICA
	Route::get('/cadastro-pf' , 'CadastreController@index');
	Route::get('/cadastre-all' , 'CadastreController@getCadastrePF');
	Route::get('/procurar-cadastro-pf/{id}' , 'CadastreController@search_cadastre');
	Route::delete('excluir-cadastro-pf' , 'CadastreController@delete_pf');
	//ROTA DAS PROPOSTAS PESSOA JURIDICA
	Route::get('/cadastro-pj' , 'CadastreController@all_pj');
	Route::get('/cadastre-all-pj' , 'CadastreController@getCadastrePJ');
	Route::get('/procurar-cadastro-pj/{id}' , 'CadastreController@search_cadastre_pj');
	//PARA DOWNLOAD
	Route::get('/baixar/{name_file}' , 'ProposalController@baixar');
	Route::get('/baixar-todos/{id}/{tipo}' , 'ProposalController@download_all');
	//PARA VISTORIA

	//PARA DEFINIR O PERFIL
	Route::post('/cadastrar-perfil', 'ProfileController@cadastre');
	Route::get('/alterar-perfil/{id}/id-user/{id_user}', 'ProfileController@edit_profile');
	Route::get('perfis', 'ProfileController@all_profile');
	Route::post('/alterar-perfil-proposta/{id}', 'ProfileController@edit_profile_proposal');

	/* -- GERANDO PDF --*/
	//USUARIOS
	Route::get('/pdf-usuarios' , 'UserController@pdf_users');
	//NOTIFICAÇÕES
	Route::get('/notificacao/{id}' , 'NotificationController@all_user');
	Route::get('/total-notificacao/{id}' , 'NotificationController@sum_notif');
	Route::get('/notificacao-lida/{id}' , 'NotificationController@update_read');

	//VISUALIZAR PDF SEM TER LOGIN
	Route::get('visualizar-vistoria-pdf/{id}', 'PdfViewController@view_survey');


	//PARA PONTO ELETRONICO 
	Route::get('tangerino', function () {
	    return view('tangerino');
	});

	Route::get('em_desenvolvimento', function () {
	    return view('desenvolvimento');
	});
	//ROTA PARA TESTES DIVERSOS
	Route::get('teste' , 'SurveyController@teste');
	
	
	Route::get('/home', 'ProposalController@home');
	
    Route::group(['prefix' => 'admin'], function () {
		Route::get('dashboard', 'PainelController@index');
	});
	/************************************/
	//ROTA DE USUARIOS DO SISTEMA
	/************************************/
	Route::group(['prefix' => 'admin'], function () {
		Route::get('/usuario/{id}', 'UserController@search_user');
	});	
	Route::group(['prefix' => 'admin'], function () {
		Route::delete('/destroy/{id}', 'UserController@destroy');
	});
	Route::group(['prefix' => 'admin'], function () {
		//ALTERANDO AVATAR DO USUÁRIO
		Route::post('/alterar-avatar', 'UserController@update_avatar');
	});
	Route::group(['prefix' => 'admin'], function () {
		//ALTERANDO AVATAR DO USUÁRIO
		Route::get('/editar-usuario/{id}', 'UserController@find_user');
	});
	Route::group(['prefix' => 'admin'], function () {
		//ALTERANDO AVATAR DO USUÁRIO
		Route::post('/editar-usuario/{id}', 'UserController@update_user');
	});
	Route::get('alterar-senha/{id}', 'PasswordController@cad_password');
	Route::post('alterar-senha', 'PasswordController@create');
	Route::post('/redefinir-senha', 'UserController@reset_password_adm');
	Route::group(['prefix' => 'configuracao'], function () {
		Route::get('/usuarios', 'UserController@all');
	});

	Route::group(['prefix' => 'configuracao'], function () {
		Route::get('/adicionar-usuario', 'UserController@add_user');
		Route::post('/adicionar-usuario', 'UserController@add_user_create');
	});
	Route::get('/usuario-excluido',function (){
		return redirect('configuracao/usuarios')->with('mensagem', 'Usuário excluido com sucesso');
	});
	Route::get('/usuario-cadastrado',function (){
		return redirect('configuracao/usuarios')->with('mensagem', 'Usuário CADASTRADO com sucesso');
	});
	Route::group(['prefix' => 'configuracao'], function () {
		Route::post('/update', 'UserController@update');
	});

	

/*------- ROTA ESCOLHA AZUL -----------*/
//MUDANDO O STATUS
Route::post('alterar-status-proposta/' , 'ProposalController@alter_status');
//MUDAR O ATENDETE
Route::post('alterar-atendente-proposta/' , 'ProposalController@alter_functionary');


/* ---------------- MODULO VISTORIA ---------------*/
	Route::group(['prefix' => 'vistoria'], function () {
		//home da vistoria
		//Route::get('/', 'SurveyController@index');
		Route::get('/', 'SurveyController@redirect');
		//CRIAR VISTORIA
		Route::post('/nova', 'SurveyController@nova_vistoria');
		Route::get('/nova-vistoria/{id}' , 'SurveyController@new_survey');
		Route::post('/update', 'SurveyController@update');
		Route::get('visualizar-360/{id}' , 'SurveyController@view_360');
		Route::get('ver-360/{name}' , 'SurveyController@view_360_full');
		Route::get('imprimir/{id}' , 'SurveyController@pdf_survey_photo');
		Route::get('imprimir-sem-foto/{id}' , 'SurveyController@pdf_survey');
		
		Route::post('upload' , 'SurveyController@upload');
		//BUSCANDO AS FOTOS VIA AJAX
		Route::get('/fotos-ambiente/{id_survey}' , 'SurveyController@search_photo');
		Route::post('/upload/360' , 'SurveyController@upload360');
		Route::get('/editar/{id}' , 'SurveyController@edit');
		Route::delete('/excluir/{id}' , 'SurveyController@delete');
		Route::post('/enviar-vistoria/{id}' , 'SurveyController@send_survey');
		Route::get('/replicar/{id}' , 'SurveyController@reply_survey');	
		Route::post('/salvar-ambiente' , 'SurveyController@add_ambience');
		Route::get('/todos-ambiente' , 'SurveyController@all_ambience');		
		Route::get('/excluir-ambiente/{id}' , 'SurveyController@delete_ambience');		
		Route::post('/alterar-aspectos' , 'SurveyController@update_aspect');		
		Route::post('/alterar-ressalva' , 'SurveyController@update_reservation');		
		Route::post('/alterar-disposicoes' , 'SurveyController@update_provisions');
		Route::post('/alterar-chaves' , 'SurveyController@update_keys');
		Route::get('/download/{id}' , 'SurveyController@download');
		Route::get('show/{id}' , 'SurveyController@show');
		Route::post('imagem-ambiente' , 'SurveyController@deleteImageAmbience');
		Route::get('/baixar-vistoria/{name_file_survey}' , 'SurveyController@download_file');
		Route::get('/historico/{id}' , 'SurveyController@history_survey');
		//Route::post('cadastrar-locador-adicional' , 'SurveyController@add_locator');
		//Route::post('cadastrar-locatario-adicional' , 'SurveyController@add_loc');
		Route::get('excluir-usuario-vistoria/{id}/vistoria/{id_survey}' , 'SurveyController@delete_user_survey');	
		//Route::delete('excluir-imagem-360/{id}/tipo/{type}', 'FilesAmbienceController@destroy');
		Route::delete('excluir-imagem/{id}/{type}'	, 'FilesAmbienceController@destroy');	
		Route::put('alterar-ambiente' 				, 'FilesAmbienceController@update');
		Route::post('excluir-varios-ambientes' , 'FilesAmbienceController@all_image');
		Route::delete('delete-files' , 'FilesAmbienceController@destroy');
	});	
		Route::group(['prefix' => 'configuracoes'], function () {
		//home da vistoria			
			Route::get('/todas-vistoria/{email}', 'PortalClientController@list_survey');		
		});	
/*-----------ROTAS PARA O TOUR VIRTUAL-------------------*/


/*  ----- ROTA PARA CHAVES -----  */

Route::get('chaves/receipt' , 'KeyController@receiptPdf');
Route::get('chaves/show/{cpf}' , 'ControlKeyController@show');
Route::resource('/chaves' , 'ControlKeyController');
Route::post('update-code-key' , 'KeyController@updateCode');
Route::post('key/store' ,  'KeyController@store');
Route::post('create-reserve' , 'KeyController@createReserve');
//Route::get('key/{id}/edit' , "KeyController@edit");
Route::put('key/{id}' , "KeyController@update");
Route::get('key/show/{id}' , "KeyController@show");
Route::post('key/search' , 'KeyController@search');
Route::get('key/get/{id}' , 'KeyController@getKey');

Route::resource('key' , 'KeyController');
/* 	-- RESERVA DE CHAVES --  */
Route::resource('reserva' , "ReserveController");
Route::get('reserva/{id}/edit' , 'ReserveController@edit');
Route::get('reserva/{id}/show' , 'ReserveController@show');
Route::post('search-reserve' , 'ReserveController@search');
Route::post('verify-phone-client' , 'KeyController@verifyFone');
Route::get('criar-reserva/{id}', 'ReserveController@create');

/*  --- ROTA PARA CONFIRMAÇÃO DE RECEBIMENTO DE CHAVES --- */
//Route::resource('avaliacao' , 'EvaluationController');

/*  ----- ROTA PARA CADASTRO DE IMÓVEIS -----  */
Route::get('imovel-mostra/{codeImmobile}' , 'ImmobileController@showImmobile');
Route::resource('imovel'   , 'ImmobileController');
Route::get('todos-imovel'  , 'ImmobileController@getImmobile');
Route::get('imovel-xml/'   , 'ImmobileController@xml');
Route::get('foto-imovel/{code}'   , 'ImmobileController@getPhotoImmobile');



/* ---- ROTA PARA RELATORIOS */

Route::get('report/analytic-sintetic' , 'ReportGeneral@rel_sintetic_delivery');
Route::resource('report' , 'ReportGeneral');
//TESTE
	Route::get('/email-teste', 'UserController@email_teste');
//TESTE

/* ------- ROTAS PARA CONFIGURAÇÕES EM GERAL -------------- */	
Route::get('configuracao' , 'SettingsController@index');

/* ------- ROTAS PARA DELIVERY -------------- */	

Route::get('delivery/all' , 'DeliveryController@getDelivery');
Route::post('delivery/destroy/{id}' , 'DeliveryController@destroy');
Route::post('delivery/report' , 'DeliveryController@getReportSintetic');
Route::resource('delivery' , 'DeliveryController');

/* Relatório de Delivery */
Route::resource('report-delivery' , 'ReportDeliveryController');

Route::group(['prefix' => 'configuracao'], function () {
//home da vistoria
	Route::get('/conf-ressalva' , 'SettingsController@setting_reservation');	
	Route::get('/conf-ascpectos-gerais' , 'SettingsController@setting_aspect');
	Route::get('/conf-disposicoes' , 'SettingsController@setting_provisions');
	Route::get('/conf-chaves' , 'SettingsController@setting_keys'); 	
	Route::get('/todas-vistoria/{email}', 'PortalClientController@list_survey');
	Route::get('/imovel', 'SettingsController@immobile');
	Route::resource('cadastrar-cliente', 'BusinessController');

});	

/* -- ROTA PARA UPLOAD DE ARQUIVOS -- */
Route::resource('file' , 'FileController');
Route::get('file/{id}/delete' , 'FileController@destroy');
Route::post('delete-image' , 'FileController@delete_files');
Route::post('files-upload/{id}/tipo/{type}' , 'FileController@upload');

/* ROTA DE CLIENTS */
Route::post('client/verify-email' , 'ClientController@verify_email');
Route::resource('clientes' , 'ClientController');

//CEP
Route::post('cep' , 'KeyController@cep');
/* REDIRECIONAMENTO DE ERROS */
// Route::get('/pagenotfound', 'HomeController@padenotfound');	
// Route::get('/denied', 'HomeController@denied');	
		
Route::auth();

Route::get('/home', 'HomeController@index');
