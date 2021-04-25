<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;
use AdminEspindola\User;
use AdminEspindola\Survey;
use DB;
use Carbon\Carbon;

class Helpers extends Model
{
    //
     public static function check_functionary($id)
	{
		# code...
		$user = User::find($id);

		return $user['name'];
	}

	static public function reg_not_all($user = null, $descricao)
	{
		# code...
		//REGISTRA NO BANCO A ENTRADA DO USUÁRIO
           
            $user_all = User::all();

            // foreach ($user_all as $alls) {
            //     Notification::insert([
            //         [
            //             'notification_id_user' =>  $alls->id , //USUARIO DESSE ID SERÁ NOTIFICADO
            //             'notification_read' => 0 , //INFORMANDO QUE É UMA NOTIFICAÇÃO NAO LIDA
            //             'created_at' => Carbon::now() , //DATA E HORA
            //             'updated_at' => Carbon::now(),
            //             'notification_description' => $descricao //NOME DO USUARIO MAIS UMA DESCRIÇÃO
            //         ]               
            //     ]);
            // }

	}

    static public function verify_auth_delete_image($id_survey , User $user){
        // FUNCAO ESPECIFICA PARA VERIFICAR SE O USUARIO É ADM E SE A VISTORIA ESTA FINALIZADA
        //MESMO FINALIZADA O ADM PODE EXCLUIR IMAGEM
        $survey = Survey::find($id_survey);

        if( $survey->survey_status == 'Finalizada' && $user->adm == 0){
            $adm = 'disabled';
        }else{
            $adm = '';
        }

        return $adm;
    }

    /*CONTA O TOTAL DE FOTOS QUE TEM DE UMA DETERMINADA VISTORIA*/
    static public function count_photo_survey_ambience($id)
    {
        # code...
        $count_photo = DB::table('files_ambience')->where([
                              ['files_ambience_id_survey' , $id],
                              ])->get();

        return count($count_photo);
    }

       //FORMATANDO A DATA PARA PADÃO AMERICANO
    static public function DataBRtoMySQL( $DataBR ) 
    {

        $DataBR = str_replace(array(" – ","-"," "," "), " ", $DataBR);
        list($data) = explode(" ", $DataBR);
        return implode("-",array_reverse(explode("/",$data))) ;
        
    }

    static public function getNameMonth($mes_anterior)
    {
        if($mes_anterior == 1){
            $mes_nome = "Janeiro";
            }elseif($mes_anterior == 2){
            $mes_nome = "Fevereiro";
            }elseif($mes_anterior == 3){
            $mes_nome = "Março";
            }elseif($mes_anterior == 4){
            $mes_nome = "Abril";
            }elseif($mes_anterior == 5){
            $mes_nome = "Maio";
            }elseif($mes_anterior == 6){
            $mes_nome = "Junho";
            }elseif($mes_anterior == 7){
            $mes_nome = "Julho";
            }elseif($mes_anterior == 8){
            $mes_nome = "Agosto";
            }elseif($mes_anterior == 9){
            $mes_nome = "Setembro";
            }elseif($mes_anterior == 10){
            $mes_nome = "Outubro";
            }elseif($mes_anterior == 11){
            $mes_nome = "Novembro";
            }elseif($mes_anterior == 0){
            $mes_nome = "Dezembro";
        }

        return $mes_nome;
    }

    static public function getNameUser($id)
    {
        $user = User::find($id);
        return $user->nick;
    }

    //formata o valor moeda para guardar no banco
    static public function money_real($get_valor) 
    {
        $source = array('.', ','); 
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    static public function register_phone_client($request_phone , $clients_id )
    {
        $isClient = DB::table('phone')->where('phone_id_client', $clients_id)->get();
        if(is_array($isClient) && count($isClient) == 0) {
            foreach ($request_phone as $value) {
                $phone = DB::table('phone')->insert(
                    ['phone_number' => $value , 'phone_id_client' => $clients_id , 'create_at' => Carbon::now(), 'update_at' => Carbon::now()]
                );
            
            }
        }
        
       
    }
}
