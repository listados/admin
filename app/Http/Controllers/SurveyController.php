<?php
namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;
use AdminEspindola\Survey;
use DB, PDF, Validator;
use Image, Mail, Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use AdminEspindola\Http\Requests;
use Carbon\Carbon;
use ValidatesRequests;
use Illuminate\Support\MessageBag;
use AdminEspindola\User;
use AdminEspindola\Helpers;
use AdminEspindola\RelSurveyUser;
use AdminEspindola\FilesAmbience;
use Datatables;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        # //Created in 2016-07-22 13:19 by Junior Oliveira
        //  $survey = Survey::all()->sortByDesc("survey_id");
        //  $settings = DB::table('settings')->where('settings_aspect_general_active', 1)->get();
        //$page_title = "Vistoria";
        // return view('survey.survey_all', compact('survey', 'settings' , 'page_title'));
       
        
    }

    public function nova_vistoria(Request $request)
    {
        # //Created in 2016-07-22 16:48 by Junior Oliveira
        /*NA PÁGINA DE VISTORIA TEM UM BUTÃO QUE MANDA UMA REQUISIÇÃO  VIA POST E DEVOLVO PARA OUTRA ROTA COM ID */
        try {

            $request['survey_date'] = Carbon::now();
            $nova                   = DB::table('survey')->insertGetId([
                                                'survey_inspetor_name' => Auth::user()->name, 'survey_date_register' => Carbon::now(), 'survey_date' => Carbon::now(), 'survey_status' => 'Rascunho'
                                            ]); 
            $history                = DB::table('history_survey')->insert(
                                        ['history_survey_id_user' => Auth::user()->id, 'history_survey_action' => 'Criou essa vistoria', 'history_survey_created' => Carbon::now(), 'history_survey_id_survey' => $nova]);

            return redirect('vistoria/nova-vistoria/'.base64_encode($nova));

        } catch (Exception $e) {

            return redirect()->back()->with('error_message' , 'Ocorreu um erro, ('.$e.') tente novamente' );
        }
    }

    public function new_survey($id)
    {
        # //Created in 2016-07-22 21:41 by Junior Oliveira
        /*CONSULTA UMA VISTORIA PELO CODIGO*/
        $id = base64_decode($id);
        $survey_update =  Survey::find($id);
        $id_survey = $id;
        //dd($survey_update);
        $title_survey  =  'Nova Vistoria';
        $settings      = DB::table('settings')->where('settings_aspect_general_active' , 1)->get();
        $ambience       = DB::table('ambience')->orderBy('ambience_name')->get(); 


        //notificando a todos os usuarios
        Helpers::reg_not_all(null, Auth::user()->nick. " Criou a vistoria nº ".$id);
        //VERIFICA SE EXISTE DADOS CADASTRADO, SE NÃO DEVOLVE PARA PAGINA COM TODAS AS VISTORIAS
        if(!empty($survey_update)){
            //ID_SURVEY ESTOU PASSANDO COMO PARAMETRO POR QUE O MODAL AMBIENTE EXIGE POR CONTA DO EDITAR VISTORIA
            return view('survey.new_survey', compact('survey_update' , 'title_survey' , 'ambience' , 'settings' , 'id' , 'id_survey'));
        }else{
            return redirect('vistoria')->with('info' , 'Não existe Vistoria com esse código');
        }
        
    }

    public function edit($id)
    {
        # //Created in 2016-07-28 10:06 by Junior Oliveira
        /*CONSULTA UMA VISTORIA PELO CODIGO*/
        //$survey_update  =  Survey::find($id);
        $id_survey = base64_decode($id);
        $survey_update = DB::table('relation_survey_user')
                        ->join('survey', 'survey.survey_id' , '=' , 'relation_survey_user.relation_survey_user_id_survey')
                        ->join('users' , 'users.id' , '=' , 'relation_survey_user.relation_survey_user_id_user')
                        ->where('relation_survey_user.relation_survey_user_id_survey' , $id_survey)->get();
                     
        
        $title_survey   =  'Editar Vistoria';
        //objeto com todos os ambientes
        $ambience       = DB::table('ambience')->orderBy('ambience_name')->get();  
       
        //VERIFICA SE EXISTE DADOS CADASTRADO, SE NÃO DEVOLVE PARA PAGINA COM TODAS AS VISTORIAS
      //return view('survey.update', compact('survey_update', 'title_survey' , 'ambience' , 'id_survey'));
        if(empty($survey_update)){
                
                $survey_update = Survey::find($id_survey)->get();
               
                return view('survey.update', compact('survey_update', 'title_survey' , 'ambience' , 'id_survey', 'id'));
          

        }elseif(!empty($survey_update)){
           // return redirect('vistoria')->with('info' , 'Não existe Vistoria com esse código');
           return view('survey.update', compact('survey_update', 'title_survey' , 'ambience' , 'id_survey', 'id' ));
        }else{

        }
        
    }
    /*PASSANDO O ID DA VISTORIA 
        ESSE MÉTODO SERÁ CHAMADO NA PÁGINA DE DOWNLOAD ONDE MOSTRARÁ TODOS OS ARQUIVOS DOS AMBIENTES
    */
    public function show($id)
    {
        $files      = DB::table('survey')
                    ->join('files_ambience' ,'files_ambience.files_ambience_id_survey' , '=', 'survey.survey_id')
                    ->join('ambience' , 'ambience_id' , '=' , 'files_ambience.files_ambience_id_ambience')
                    ->where([['survey.survey_id', '=', $id] , ['files_ambience_type' , '=' , 'normal']]);

        $ambience       = DB::table('ambience')->orderBy('ambience_name')->get();     
        return Datatables::of($files)
                ->addColumn('files_ambience_description_file', function ($files) {
                    return '<a href="#" class="thumbnail">
                              <img src="'.url('dist/img/upload/vistoria/'.$files->files_ambience_description_file).'" alt="'.$files->files_ambience_description_file.'" title="'.$files->files_ambience_description_file.'">
                            </a>';
                })
                ->addColumn('alter', function ($files) {
                    return '<div class="checkbox checkbox-primary"><input name="surveyAlter" type="checkbox" class="" id="surveyAlter_'.$files->files_ambience_id.'" value="'.$files->files_ambience_id.'">
                        <label for="surveyAlter_'.$files->files_ambience_id.'"></label></div>';
                })
                ->addColumn('delete', function ($files) {
                    return '<div class="checkbox checkbox-primary"><input name="surveyDelete" type="checkbox" class="" id="surveyDelete_'.$files->files_ambience_id.'" value="'.$files->files_ambience_id.'">
                        <label for="surveyDelete_'.$files->files_ambience_id.'"></label></div>';

                })->make(true);     

    }

    public function update(Request $request)
    {
        # //Created in 2016-07-22 23:39 by Junior Oliveira
        //ALTERADO EM 10/08
       
        if($request->ajax())

        {   

             // //ESTOU PASSANDO ambience_id PARA BUSCAR A VISTORIA POR QUE $request['survey_id'] NAO ESTA VINDO O ID DA VISTORIA
            //ID DA VISTORIA
            $id = $request['survey_id'];
    
            /*VERIFICANDO SE A VISTORIA É UMA NOVA VISTORIA    
                CASO SEJA, CADASTRA OS USUÁRIOS SE FOR EDIÇÃO FAZ UM UPDATE NOS USUÁRIOS
            */
            if($request['type_survey'] == 'Nova Vistoria'){
                //VERIFICANDO EM TODOS OS ARRAYS SE A PRIMEIRA POSIÇÃO É VAZIA
                //CASO, SEJA, EXCLUI O ARRAY, SE NAO, REALIZA O CADASTRO NORMAL              
                if($request['survey_locator_name'][0] == ''){

                    unset($request['survey_locator_name']);

                }else{

                    for ($i=0; $i < count($request['survey_locator_name']); $i++) { 
                   
                        $campo_user = array($request->survey_locator_name[$i] , $request->survey_locator_email[$i], $request->survey_locator_cpf[$i]);
                       
                        Survey::cadastra_usuario($campo_user, $id, $request->survey_locator_cpf[$i] , 'Locador');
                   
                    } 
                }
                
                
                if($request['survey_occupant_name'][0] == ''){

                    unset($request['survey_occupant_name']);
                  
                }else{
                    
                    for ($i=0; $i < count($request['survey_occupant_name']); $i++) { 
                   
                        $campo_user = array($request->survey_occupant_name[$i] , $request->survey_occupant_email[$i], $request->survey_occupant_cpf[$i]);
                        Survey::cadastra_usuario($campo_user, $id, $request->survey_occupant_cpf[$i] , 'Locatário');
                    }
                }
                
                if($request['survey_guarantor_name'][0] == ''){
                    
                    unset($request['survey_guarantor_name']);

                }else{

                    for ($i=0; $i < count($request['survey_guarantor_name']); $i++) { 
                       
                        $campo_user = array($request->survey_guarantor_name[$i] , $request->survey_guarantor_email[$i], $request->survey_guarantor_cpf[$i]);
                        Survey::cadastra_usuario($campo_user, $id, $request->survey_guarantor_cpf[$i] , 'Fiador');
                    }

                }
              

            }elseif ( ($request['type_survey'] == 'Editar Vistoria') || $request['type_survey'] == 'Replicando Vistoria') {
               /* PARA EDIÇÃO DE MULTIPLOS USUARIO EU TENHO QUE COLHER O ARRAY ENVIADO DESSA FORMA $request->variavel
               ESSE PARAMETRO VARIAVEL É O MESMO NOME QUE ESTA NO INPUT DO FORMULARIO variavel[]
               ENTÃO EU TENHO QUE SABER QUANTAS POSIÇÕES SÃO PARA PODER DÁ FAZER UM LOOP
               CONSULTO O USUARIO PELO ID ENVIADO E FAÇO O UPDATE PASSANDO O NOVO NOME
               */   
               /* ----  LOCADOR  --- */
               //total de posição do array id_user 
               $total_idUser = count($request['id_user']);

               //toal de posição do array nome locador
               $total_nomeUs = count($request['survey_locator_name']) ;
               //calculando a diferença dos dois arrays
               $dif = ($total_nomeUs - $total_idUser);
               //dd($request->all());
               /*É FEITO A VERIFICAÇÃO NO ARRAY ID_USER PARA CONSTATAR QUE NAO TEM CAMPOS NO ARRAY PARA FAZER UM NOVO CADASTRO*/
                if($total_idUser == 0){
                     //DARÁ O LOOP DO TOTAL DE CAMPO ADICIONADO
                    for ($i=0; $i < $total_nomeUs; $i++) { 
                            # code...
                        $campo_user = array($request->survey_locator_name[$i] , $request->survey_locator_email[$i], $request->survey_locator_cpf[$i]);
                        $surv_new   = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_locator_cpf[$i] , 'Locador');
                    }    
                }else{
                     //VERIFICANDO SE ARRAY ID_USER É MENOR QUE NOME LOCADOR
                    if( $total_idUser < $total_nomeUs ){
                        $tot = 0;
                        for ($i=0; $i < $total_idUser; $i++) { 
                             # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_upd = User::find($request->id_user[$i]);

                            $user_where = DB::table('users')->where('id' ,'=', $user_upd->id )->update([
                                                                            'name' => $request->survey_locator_name[$i] ,
                                                                            'email'=> $request->survey_locator_email[$i]  
                                                                            ]);
                            DB::table('relation_survey_user')->where('relation_survey_user_id_user' , '=' , $user_upd->id)->update(['relation_survey_user_cpf' => $request->survey_locator_cpf[$i]]); 
                        $tot = ($tot + 1);    
                        }
                       
                        //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS
                        for ($i=0; $i < $dif; $i++) { 
                                # code...
                            $campo_user = array($request->survey_locator_name[$tot] , $request->survey_locator_email[$tot], $request->survey_locator_cpf[$tot]);
                            $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_locator_cpf[$tot] , 'Locador');
                           
                        }    
                        
                        //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                    }elseif($total_idUser == $total_nomeUs){
                        for ($i=0; $i < $total_idUser; $i++) { 
                             # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_upd = User::find($request->id_user[$i]);

                            $user_where = DB::table('users')->where('id' ,'=', $user_upd->id )->update([
                                                                            'name' => $request->survey_locator_name[$i] ,
                                                                            'email'=> $request->survey_locator_email[$i]  
                                                                            ]);
                            DB::table('relation_survey_user')->where('relation_survey_user_id_user' , '=' , $user_upd->id)->update(['relation_survey_user_cpf' => $request->survey_locator_cpf[$i]]); 
                            
                        }
                    }
                }
                /* ----  LOCATÁRIO  --- */
                //total de posição do array id_user          
                $total_idUserOccupant = count($request['id_user_occupant']);
                //toal de posição do array nome locador
                $total_nameOccupant = count($request['survey_occupant_name']) ;
                //calculando a diferença dos dois arrays
                $dif_occupant = ($total_nameOccupant - $total_idUserOccupant);
                //VERIFICANDO SE ARRAY ID_USER É MENOR QUE NOME LOCADOR
                //dd($request->all());
                if($total_idUserOccupant == 0){

                    for ($i=0; $i < $total_nameOccupant; $i++) { 
                            # code...
                        $campo_user = array($request->survey_occupant_name[$i] , $request->survey_occupant_email[$i], $request->survey_occupant_cpf[$i]);
                        $surv_new_ocu = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_occupant_cpf[$i] , 'Locatário');
                       
                    }    

                }else{
                    if( $total_idUserOccupant < $total_nameOccupant ){
                    $tot_occupant = 0;
                    for ($i=0; $i < $total_idUserOccupant; $i++) { 
                         # code...
                        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                        $user_occ = User::find($request->id_user_occupant[$i]);

                        $user_where_occ = DB::table('users')->where('id' ,'=', $user_occ->id )->update([
                                                                        'name' => $request->survey_occupant_name[$i] ,
                                                                        'email'=> $request->survey_occupant_email[$i]  
                                                                        ]);
                        DB::table('relation_survey_user')->where('relation_survey_user_id_user' , '=' , $user_occ->id)->update(['relation_survey_user_cpf' => $request->survey_occupant_cpf[$i]]); 
                    $tot_occupant = ($tot_occupant + 1);  
                    }
                   
                    //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS
                    for ($i=0; $i < $dif_occupant; $i++) { 
                            # code...
                    
                        $campo_user = array($request->survey_occupant_name[$tot_occupant] , $request->survey_occupant_email[$tot_occupant], $request->survey_occupant_cpf[$tot_occupant]);
                        $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_occupant_cpf[$tot_occupant] , 'Locatário');
                       
                    }    
                    
                    //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                }elseif($total_idUserOccupant == $total_nameOccupant){
                    for ($i=0; $i < $total_idUserOccupant; $i++) { 
                         # code...
                        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                        $user_occ = User::find($request->id_user_occupant[$i]);
                        //dd($request['id_user_occupant']);
                        $user_where_occ = DB::table('users')->where('id' ,'=', $user_occ->id )->update([
                                                                        'name' => $request->survey_occupant_name[$i] ,
                                                                        'email'=> $request->survey_occupant_email[$i]  
                                                                        ]);
                        DB::table('relation_survey_user')->where('relation_survey_user_id_user' , '=' , $user_occ->id)->update(['relation_survey_user_cpf' => $request->survey_occupant_cpf[$i]]);                         
                    }
                }
                }

            }

            /* ----  FIADOR Guarantor --- */
            $total_idUserGuarantor  = count($request['id_user_guarantor']);
            $total_nameGuarantor    = count($request['survey_guarantor_name']) ;
            $difGuarantor           = ($total_nameGuarantor - $total_idUserGuarantor);
             //dd($request['survey_guarantor_name']);
            if($total_idUserGuarantor == 0){

                for ($i=0; $i < $total_nameGuarantor; $i++) {  
                    $campo_user = array($request->survey_guarantor_name[$i] , $request->survey_guarantor_email[$i], $request->survey_guarantor_cpf[$i]);
                    $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_guarantor_cpf[$i] , 'Fiador');                   
                }    

            }else{
                  if( $total_idUserGuarantor < $total_nameGuarantor ){
                    $tot_guarantor = 0;
                    for ($i=0; $i < $total_idUserGuarantor; $i++) { 
                         # code...
                        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                        $user_gua = User::find($request->id_user_guarantor[$i]);

                        $user_where_gua = DB::table('users')->where('id' ,'=', $user_gua->id )->update([
                                                                        'name' => $request->survey_guarantor_name[$i] ,
                                                                        'email'=> $request->survey_guarantor_email[$i]  
                                                                        ]);
                        DB::table('relation_survey_user')->where('relation_survey_user_id_user' , '=' , $user_gua->id)->update(['relation_survey_user_cpf' => $request->survey_guarantor_cpf[$i]]); 
                    $tot_guarantor = ($tot_guarantor + 1);  
                    }
                   
                    //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS
                   
                    for ($i=0; $i < $difGuarantor; $i++) { 
                            # code...                        
                        $campo_user = array($request->survey_guarantor_name[$tot_guarantor] , $request->survey_guarantor_email[$tot_guarantor], $request->survey_guarantor_cpf[$tot_guarantor]);
                        $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_guarantor_cpf[$tot_guarantor] , 'Fiador');                           
                    }    
                                      
                    
                    //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                }elseif($total_idUserGuarantor == $total_nameGuarantor){
                    for ($i=0; $i < $total_idUserGuarantor; $i++) { 
                         # code...
                        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                        $user_gua = User::find($request->id_user_guarantor[$i]);
                        //dd($request['id_user_occupant']);
                        $user_where_gua = DB::table('users')->where('id' ,'=', $user_gua->id )->update([
                                                                        'name' => $request->survey_guarantor_name[$i] ,
                                                                        'email'=> $request->survey_guarantor_email[$i]  
                                                                        ]);
                        DB::table('relation_survey_user')->where('relation_survey_user_id_user' , '=' , $user_gua->id)->update(['relation_survey_user_cpf' => $request->survey_guarantor_cpf[$i]]); 
                        
                    }
                }
            }

          
            $survey = Survey::find($id);            

            $request['survey_date'] = Survey::DataBRtoMySQL( $request['survey_date'] );

            //PARA DEFINIR NO HISTORICO SE FOR SALVO O RASCUNHO OU FINALIZADO
            if($request['survey_status'] == "Finalizada"){
                $content_not = " finalizou a vistoria ";
            }else{
                $content_not = " salvou o rascunho da vistoria ";
            }

            $year = Carbon::now();
             try {
                Survey::where('survey_id' , $id)->update([
                            'survey_inspetor_name'      => $request['survey_inspetor_name'] ,
                            'survey_inspetor_cpf'       => $request['survey_inspetor_cpf']  ,
                            'survey_date'               => $request['survey_date']  ,
                            'survey_type'               => $request['survey_type']  ,
                            'survey_address_immobile'   => $request['survey_address_immobile']  ,
                            'survey_type_immobile'      => $request['survey_type_immobile']  ,
                            'survey_energy_meter'       => $request['survey_energy_meter']  ,
                            'survey_energy_load'        => $request['survey_energy_load']  ,
                            'survey_water_meter'        => $request['survey_water_meter']  ,
                            'survey_water_load'         => $request['survey_water_load']  ,
                            'survey_gas_meter'          => $request['survey_gas_meter']  ,
                            'survey_gas_load'           => $request['survey_gas_load']  ,
                            'survey_general_aspects'    => $request['survey_general_aspects']  ,
                            'survey_reservation'        => $request['survey_reservation']  ,
                            'survey_keys'               => $request['survey_keys'] ,
                            'survey_status'             => $request['survey_status'],
                            'created_at'                => Carbon::now(),
                            'survey_date_register'      => Carbon::now(),
                            'survey_code'               => $id.'/'.date("y"),
                            'survey_link_tour'          => $request['survey_link_tour'], 
                            'survey_provisions'         => $request['survey_provisions']  
                        ]);
                //  //notificando a todos os usuarios
                Helpers::reg_not_all(null, Auth::user()->nick. $content_not .$id);
           
                DB::table('history_survey')->insert(['history_survey_id_user' => Auth::user()->id, 'history_survey_action' => 'Alterou e salvou o rascunho dessa vistoria' , 'history_survey_id_survey' => $id , 'history_survey_date' => Carbon::now()]); 

                return response()->json(['mensagem' , 'success' ]);  
            } catch (Exception $e) {
               
               return response($e->getMessage());
            }
            
           
            
            
        }
        
    }

    public function delete($id)
    {
        #  //Created in 2016-07-28 12:17 by Junior Oliveira
        $survey = Survey::destroy($id);
   
        try {

         return redirect('vistoria')->with('mensagem' , 'Vistoria EXCLUIDA com sucesso.');

        } catch (Exception $e) {

            return redirect('vistoria')->with('error_message' , 'Ocorreu um erro, tente novamente.');

        }
    }    


    public function pdf_survey_photo(Request $request, $id)
    {
        #  //Created in 2016-07-25 15:53 by Junior Oliveira

        // $id = $request['survey_id'];

        ini_set('memory_limit', '128M');
        ob_start();
        //ini_set('max_execution_time', 300); 

        $survey = DB::table('files_ambience')
            ->join('survey', 'survey.survey_id', '=', 'files_ambience.files_ambience_id_survey')
            ->join('ambience', 'ambience.ambience_id', '=', 'files_ambience.files_ambience_id_ambience')
            ->where('survey_id' , $id)->get();

        if(empty($survey))
        {
            $survey = Survey::where('survey_id' , $id)->get();
            $photo_ambience = false;
           
        }else{

            $photo_ambience = true;
        }        


        $users = DB::table('relation_survey_user')
                    ->join('survey', 'survey.survey_id' , '=' , 'relation_survey_user.relation_survey_user_id_survey')
                    ->join('users' , 'users.id' , '=' , 'relation_survey_user.relation_survey_user_id_user')
                    ->where('relation_survey_user.relation_survey_user_id_survey' , $id)->get();
                        
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $data_extenso = Survey::data_extenso();                
        $settings = DB::table('settings')->get();   

        
        //FILTRANDO O ARRAY COM TIPO 360
        $survey_type = FALSE;
        foreach ($survey as $key => $value) {
            
            if(empty($value->files_ambience_id))
            {
                $survey_type = TRUE;
            }
        }

        if($survey_type == 0)
        {
           $survey_360 = array_filter(
                $survey,
                function($item)
                {
                    if ( $item->files_ambience_type == '360' )
                        return TRUE;

                    return FALSE;
                }
            );
        }else{
            $survey_360 = [];
        }
        //VARIÁVEIS COM AS FOTOS NORMAIS
        $survey_normal = $survey;
        //LOOP RETIRANDO OS INDICES COM O TIPO 360
        foreach ($survey_360 as $key => $value)
        {
            unset( $survey_normal[$key] );
        }
        //$survey_normal ESTÁ NESSE MOMENTO COM AS FOTOS CONVENCIONAIS
        $survey_update = [];
        foreach ( $survey_normal as $item )
        {
            //$suvey_update = $survey ALTERADO SOM OS INDICES 360
            //SERÁ FEITO O LOOP DELE PRIMEIRAMENTE MOSTRANDO AS FOTOS
            //ESTÁ PREENCHENDO O INDICE CONCATENENDO O ITEM    
            $survey_update[ $item->ambience_id ][] = $item;
        }

        $survey_update_360 = [];
        foreach ( $survey_360 as $item )
        {
            $survey_update_360[ $item->ambience_id ][] = $item;
        }

        // return view('survey.report.view_survey',['survey' => $survey , 'survey_update' => $survey_update , 'survey_update_360' => $survey_update_360 , 'settings' => $settings , 'users' => $users, 'data_extenso' => $data_extenso , 'photo_ambience' => $photo_ambience ]);
        $pdf = PDF::loadView('survey.report.view_survey',['survey' => $survey , 'survey_update' => $survey_update , 'survey_update_360' => $survey_update_360 , 'settings' => $settings , 'users' => $users, 'data_extenso' => $data_extenso , 'photo_ambience' => $photo_ambience ]); 
      
        $pdf->setPaper('A4', 'report');  
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        // page_text(pos_horizontal,pos_vertical , texto , null , tamanho, cor_em_rgb)
               
        $canvas->page_text(530, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        
        return $pdf->stream();     

    }

    public function pdf_survey(Request $request, $id)
    {
        #  //Created in 2016-07-25 15:53 by Junior Oliveira
        //$survey = Survey::find($id);
       
        //ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300); 
        $survey = Survey::where('survey_id' , $id)->get();
        $users = DB::table('relation_survey_user')
                        ->join('survey', 'survey.survey_id' , '=' , 'relation_survey_user.relation_survey_user_id_survey')
                        ->join('users' , 'users.id' , '=' , 'relation_survey_user.relation_survey_user_id_user')
                        ->where('relation_survey_user.relation_survey_user_id_survey' , $id)->get();
                        
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $data_extenso = Survey::data_extenso();                
        $settings = DB::table('settings')->get();            
       
        $pdf = PDF::loadView('survey.report.view_survey',['survey' => $survey , 'settings' => $settings , 'users' => $users, 'data_extenso' => $data_extenso , 'photo_ambience' => '' ]); 
        $pdf->setPaper('A4', 'report');  
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        /*page_text(pos_horizontal,pos_vertical , texto , null , tamanho, cor_em_rgb)
        */       
        $canvas->page_text(530, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        
        return $pdf->stream();       
    }

    public function upload(Request $request)
    {
        # //Created in 2016-07-26 20:02 by Junior Oliveira
       
        if($request->ajax())
        {
            global $ambience , $id_survey, $tmp_name;
            $id_survey     = $request['ambience_id'];
            $ambience       = $request['ambience'];

            if($request['foto'] == 'normal'){
                $tipo = 'normal';
            }elseif($request['foto'] == '360'){
                $tipo = '360';
                //CRIANDO UM VARIAVEL PARA PREENCHELA COM O NOME DOS ARQUIVOS 360 PARA ENVIAR VIA EMAIL
                $files = array();
            }

            //CONTANDO O TOTAL
     
          try {
              
             $tot_array = count($_FILES["img_photo"]["name"]);
             
            for ($i=0; $i < $tot_array; $i++) { 
               
                $tmp_name = $_FILES["img_photo"]["tmp_name"][$i];
               
                // //PEGANDO A EXTENSAO DA CADA IMAGEM                
                $exp = explode(".", $_FILES["img_photo"]["name"][$i]);
                $extension = end($exp);
                // // //RENOMIANDO O ARQUIVO
                $name =  time(). '_'.Str::random(20).'.'.$extension;
 
                if($tipo == 'normal')
                {
                    //REDIMENSIONANDO IMAGEM   
                    //$image = Image::make($tmp_name)->resize(300,300)->save('public/dist/img/upload/vistoria/'. $name);
                    $uploadFile = 'dist/img/upload/vistoria/'. basename($name);   
                    move_uploaded_file($tmp_name, $uploadFile);
                    Survey::addFilesAmbience($ambience, $name, $id_survey, $tipo);   
                }
                elseif($tipo == '360'){
                   
                    //echo "arquivo ".$cont." - ".$name."<br>";
                    $uploadFile = 'dist/img/upload/vistoria/'. basename($name);   
                    move_uploaded_file($tmp_name, $uploadFile);
                    list($width, $height, $type, $attr) = getimagesize(url('dist/img/upload/vistoria/'.$name));
                    //CADASTRANDO AS INFORMAÇÕES SOBRE O ARQUIVO
                    $files_ambience = Survey::addFilesAmbience($ambience, $name, $id_survey, $tipo); 
                    //REGISTRANDO O TAMANHO ORIGINAL
                    Survey::addConfigFiles( $width, $height, $files_ambience);

                }
                            
           }          
            //notificando a todos os usuarios
          // Helpers::reg_not_all(null, Auth::user()->nick. " adicionou novas imagens na vistoria ".$id_survey);              
            return response()->json(['mensagem' => 'success']);


          } catch (Intervention\Image\Exception\NotReadableException $e) {

               return response()->json(['error' => $e->getMessage()]);

          }
         // return response()->json(['mensagem' => $name]);
        }
       

    }

    public function search_photo($id_survey)
    {
        # //Created in 2016-12-26 19:05 by Junior Oliveira
        $photo = DB::table('files_ambience')->where('files_ambience_id_survey' , $id_survey)->orderBy('created_at')->get();
        return response()->json($photo);

    }

    public function send_survey(Request $request)
    {
        # //Created in 2016-07-29 11:18 by Junior Oliveira
        $survey = Survey::find($request['id']);

        $email_envio = $request['email'];

      
        $email = Mail::send('emails.survey_send_email', ['survey' => $survey, 'email_envio' => $email_envio], function ($m) use ($survey, $email_envio) {
           
            $m->to($email_envio,'')->subject('Equipe Vistoria 360 - Proposta da Vistoria');
        });
        
        if($email){
            return redirect()->back()->with('mensagem', 'Vistoria enviada com sucesso para o e-mail');
        }else{
            return redirect()->back()->with('error_message', 'Ocorreu um erro no envio do e-mail. Tente novamente.');
        }
      
    }

    public function reply_survey($id)
    {
        # //Created in 2016-08-01 23:30 by Junior Oliveira
        $carbon = Carbon::now();
        $title_survey  =  'Replicando Vistoria';  
        //NOVO REGISTRO
        $survey_reply = Survey::find($id)->replicate();
        $survey_reply->survey_status = 'Rascunho';
        $survey_reply->survey_code = $survey_reply->survey_id.'/'.date('y');
        $survey_reply->save();
        $ambience       = DB::table('ambience')->get();

        //MESMA ROTINA PARA UPDATE - RELACIONA AS TABELAS VISTORIA, USUARIO NA TABELA RELAÇAO

        $survey_update = DB::table('relation_survey_user')
                        ->join('survey', 'survey.survey_id' , '=' , 'relation_survey_user.relation_survey_user_id_survey')
                        ->join('users' , 'users.id' , '=' , 'relation_survey_user.relation_survey_user_id_user')
                        ->where('relation_survey_user.relation_survey_user_id_survey' , $id)->get();

        
        $photo = DB::table('files_ambience')->where('files_ambience_id_survey' , '=' , $id)->get();

        global $new_photo;
        $new_photo = [];

        foreach ($photo as $value) {
            
           // echo $value->files_ambience_description_file."<br>";
            //echo $survey_reply->survey_id;
            $new_files = DB::table('files_ambience')->insert(
                            ['files_ambience_description_file' => $value->files_ambience_description_file,
                            'files_ambience_id_survey' => $survey_reply->survey_id,
                            'files_ambience_type' => $value->files_ambience_type ,
                            'created_at' => $carbon,
                            'files_ambience_id_ambience' => $value->files_ambience_id_ambience]
                        );
            

        }
        # code / DUPLICANDO REGISTRO RELATION_SURVEY_USER COM O ID DA VISTORIA DUPLICADA
        foreach ($survey_update as $id_rel) {
            # code...
            //METODO REPLICATE SÓ FUNCIONOU COM O MODEL E METODO FIND
            $new_rel = RelSurveyUser::find($id_rel->relation_survey_user_id)->replicate();
            //ALTERANDO O ID DA VISTORIA PARA O ID DA NOVA VISTORIA REPLICADA
            $new_rel->relation_survey_user_id_survey = $survey_reply->survey_id;
            $new_rel->save(); 
            
        }
           
        
        $id_survey =  $survey_reply->survey_id;
        
        DB::table('survey')
            ->where('survey_id', $id_survey)
            ->update(['survey_code' => $id_survey.'/'.date('y')]);
        /*ENVIANDO O OBJETO JA EXISTENTE PARA PREENCHER TODOS OS CAMPOS
        ENVIANDO O OBJETO RECEM CADASTRADO
        ENVIADO O TITULO PARA MUDAR O VALOR DO CAMPO
        */
        $history    = DB::table('history_survey')->insert(
                            ['history_survey_id_user' => Auth::user()->id, 'history_survey_action' => 'Replicou a vistoria '.$id, 
                            'history_survey_created' => Carbon::now(), 'history_survey_id_survey' =>  $survey_reply->survey_id]);

        //notificando a todos os usuarios
        Helpers::reg_not_all(null, Auth::user()->nick. " replicou a vistoria nº ".$id);
        return view('survey.update' , compact('survey_update' , 'survey_reply' , 'title_survey' , 'ambience', 'id_survey'));

    }

    public function add_ambience(Request $request)
    {
        Carbon::setLocale('pt_BR');
        # //Created in 2016-08-02 10:55 by Junior Oliveira 
        if($request->ajax())
        {
            //dd($request->all());
            $request['created_at'] = date('Y-m-d H:i:s');
            $request['updated_at'] = Carbon::now();
            
            $ambience = DB::table('ambience')->insert($request->all());

            if($ambience)
            {
                return response()->json(['mensagem' => 'success']);
            }else{

                return response()->json(['error' => 'erro ao cadastrar']);
            }
        }
    }

    public function all_ambience()
    {
        # code...
        $ambience_all = DB::table('ambience')->orderBy('ambience_name', 'ASC')->get();
        return response()->json($ambience_all);
    }
   
   public function delete_ambience($id)
   {
       # created 2016-11-22 17:04 by Junior Oliveira
    try {
       
        DB::table('ambience')->where('ambience_id' , '=', $id)->delete();
        return response()->json(['message' => 'success']);
    } catch (Exception $e) {
        return response($e->getMessage());
    }

   }

    public function update_aspect(Request $request)
    {
        #  # //Created in 2016-08-06 13:12 by Junior Oliveira .
        try {
            DB::table('settings')
            ->where('settings_aspect_general_active', 1)
            ->update(['settings_aspect_general' => $request['settings_aspect_general']]);
            return redirect('configuracao/conf-ascpectos-gerais')->with('mensagem', 'Aspectos Gerais alterado com sucesso');
        } catch (Exception $e) {
             return redirect('vistoria')->with('error_message', 'Ocorreu um erro, tente novamente');
        }

    }

   
    public function update_reservation(Request $request)
    {
        # //Created in 2016-08-07 10:27 by Junior Oliveira .
        try {
            DB::table('settings')
            ->where('settings_reservation_active', 1)
            ->update(['settings_reservation' => $request['settings_reservation']  , 'settings_id_user' => Auth::user()->id ]);
            return redirect('configuracao/conf-ressalva')->with('mensagem', 'Ressalva por Ambiente alterado com sucesso');
        
        } catch (Exception $e) {

             return redirect('vistoria')->with('error_message', 'Ocorreu um erro, tente novamente');
       
        }

    }

    
    public function update_provisions(Request $request)
    {
        # //Created in 2016-08-07 10:27 by Junior Oliveira .
        try {
            DB::table('settings')
            ->where('settings_provisions_active', 1)
            ->update(['settings_provisions' => $request['settings_provisions']]);
            return redirect('configuracao/conf-disposicoes')->with('mensagem', 'DISPOSIÇAO GERAL alterada com sucesso');
        
        } catch (Exception $e) {

             return redirect('vistoria')->with('error_message', 'Ocorreu um erro, tente novamente');
       
        }

    }

     public function update_keys(Request $request)
    {
        # //Created in 2016-12-12 15:56 by Junior Oliveira .
        try {
            DB::table('settings')
            ->where('settings_keys_active', 1)
            ->update(['settings_keys' => $request['settings_keys']]);
            return redirect('configuracao/conf-chaves')->with('mensagem', 'CHAVES alterada com sucesso');
        
        } catch (Exception $e) {

             return redirect('vistoria')->with('error_message', 'Ocorreu um erro, '.$e->getMessage().' tente novamente');
       
        }

    }

    public function download($id)
    {
        # Created 2016-08-22 12:35 by Junior Oliveira
        //PARA UPLOAD DE AMBIENTE
        $id_survey  = base64_decode($id);
        //PARA MODAL DE AMBIENTE
        $ambience       = DB::table('ambience')->orderBy('ambience_name')->get(); 
        $title_survey   =  'Editar Vistoria';

        $files_ambience = FilesAmbience::where('files_ambience_id_survey' , $id_survey)->get();
       // return $files_ambience;

        return view('survey.download' , compact('title_survey' , 'id_survey' , 'ambience' , 'files_ambience'));
       
    }
    
    public function deleteImageAmbience(Request $request)
    {
        if($request->ajax())
        {
           try {
               FilesAmbience::where('files_ambience_id' , $request['files_ambience_id'] )->delete();
               return response()->json(['success' , 'sucess']);
           } catch (Exception $e) {
                return response()->json(['error' , 'error']);
           }
        }

    }
    public function download_file($name_file)
    {
        # code...Created 2016-08-22 14:33 by Junior Oliveira
        //return response()->download(url('/public/dist/img/upload/vistoria/'.$name_file));
        return response()->download(dirname(dirname(dirname(dirname(__DIR__)))).'/public/dist/img/upload/vistoria/'.$name_file);
    }

    public function view_360($id)
    {
        # code...
        $id_survey  = base64_decode($id);
       // $files      = DB::table('files_ambience')->where('files_ambience_id_survey' , $id_survey);
        $file      = DB::table('survey')
                    ->join('files_ambience' ,'files_ambience.files_ambience_id_survey' , '=', 'survey.survey_id')
                    ->where([
                        ['survey.survey_id' , '=', $id_survey ],
                        ['files_ambience_type' , '=' , '360']
                        ])->get();

       
        return view('survey.view' , compact('id_survey' , 'file' ));
    }

    public function view_360_full($name)
    {
		return view('survey.upload.vistoria.index' , compact('name'));
    }

    public function settings()
    {
        # Created 2016-10-17 16:41 by Junior Oliveira
        return view('survey.settings');
    }

    public function history_survey($id)
    {
        # Created 2016-10-31 21:21 by Junior Oliveira
        if(isset($id)){

           $id_survey = base64_decode($id);
            $history = DB::table('history_survey')
                        ->join('users', 'users.id' , '=' , 'history_survey.history_survey_id_user')
                        ->where('history_survey.history_survey_id_survey' , $id_survey)
                        ->orderBy('history_survey_date', 'desc')->get();

            if(empty($history)){
                return redirect('vistoria')->with('error_message', 'Não há histórico para essa vistoria');
            }else{
                return view('survey.history' , compact('history'));
            }  

            return response()->json($history);
        }
    }

    public function add_locator(Request $request)
    {
        # 2016-11-09 20:19 by Junior Oliveira
        if($request->ajax()){
            //REGISTRANDO USUÁRIO
            $campo_user = array($request['name'], $request['email'], $request['password']);
            //A POSIÇÃO PASSWORD DO ARRAY REQUEST TRAGO O VALOR DE CPF DO USUARIO
            $reg_user = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request['password'] , $request['relation_survey_user_type']);

            return response()->json(['message' => 'success']);
        }
    }
   
   public function add_loc(Request $request)
    {
        # 2016-11-09 20:19 by Junior Oliveira
        if($request->ajax()){
            //REGISTRANDO USUÁRIO
            dd($request->all());
            // $campo_user = array($request['name'], $request['email'], $request['password']);
            // //A POSIÇÃO PASSWORD DO ARRAY REQUEST TRAGO O VALOR DE CPF DO USUARIO
            // $reg_user = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request['password'] , $request['relation_survey_user_type']);

            // return response()->json(['message' => 'success']);
        }
    }

    public function delete_user_survey($id_user, $id_survey)
    {
        # code...

        try {
            User::destroy($id_user);
            DB::table('relation_survey_user')->where('relation_survey_user_id_user' , '=', $id_user)->delete();
            
            return redirect('vistoria/editar/'.base64_encode($id_survey))
                    ->with(['mensagem' => 'Usuário excluido com sucesso']);
                    
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Erro: '.$g->getMessage()]);
        }
        
    }

    public function redirect()
    {
        return view('survey.redirect');
    }





}
