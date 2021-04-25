<?php
/* AUTOR: EXCELLENCE SOFT*/
namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use AdminEspindola\Http\Controllers\Controller;
use AdminEspindola\Client;
use AdminEspindola\Helpers; 
use DB;
use Carbon\Carbon;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $page_description = 'Adicionar e pesquisar clientes';
        return view('client.index' , compact('page_description'));
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
        if($request->ajax())
        {
            global $client;
            //FORMATANDO 
            $date = Helpers::DataBRtoMySQL($request['clients_birth_date']);
            $request['clients_birth_date'] = $date;
            $money = Helpers::money_real($request['clients_rental_finance']);
            $request['clients_rental_finance'] = $money;
            
            try {
               $client = Client::create($request->all());
               return response()->json(['message' , 'success']);
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

}
