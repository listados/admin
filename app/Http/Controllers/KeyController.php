<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Http\Controllers\Controller;
use Exception, PDF, DB;
use AdminEspindola\ControlKey;
use AdminEspindola\Key;
use AdminEspindola\Immobile;
use Carbon\Carbon;
use Datatables;
use AdminEspindola\Reserve;
use AdminEspindola\Client;
use AdminEspindola\Helpers;
use AdminEspindola\ReportDelivery;
use Auth;
use RedirectResponse, Redirect;


class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //created 2017-08-04 by Excellence Soft
        $carbon = Carbon::now();
        if($request->ajax()){
          
         $key = Key::where('keys_code' , $request['keys_code'])->get();         
        //VALIDANDO CODE DA CHAVE
        if($request['keys_code'] == ""){           
            return response()->json(['title' => 'Erro' , 'text' => 'Campo da chave deve ser preenchido' , 'styling' => 'bootstrap3' , 'type' => 'error']);
        }
        elseif(count($key) > 0)
        {
            return response()->json(['title' => 'Erro' , 'text' => 'Já existe uma chave cadastrada' , 'styling' => 'bootstrap3' , 'type' => 'error']);             
        }else{

            try {

                $request->except('_token');
                $request['keys_status'] = "Disponível";
                $request['keys_devolution'] = "0";

                Key::create($request->all());
                        
                return response()->json(['success' , 'Sucesso']);

            } catch (Exception $e) {

                return response()->json(['title' => 'Erro' , 'text' => 'Ocorreu um erro de parametros' , 'styling' => 'bootstrap3' , 'type' => 'error']);

            }
        }

    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $key = Key::where('keys_code', '=',$id)->get();

         if(count($key) == 0)
         {
            //return response()->json(['title' => 'Sucesso' , 'text' => 'Nao existe chave' , 'styling' => 'bootstrap3' , 'type' => 'success']);
            return response()->json(['message' => 'success']);
        }else{
            return response()->json(['title' => 'Erro' , 'text' => 'Já existe uma chave' , 'styling' => 'bootstrap3' , 'type' => 'error']);
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //create 2017-08-07 by Excellence Soft
        //DB::connection()->enableQueryLog();
        $key = DB::table('keys')
        ->join('control_keys', 'control_keys.control_keys_code_key', '=' , 'keys.keys_code')
        ->join('users' , 'users.id' , '=' , 'control_keys.control_keys_id_user')
        ->where([
                ['keys.keys_id' ,'=', $id],
                ['keys.keys_devolution', '=' , 0]
            ])->get();
        //return DB::getQueryLog();
        return response()->json($key);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        if($request->ajax())
        {
            $request['reserves_date_devolution'] = null;
            $carbon = Carbon::now();

            try {

                //ALTERANDO O STATUS E CONFIRMANDO RECEBIMENTO
                Key::where('keys_id' , $id)->update(['keys_status' => 'Disponível' , 'keys_devolution' => 1]);
                $key = Key::where('keys_id' , $id)->get();
                //ATUALIZADO A RESERVA
                DB::enableQueryLog();
                $reserve = Reserve::where([
                                    ['reserves_id_key' , '=' , $id]
                                    ])->update(['reserves_date_return' => $carbon , 'updated_at' => $carbon]);  

                $id_reserv = Reserve::where([
                                    ['reserves_id_key' , '=' , $id],
                                    ['reserves_devolution' , '=' ,0]    
                                    ])->get();               
                //CONTROLE DE CHAVES - COLOCANDO A DATA DE RETORNO
                //ControlKey::where('control_keys_id' , $request['control_keys_id'])->update(['control_keys_date_return' => $carbon]);
                //ALTERANDO E CONFIRMANDO O RECEBIMENTO NA TABELA DE REFERENCIAS
               // DB::table('references_evaluation_immobile')->update(['references_evaluation_immobile_devolution' => 1]);
                return  response()->json([
                            'title' => 'Sucesso' , 
                            'text' => 'Recebimento confirmado com sucesso' , 
                            'styling' => 'fontawesome',
                            'type' => 'success',
                            'icon' => 'true',
                            'animation' => 'fade',
                            'delay' => 5000,
                            'animate_speed' => 'slow',
                            'reserves_id' => $id_reserv[0]->reserves_id
                        ]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        try {
            $key = Key::where('keys_id' , $request['keys_id'])->delete();
            return response()->json(['message' , 'success']);
            //return redirect()->back()->with('mensagem' , 'Chave excluída com sucesso');
        } catch (Exception $e) {
            return redirect()->back()->with('error_message' , 'Ocorreu um erro');
        }

    }

    public function search(Request $request)
    {
        # CREATE 2017-09-21 BY EXCELLENCE SOFT
        $carbon = Carbon::now();
        if($request->ajax())
        {
          
            $key = DB::table('reserve')
            ->join('clients', 'reserve.reserves_id_client', '=', 'clients.clients_id')
            ->join('keys' , 'reserve.reserves_id_key' , '=' , 'keys.keys_id')
            ->where('reserves_ref_immobile' , $request['code_key_immobile'])
            ->orWhere('reserves_code_key', $request['code_key_immobile']);
            
          
                //return response()->json($key);
            return Datatables::of($key)
            ->editColumn('reserves_date_exit', function ($key) {
                return date('d/m/Y H:i:s' , strtotime($key->reserves_date_exit));
            })
            ->editColumn('reserves_date_devolution', function ($key) {
                return date('d/m/Y H:i:s' , strtotime($key->reserves_date_devolution));
            })
            ->editColumn('reserves_id_client', function($key){
               
                return $key->clients_name;
            })
            ->addColumn('action', function ($key) {
                return '<a href="#" onclick="modal_confirm_reserve('.$key->reserves_id.')"  class="btn btn-xs" title="Imprimir comprovante "><i class="fa fa-print" aria-hidden="true"></i></a>
                <a href="#" onclick="modal_edit_key(' . $key->reserves_id . ')" class="btn btn-xs btn-default"  title="Receber Chaves"><i class="fa fa-retweet" aria-hidden="true"></i></a>';
            })->orderColumn('reserve.reserve_id', 'desc')
            ->make(true);            
        }
    }

    public function getKey($code_immobile)
    {
        $key = Key::where('keys_cod_immobile' , $code_immobile)->get();
        return response()->json($key);
    }


    public function receiptPdf(Request $request)
    {
     
        ini_set('memory_limit', '128M');
        ob_start();
        $reserve    = Reserve::where('reserves_id' , $request->reserves_id)->get();   
        $immobile   = Immobile::where('immobiles_code' , $reserve[0]->reserves_ref_immobile)->get(); 
        $key        = Key::where('keys_id' , $reserve[0]->reserves_id_key)->get();  
        $client     = Client::where('clients_id' ,$reserve[0]->reserves_id_client )->get();        
        $phone      = DB::table('phone')->where('phone_id_client' , $client[0]->clients_id)->get();        
        $pdf        = PDF::loadView('key.report.receipt', compact('key' , 'immobile' , 'reserve' , 'client' , 'phone'));
        $pdf->setPaper('A4', 'landscape');
        $pdf->output();
        return $pdf->stream();       
        
    }

    public function updateCode(Request $request)
    {
        if($request->ajax())
        {
            try {
               $key = Key::where('keys_id' , $request['keys_id'])->update(['keys_cod_immobile' => $request['keys_cod_immobile']]);
               // dd($key);
               return response()->json(['message', 'success']);
               
            }catch (Exception $e) {
               return $e->getMessage();
            }
        }
        
    }

    public function createReserve(Request $request)
    {
        if($request->ajax())
        {
            date_default_timezone_set('America/Fortaleza');
            /*COMUM PARA RESERVA E VISITA*/
            //CAPTURANDO AS HORAS E MINUTOS DOS CAMPOS        
            $seg1 = substr($request['reserves_date_exit'], 11, 16);
            $seg2 = substr($request['reserves_date_devolution'], 11, 16);
            //FORMATANDO PARA DATA AMERICA
            $request['reserves_date_exit']          = Helpers::DataBRtoMySQL($request['reserves_date_exit']);
            $request['reserves_date_devolution']    = Helpers::DataBRtoMySQL($request['reserves_date_devolution']);
            //CONCATENANDO NOVO FORMATO COM HORA COMPLETA
            $request['reserves_date_exit']          .= " " . $seg1 . ":00";
            $request['reserves_date_devolution']    .= " " . $seg2 . ":00";
            //$request['selectCodeKey'] valor do select do modal reserva de chaves
            $request['reserves_code_key']           = $request['selectCodeKey'];

             //LOCALIZANDO O CLIENTE
            $phone = DB::table('phone')->where('phone_number' , $request['control_keys_visitor_phone_two'])->get();
            if(count($phone) > 0)
            {
                $id_cliente = $phone[0]->phone_id_client;
            }else{
                $id_cliente = null;
            }
            $client = Client::find($id_cliente);
            //SE NÃO EXISTIR O CLIENTE, REALIZA O CADASTRO
            if( $client == null)
            {
                $client_request['clients_option']   = "Interessado";
                $client_request['clients_status']   = "Ativo";
                $client_request['clients_name']     = $request['control_keys_visitor_name'];
                $client_request['clients_email']    = $request['control_keys_visitor_email'];
                $client_request['clients_id_user']  = Auth::user()->id;
                $client_request['clients_type']     = "Pessoa Física";
                $client_request['clients_cpf']      = $request['control_keys_cpf'];
                $client_create = Client::create($client_request);
                $client = Client::find($client_create->clients_id);

            }

            //FUNCAO PARA REGISTRAR O FONE DO CLIENTE - CRIANDO ARRAY PARA PASSAR O PARAMETRO NA FUNCAO
            $request_phone      = [];
            $request_phone[0]   = $request['control_keys_visitor_phone_one'];
            $request_phone[1]   = $request['control_keys_visitor_phone_two'];
            Helpers::register_phone_client($request_phone , $client->clients_id); 
            
            /* PREENCHENDO O ARRAY PARA REGISTRAR OS DADOS DO DELIVERY */
            $array_delivery['report_deliveries_id_delivery'] = $request['reserves_id_delivery'];
            $array_delivery['report_deliveries_value'] = $request['value_delivery'];
            $array_delivery['report_deliveries_id_user'] = $request['reserves_id_user'];
            $array_delivery['report_deliveries_code_immobile'] = $request['reserves_ref_immobile'];
            $array_delivery['created_at'] = Carbon::now();
            $array_delivery['report_deliveries_id_client'] = $client->clients_id;
            if( $request['reserves_id_delivery'] == "Não")
            {
               //$request['reserves_id_delivery'] = 0;
               $array_delivery['reserves_id_delivery'] = 0;
            }  
            $delivery = ReportDelivery::create($array_delivery);
                //EXCLUINDO A VARIÁVEL
                unset($request['value_delivery']);
                unset($request['keys_type']);
                unset($request['keys_ps']);
                unset($request['selectCodeKey']);

            //RESERVA           
            $key = Key::where('keys_code', $request['reserves_code_key'])->get();
            
            $request['reserves_id_client'] = $client->clients_id;//ID DO CLIENTE
            $request['reserves_id_key'] = $key[0]->keys_id;// ID DA CHAVE
            // return "id cliente: ".$request['reserves_id_client'].' id key= '.$key[0]->keys_id.' id delivery= '.$request['reserves_id_delivery'];
            $request['reserves_devolution'] = 0;
           
            if($request['reserve_finality'] == "reserva")
            {
            Key::where('keys_code', $request['reserves_code_key'])->update(['keys_status' => 'Reservado', 'keys_type' => 'Reserva' , 'keys_devolution' => 0]);       
            $request['reserves_status'] = "reserva";
            $reserve = Reserve::create($request->all());
            return response()->json(['reserve_finality' =>'reserva', 'reserves_id' => $reserve->reserves_id]);
                
                
            }//FIM RESERVA            
            else if($request['reserve_finality'] == "visita")
            {   
            Key::where('keys_code', $request['reserves_code_key'])->update(['keys_status' => 'Pendente', 'keys_type' => 'Visita', 'keys_devolution' => 0]);       
            $request['reserves_status'] = "Visita";
            $reserve = Reserve::create($request->all());
            return response()->json(['reserve_finality' =>'visita', 'reserves_id' => $reserve->reserves_id]);
            }
        }
        
           
    }

    public function verifyFone(Request $request)
    {
        if($request->ajax())
        {
//DB::enableQueryLog();
////return DB::getQueryLog();
            //BUSCANDO DADOS
            $phone_client = DB::table('phone')
            ->join('clients', 'phone.phone_id_client', '=', 'clients.clients_id')            
            ->where('phone.phone_number' , '=' , $request['keys_visitor_phone_two'])           
            ->get();
            //SE EXISTIR O CADASTRO, REALIZA A ROTINA
            if(count($phone_client) > 0)
            {   //CONSULTANDO TODOS DOS TELEFONES DE UM CLIENTE
                $phone = DB::table('phone')->where('phone_id_client', $phone_client[0]->clients_id)->get();
                //CONSTRUINDO O ARRAY PARA ENVIAR AS INFORMAÇÕES
                $resul_client_phone['phone_mobile'] = $request['keys_visitor_phone_two'];
                $resul_client_phone['client_name']  = $phone_client[0]->clients_name;
                $resul_client_phone['client_cpf']   = $phone_client[0]->clients_cpf;
                $resul_client_phone['client_email'] = $phone_client[0]->clients_email;
                $resul_client_phone['phone_fixed']  = $phone[0]->phone_number;
                return response()->json($resul_client_phone);//ENVIANDO,

            }else{
                //SE NÃO HOUVER DADOS, ENTAO ENVIA VAZIO PARA LIBERAR OS CAMPOS PARA CADASTRO
                $resul_client_phone = [];
                return response()->json($resul_client_phone);
            }   
           
        }
    }
    

}
