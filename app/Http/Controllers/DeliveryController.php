<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Http\Controllers\Controller;
use Exception, DB;
use AdminEspindola\Delivery;
use AdminEspindola\Helpers;
use Datatables;
use Carbon\Carbon;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create 2017-09-09 by Excellence Soft
       return view('delivery.index');
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
     return view('delivery.create');

 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create 2017-09-09 by Excellence Soft
        if($request->ajax())
        {
            try {
             Delivery::create($request->all());
             return response()->json(['message' , 'sucess']);
             } catch (Exception $e) {
                return response()->json(['message' , 'error']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery = Delivery::find($id);
        return response()->json($delivery);
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
        try {
          $input = $request->all();
          $input = $request->except('_token');
          Delivery::where('deliveries_id' , $id)->update($input); 
          return response()->json(['success' , 'success']);
      } catch (Exception $e) {
        return response()->json(['error' , 'erro']);
        
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        try {
            Delivery::where('deliveries_id' , $id)->delete();
            return redirect()->back()->with('mensagem' , 'Despachante excluido com sucesso');
        } catch (Exception $e) {
            
            return redirect()->back()->with('error' , 'Ocorreu o erro: '.$e->getMessage());
        }
        
    }

    public function getDelivery()
    {
        # create 2017-09-09 by Excellence Soft
        $delivery = Delivery::select(['deliveries_id', 'deliveries_name', 'deliveries_phone', 'deliveries_mobile' , 'deliveries_cpf']);
       // return Datatables::of($delivery)->make();
        
        return Datatables::of($delivery)
        ->addColumn('action', function ($delivery) {
            
            return '<a href="#" onclick="edit_delivery('.$delivery->deliveries_id.')" class="btn btn-xs btn-primary" title="Editar Despachante"><i class="glyphicon glyphicon-edit"></i></a>
            <a href="#" onclick="modal_delete_ajax('.$delivery->deliveries_id.')" class="btn btn-xs btn-danger" title="Excluir Despachante"><i class="glyphicon glyphicon-trash"></i></a>';
        })->make(true);
    }

    public function getReportSintetic(Request $request)
    {
        
        if($request['type_delivery_report'] == 0){

            $carbon = Carbon::now();
            $month  = $request['month_delivery'];
            $year   = $request['year_delivery'];
            //dump($month);
           // dump($year);
            $id_delivery = $request['report_deliveries_id_delivery'];

           //DB::connection()->enableQueryLog();
            $delivery =  DB::table('deliveries')
            ->join('report_deliveries', 'deliveries.deliveries_id', '=', 'report_deliveries.report_deliveries_id_delivery')
            ->select('deliveries.*', 'report_deliveries.created_at as date_visit', 'report_deliveries.report_deliveries_id' , 'report_deliveries.report_deliveries_id_user' , 'report_deliveries.report_deliveries_value' , 'report_deliveries.report_deliveries_code_immobile')
            ->whereYear('report_deliveries.created_at', '=', $year)
            ->whereMonth('report_deliveries.created_at', '=', $month)->get();
            
            //return  DB::getQueryLog();
            $type_report = 0;
            return view('report.rel_delivery_analytic' , compact('delivery' , 'type_report', 'carbon'));
        }else{
            $carbon = Carbon::now();
            $month  = $request['month_delivery'];
            $year   = $request['year_delivery'];
            $id_delivery = $request['report_deliveries_id_delivery'];

            
            $delivery =  DB::table('deliveries')
            ->join('report_deliveries', 'deliveries.deliveries_id', '=', 'report_deliveries.report_deliveries_id_delivery')
            ->whereYear('report_deliveries.created_at', '=', $year)
            ->whereMonth('report_deliveries.created_at', '=', $month)
            ->groupBy('report_deliveries_id_delivery')->get();
            
           // return  DB::getQueryLog();
            $type_report = 1;
            return view('report.rel_delivery_analytic' , compact('delivery', 'type_report'));
        }
    }


}
