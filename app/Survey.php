<?php
/*
Project : ESPINDOLAADMIN
@author: Excellence
 */
namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Survey extends Model
{
    // //Created in 2016-07-22 13:20 by Junior Oliveira
    protected $table = 'survey';

    protected $primaryKey = 'survey_id';

    protected $fillable = 
    [
	 	'survey_locator_name', 'survey_locator_cpf', 'survey_occupant_name', 'survey_occupant_cpf', 'survey_inspetor_name', 'survey_inspetor_cpf' ,'survey_date', 'survey_type', 'survey_address_immobile' , 'survey_type_immobile' , 'survey_energy_meter' , 'survey_energy_load' , 'survey_water_meter',  'survey_water_load' , 'survey_gas_meter' , 'survey_gas_load', 'survey_keys'
	];

	//FORMATANDO A DATA PARA PADÃO AMERICANO
	static public function DataBRtoMySQL( $DataBR ) {

		$DataBR = str_replace(array(" – ","-"," "," "), " ", $DataBR);
		list($data) = explode(" ", $DataBR);
		return implode("-",array_reverse(explode("/",$data))) ;
		
	}

	//OBRIGATORIAMENTE O PRIMEIRO CAMPO DO ARRAY TEM QUE SER O NOME DO USUARIO E O SEGUNDO O EMAIL
	static public function cadastra_usuario($campo_user, $id_survey, $cpf , $type_relation)
	{

	      //CADASTRANDO USUARIO   
	    $user_locator = User::create(
	        [ 'name' =>  $campo_user[0], 'email' =>  $campo_user[1]  , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'adm' => 0, 'status' => 0, 'id_profile' => 14  , 'password' => bcrypt($cpf)]
	    );
	    //GRAVANDO DADOS NA TABELA DE RELACIONAMENTO
	    $relation_locador = DB::table('relation_survey_user')->insert(['relation_survey_user_id_survey' => $id_survey, 'relation_survey_user_id_user' => $user_locator->id , 'relation_survey_user_cpf' => $cpf , 'relation_survey_user_type' => $type_relation , 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ]);        
	   
	    return $user_locator;        
	}


	/* FUNCAO PARA A PÁGINA UPDATE DA VISTORIA, CASO SEJA PARA ALTERAR O CAMPO VEM PREENCHIDO, SE FOR UMA NOVA VISTORIA O CAMPO VAZIO
		Created in 2016-07-28 10:11 by Junior Oliveira
		alterado em 17/08/2016
	*/
	static public function atualiza_usuario_vistoria($type_relation, $id_survey, $campo = array())
	{
		//BUSCANDO ID DO USUÁRIO
		$usuario = DB::table('relation_survey_user')->where([
                                    ['relation_survey_user_type' , '=' , $type_relation], 
                                    ['relation_survey_user_id_survey' , '=' , $id_survey]
                            ])->get();

        if(empty($usuario)){

        }else{
        	$up_user = DB::table('users')
        ->where('id', $usuario[0]->relation_survey_user_id_user)
        ->update([ 'name' => $campo[0] , 'email' =>  $campo[1] , 'updated_at' => Carbon::now()] );
        }
        
        if($up_user)
     
        	return true;
        
        else

        	return false;
	}


	static public function consulta_relacao_usuario($id_survey, $type)
	{
		# created in 2016-08-17 by Junior Oliveira
		$survey_relation_user = DB::table('relation_survey_user')
                        ->join('survey', 'survey.survey_id' , '=' , 'relation_survey_user.relation_survey_user_id_survey')
                        ->join('users' , 'users.id' , '=' , 'relation_survey_user.relation_survey_user_id_user')
                        ->where([
                            ['relation_survey_user.relation_survey_user_id_survey' , '=', $id_survey],
                            ['relation_survey_user.relation_survey_user_type' , '=' , $type]
                        ])->get();

        return $survey_relation_user;                
	}

	static public function update_survey_user($array_id_user, $array_type_name, $array_type_email, $array_type_cpf)
	{
		# code created 2016-11-15 14:39 by Junior Oliveira
		//CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
        $user_upd = User::find($request->id_user[$i]);

        $user_where = DB::table('users')->where('id' ,'=', $user_upd->id )->update([
                                                        'name' => $request->survey_locator_name[$i] ,
                                                        'email'=> $request->survey_locator_email[$i]  
                                                        ]);
        DB::table('relation_survey_user')->where('relation_survey_user_id_user' , '=' , $user_upd->id)->update(['relation_survey_user_cpf' => $request->survey_locator_cpf[$i]]); 
	}


	static public function data_extenso()
	{
		$dia = date('d');
		$mes = date('m');
		$ano = date('Y');
		$semana = date('w');
		$cidade = "Fortaleza";

		// configuração mes 

		switch ($mes){

			case 1: $mes = "Janeiro"; break;
			case 2: $mes = "Fevereiro"; break;
			case 3: $mes = "Março"; break;
			case 4: $mes = "Abril"; break;
			case 5: $mes = "Maio"; break;
			case 6: $mes = "Junho"; break;
			case 7: $mes = "Julho"; break;
			case 8: $mes = "Agosto"; break;
			case 9: $mes = "Setembro"; break;
			case 10: $mes = "Outubro"; break;
			case 11: $mes = "Novembro"; break;
			case 12: $mes = "Dezembro"; break;

		}


		// configuração semana 

		switch ($semana) {

			case 0: $semana = "Domingo"; break;
			case 1: $semana = "Segunda Feira"; break;
			case 2: $semana = "Terça Feira"; break;
			case 3: $semana = "Quarta Feira"; break;
			case 4: $semana = "Quinta Feira"; break;
			case 5: $semana = "Sexta Feira"; break;
			case 6: $semana = "Sábado"; break;

		}

		return $cidade . ', '. $dia . ' de '. $mes . ' de '. $ano;
	}

/*

PARA REGISTRAR OS ARQUIVOS DO AMBIENCE E RETORNANDO O ID DO AMBIENTE

 */
	static public function addFilesAmbience($ambience, $name, $id_survey, $tipo)
	{
		//created 2017-12-07
		$files_ambience =   DB::table('files_ambience')->insertGetId([
                        'files_ambience_id_ambience' => $ambience, 
                        'files_ambience_description_file' => $name ,
                        'files_ambience_id_survey' => $id_survey ,
                        'files_ambience_type' => $tipo ,   
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now()
                    ]); 

		return $files_ambience;
	}

	static public function addConfigFiles( $width, $height, $files_ambience)
	{
		//created 2017-12-07
		 $size_photo = DB::table('configuration_image')->insert([
                        'configuration_image_width' => $width,
                        'configuration_image_height'=> $height,
                        'configuration_image_id_files_ambience' => $files_ambience,
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now()
                        ]);
	}


}
