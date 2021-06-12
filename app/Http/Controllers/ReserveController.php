<?php
/*

Author:  Excellence Soft - Junior Olivera
Controller para as reservas das chaves

 */
namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Http\Controllers\Controller;
use AdminEspindola\Reserve;
use AdminEspindola\Immobile;
use AdminEspindola\Key;
use Carbon\Carbon;
use AdminEspindola\Delivery;
use DB;
use Datatables;

class ReserveController extends Controller
{
    
    public function __construct()
    {
        date_default_timezone_set('America/Fortaleza');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('evaluation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $immobile = Immobile::where('immobiles_code',$id)->get();
        $delivery = Delivery::all()->pluck('deliveries_name','deliveries_id');
        //$delivery = Delivery::all();
        $carbon = Carbon::now();
        $key = Key::where('keys_cod_immobile', $id)->get();
        return view('key.edit', compact('key', 'delivery', 'carbon', 'immobile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reserve =DB::table('reserve')
            ->join('keys', 'reserve.reserves_id_key', '=', 'keys.keys_id')
            ->join('users', 'reserve.reserves_id_user' , '=' , 'users.id')
            ->where('reserve.reserves_id' , '=' , $id)
            ->get();

        return response()->json($reserve);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //created 2017-12-12 10:37
       
       // $reserve = Reserve::where('reserves_id_key' , $id)->get();

        // $value_delivery = DB::table('control_keys')
        //     ->join('report_deliveries', 'report_deliveries.report_deliveries_id_delivery', '=', 'control_keys.control_keys_id_delivery')
        // ->where('report_deliveries.report_deliveries_id_control', '=',$control_key[0]->control_keys_id )
        // ->get();    

        //return view('key.edit', compact('carbon', 'delivery', 'immobile', 'control_key' , 'value_delivery'));
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
        //return $request->all();
        $request['reserves_status'] = "Concluído";
        $request['reserves_devolution'] = 1;
        $request['reserves_date_return'] = Carbon::now();
        $input = $request->all();
        $input = $request->except('_token');        

        DB::enableQueryLog();
        $reserve_up = Reserve::where('reserves_id' , $id)->update($input);
        return DB::getQueryLog();
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

    public function search(Request $request)
    {
        # 2017-12-14
        //return $request->all();

        //$reserve = Reserve::where('reserves_code_key' , $request['reserves_ref_immobile']);

        $reserve = DB::table('reserve')
            ->join('clients', 'reserve.reserves_id_client', '=', 'clients.clients_id')
            ->select('clients.*', 'reserve.created_at as date_evaluation', 'reserve.*')
            ->where('reserves_ref_immobile' , '=' , $request['reserves_ref_immobile']);
            
        return Datatables::of($reserve)
                ->editColumn('date_evaluation' ,  function($reserve) {
                    return date('d/m/Y' , strtotime($reserve->date_evaluation));
                })
                ->editColumn('reserves_conservation', function($reserve){
                    return "<b>Visitado:</b> ".$reserve->reserves_visited. ' , <b>Interessou:</b> '.$reserve->reserves_interested.' , <b>Valor:</b> '.$reserve->reserves_value_immobile.' , <b>Conservação:</b> '.$reserve->reserves_conservation.' , <b>Localização:</b> '.$reserve->reserves_location.' , <b>Feedback:</b> '.$reserve->reserves_feedback;

                })
            ->make(true); 
    }
}
