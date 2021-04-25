<?php
namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Http\Controllers\Controller;
use Exception;
use AdminEspindola\ControlKey;
use AdminEspindola\Immobile;
use AdminEspindola\Key;
use AdminEspindola\Delivery;
use AdminEspindola\Helpers;
use AdminEspindola\Client;
use AdminEspindola\ReportDelivery;
use PDF, DB, Auth;
use Carbon\Carbon;
use RedirectResponse, Redirect;
use Datatables;
use AdminEspindola\Evaluation;
use AdminEspindola\Reserve;

class ControlKeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     *         //DB::enableQueryLog();
     *  //return  DB::getQueryLog();
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $immobile = Immobile::where('immobiles_status' , 'Ativo')->pluck('immobiles_code','immobiles_code');
        //$delivery = Delivery::select('deliveries_id', 'deliveries_name')->get();
        $delivery = Delivery::all()->pluck('deliveries_name','deliveries_id');
        $carbon = Carbon::now();
        return view('key.index' , compact('immobile' , 'delivery' , 'carbon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request->all());
        $carbon = Carbon::now();
        //$delivery = Delivery::all()->toArray();
        $delivery = Delivery::select('deliveries_id', 'deliveries_name')->get();

        $immobile = DB::table('immobiles')->where('immobiles_code', '=', $request['immobile'])->get();
        return view('key.create', compact('carbon', 'immobile', 'delivery'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Fortaleza');

        
        /* PREENCHENDO O ARRAY PARA REGISTRAR OS DADOS DO DELIVERY*/
        $array_delivery['report_deliveries_id_delivery'] = $request['reserves_id_delivery'];
        $array_delivery['report_deliveries_value'] = $request['value_delivery'];
        $array_delivery['report_deliveries_id_user'] = $request['reserves_id_user'];
        $array_delivery['report_deliveries_code_immobile'] = $request['reserves_ref_immobile'];
        if( $request['reserves_id_delivery'] == "Não")
        {
           $request['reserves_id_delivery'] = 0;
       }

        //EXCLUINDO A INDICE DO ARRAY
       unset($request['value_delivery']);
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

        //VALOR VINDO DO PARAMETRO DA FUNCAO ONCLICK, PARA IDENTIFICAR SE É RESERVA OU MANUTENÇÃO
        
       switch ($request['reserve_finality']) {
        case 'reserva':
        $keys_type  = "Reserva";
        $keys_ps    = $request['keys_ps'];
        break;            
        case 'manutencao':
        $keys_type  = "Manutenção";
        $keys_ps    = $request['keys_ps'];
        break; 
        case 'visita':
        $keys_type  = "Visita";
        $keys_ps    = $request['keys_ps'];
        break;           
        default:
        $keys_type = "Reserva";
        $keys_ps   = $request['keys_ps'];
        break;
    }
        //EXCLUINDO A VARIÁVEL
    unset($request['keys_type']);
    unset($request['keys_ps']);
    unset($request['selectCodeKey']);
    /* -- REGISTRANDO O CLIENTE -- */
        /* DADOS PARA CADASTRAR O CLIENTE
            SERÁ FEITO UMA VERIFICAÇÃO SE O EMAIL JÁ EXISTE
            SE EXISTIR FARÁ UM UPDATE CASO CONTRARIO REGISTRA 
            UM NOVO CLIENTE
         */
       
            $client = Client::where('clients_email' , $request['control_keys_visitor_email'])->get();

            if( count($client) == 0)
            {
                $client_request['clients_option']   = "Interessado";
                $client_request['clients_status']   = "Ativo";
                $client_request['clients_name']     = $request['control_keys_visitor_name'];
                $client_request['clients_email']    = $request['control_keys_visitor_email'];
                $client_request['clients_id_user']  = Auth::user()->id;
                $client_request['clients_type']     = "Pessoa Física";
                $client_request['clients_cpf']      = $request['control_keys_cpf'];
                $client_create = Client::create($client_request);
                $client = Client::find($client_create->client_id);

            }
           
            
            //FUNCAO PARA REGISTRAR O FONE DO CLIENTE - CRIANDO ARRAY PARA PASSAR O PARAMETRO NA FUNCAO
            $request_phone      = [];
            $request_phone[0]   = $request['control_keys_visitor_phone_one'];
            $request_phone[1]   = $request['control_keys_visitor_phone_two'];
            //dump($client[0]->clients_id);
            
            try
            {
                //UM FOR PARA CADASTRAR OS FONES.
                for ($i=0; $i < count($request_phone); $i++) { 
                 Helpers::register_phone_client($request_phone , $client[0]->clients_id); 
                }
            
            
            Key::where('keys_code', $request['reserves_code_key'])->update(['keys_status' => 'Pendente', 'keys_type' => $keys_type , 'keys_ps' => $keys_ps , 'keys_devolution' => 0]);     
            
            //RESERVA           
            $key = Key::where('keys_code', $request['reserves_code_key'])->get();
            
            $request['reserves_id_client'] = $client[0]->clients_id;//ID DO CLIENTE
            $request['reserves_id_key'] = $key[0]->keys_id;// ID DA CHAVE
            // return "id cliente: ".$request['reserves_id_client'].' id key= '.$key[0]->keys_id.' id delivery= '.$request['reserves_id_delivery'];
            $request['reserves_devolution'] = 0;
            $request['reserves_status'] = "Pendente";
            $reserve = Reserve::create($request->all());
           
            //RECEBENDO O ID DO CONTROLER DE CHAVES
            $array_delivery['report_deliveries_id_control'] = $reserve->reserve_id;
            $report_delivery = ReportDelivery::create($array_delivery);
           
            if ($keys_type == "Visita") {
                return response()->json($reserve);
                
            }else{
                return response()->json(['sucess' , 'success']);
            }
            
        }
        catch(Exception $e)
        {
            return dd($e->getMessage());
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        date_default_timezone_set('America/Fortaleza');
        $carbon  = Carbon::now();
        
        $reserve = DB::table('reserve')
            ->join('keys', 'reserve.reserves_id_key', '=', 'keys.keys_id')->get();
            $count = 0;
            // foreach ($reserve as $value_reserve) {
            //    // echo $value_reserve->reserves_id;
            //   //  echo $br;
            //     //if( $value_reserve->reserves_date_devolution < $carbon && $value_reserve->reserves_date_return == "0000-00-00 00:00:00" )
            //     if($value_reserve->reserves_date_return == "0000-00-00 00:00:00")
            //     {
            //         //echo $value_reserve->reserves_code_key." = Atrasad0";
            //         //echo "id key: ".$value_reserve->keys_id;
            //         DB::table('keys')->where('keys_id' , $value_reserve->keys_id)->update(['keys_status' => "Pendente", 'keys_devolution' => 0]);
            //     }
            // }    
           
        //FILTRANDO DATA NO CONTROLE  
        $keys = Key::all();
        return Datatables::of($keys)->setRowClass(function ($key)
        {
            if ($key->keys_status == 'Atrasado')
            {

                return 'delay';
            }
        })->addColumn('action', function ($keys)
        {
           if ($keys->keys_status == 'Atrasado' || $keys->keys_status == 'Pendente')
           {
            $disabled = 'disabled';
            return '<a href="#" onclick="modal_edit_key(' . $keys->keys_id . ')" class="btn btn-xs btn-primary"  title="Receber Chaves"><i class="fa fa-retweet" aria-hidden="true"></i></a>
            <a href="#" onclick="modal_delete_key(' . $keys->keys_id . ')" class="btn btn-xs btn-danger"  title="Excluir"><i class="fa fa-trash"></i></a>
            <a href="#"  class="btn btn-xs btn-default ' . $disabled . '"  title="Novo"><i class="fa fa-plus"></i></a>
            <a href="#" onclick="modal_update_key(' . $keys->keys_id . ')" class="btn btn-xs ' . $disabled . '"  title="Editar Código da chaves"><i class="fa fa-edit"></i></a>';
            }
        else
        {

            $disabled = '';
            return '<a href="#" onclick="modal_edit_key(' . $keys->keys_id . ')" class="btn btn-xs btn-default"  title="Receber Chavessssss"><i class="fa fa-retweet" aria-hidden="true"></i></a>
            <a href="#" onclick="modal_delete_key(' . $keys->keys_id . ')" class="btn btn-xs btn-danger"  title="Excluir"><i class="fa fa-trash"></i></a>
            <a href="#" onclick="modalReserveKey('."'".$keys->keys_cod_immobile."'".', '."'reserva'".')" class="btn btn-xs btn-default ' . $disabled . '"  title="Nova Reserva"><i class="fa fa-plus"></i></a>
            <a href="#" onclick="modal_update_key('."'".$keys->keys_id."'".', '."'".$keys->keys_cod_immobile."'".')" class="btn btn-xs btn-default"  title="Editar Código da chaves"><i class="fa fa-edit"></i></a>';

        };
    })->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
      dd($request->all());

        if (empty($request['control_keys_date_devolution']))
        {
            $dt_dev = Reserve::where('reserves_id', $id)->get();
            dd($request->all());

            $request['control_keys_date_devolution'] = $dt_dev[0]->control_keys_date_devolution;

        }
        else
        {
            $seg2 = substr($request['control_keys_date_devolution'], 11, 16);
            $request['control_keys_date_devolution'] = Helpers::DataBRtoMySQL($request['control_keys_date_devolution']);
            $request['control_keys_date_devolution'] .= " " . $seg2 . ":00";

        }

        $pdf_chave = 'false';
        $pdf_autor = '&auto=false';
        $pdf_deliv = '&delivery=false';
        //LOOP PARA SABER QUANTOS RECIBOS E QUAIS SERAO IMPRESSO
        foreach ($request['receipt'] as $key => $value)
        {
            if ($value == 'chave')
            {
                $pdf_chave = 'true';

            }
            if ($value == 'autorizacao')
            {
                $pdf_autor = '&auto=true';

            }
            if ($value == 'delivery')
            {
                $pdf_deliv = '&delivery=true';

            }

        }

        //EXCLUINDO O ARRAY
        unset($request['receipt']);

        /* PREENCHENDO O ARRAY PARA REGISTRAR OS DADOS DO DELIVERY*/
        $array_delivery['report_deliveries_id_delivery'] = $request['control_keys_id_delivery'];
        $array_delivery['report_deliveries_value'] = $request['value_delivery'];
        $array_delivery['report_deliveries_id_user'] = $request['control_keys_id_user'];

        //EXCLUINDO A INDICE DO ARRAY
        unset($request['value_delivery']);
        //CAPTURANDO AS HORAS E MINUTOS DOS CAMPOS
        $seg1 = substr($request['control_keys_date_exit'], 11, 16);
        
        //FORMATANDO PARA DATA AMERICA
        $request['control_keys_date_exit'] = Helpers::DataBRtoMySQL($request['control_keys_date_exit']);

        //CONCATENANDO NOVO FORMATO COM HORA COMPLETA
        $request['control_keys_date_exit'] .= " " . $seg1 . ":00";
        
        $request['control_keys_code_key'] = $request['control_keys_key_number'];

        $input = $request->all();
        $input = $request->except(['_method', '_token']);

        //dd($request['control_keys_date_devolution']);
        // DB::connection()->enableQueryLog();
        $controlKey = ControlKey::where('control_keys_id', $id)->update($input);
        //return  DB::getQueryLog();
        
        ReportDelivery::where('report_deliveries_id_control', $id)->update($array_delivery);

        Key::where('keys_cod_immobile', '=', $request['control_keys_ref_immobile'])
        ->orWhere('keys_code' , '=' , $request['control_keys_key_number'])
        ->update(['keys_status' => 'Pendente', 'keys_type' => 'Visita']);


        return redirect('chaves/receipt/' . $id . '?auto=true&key=true&delivery=true');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }


    public function search($code)
    {
        //$code_key = Key::where('keys_code' , $code);

    }
}

