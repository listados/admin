<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Http\Controllers\Controller;
use DB;
use AdminEspindola\Delivery;
use AdminEspindola\Helpers;
use Carbon\Carbon;

class ReportGeneral extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $delivery       = Delivery::lists( 'deliveries_name','deliveries_id');   
        $carbon         = Carbon::now();
        $mes_anterior   = ($carbon->month - 1);
        $mes = Helpers::getNameMonth($mes_anterior);
        return view('report.index' , compact('delivery' , 'mes' , 'mes_anterior' ));
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
        //
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
        //
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

    public function rel_sintetic_delivery()
    {
        $delivery = Delivery::all();  
        return view('report.rel_delivery_analytic' , compact('delivery'));
    }
}
