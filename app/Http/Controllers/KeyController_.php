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
                                    ])->update(['reserves_date_return' => $carbon , 'reserves_date_devolution' => '0000-00-00', 'updated_at' => $carbon]);  

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
            //return $request['code_key_immobile'];

            $key = Reserve::where('reserves_ref_immobile' , $request['code_key_immobile'])
            ->orWhere('reserves_code_key', $request['code_key_immobile'])->get();


                //return response()->json($key);
            return Datatables::of($key)
            ->editColumn('reserves_date_exit', function ($key) {
                return date('d/m/Y H:i:s' , strtotime($key->reserves_date_exit));
            })
            ->editColumn('reserves_date_devolution', function ($key) {
                return date('d/m/Y H:i:s' , strtotime($key->reserves_date_exit));
            })
            ->addColumn('action', function ($key) {
                return '<a href="'.url('chaves/'.$key->reserves_ref_immobile.'/edit').'"  class="btn btn-xs" title="Editar Reserva">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a href="'.url('/chaves/receipt/'.$key->reserves_id.'/?key=true&auto=true&delivery=true').'" onclick="modal_confirm_reserve('.$key->reserves_id.')"  class="btn btn-xs" title="Imprimir comprovante dessa reserva" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>';
            })
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
        ob_start();''

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
               Key::where('keys_id' , $request['keys_id'])->update(['keys_code' => $request['keys_code']]);
               return response()->json(['message', 'success']);
           } catch (Exception $e) {
               return $e->getMessage();
           }
        }
        
    }

}
