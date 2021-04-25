<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Survey;
use AdminEspindola\User;
use DB, PDF, Validator;
use Image, Mail, Session;
use Illuminate\Support\Facades\Input;
use AdminEspindola\Settings;
use Carbon\Carbon;
use AdminEspindola\Http\Requests;
use AdminEspindola\Helpers;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //VISTORIA
        $survey = Survey::all();
        $last_survey = $survey->last();
        $count_survey = Survey::count();
        $fininality = Survey::where('survey_status' , '=' , 'Finalizada')->get();
        $draft = Survey::where('survey_status' , '=' , 'Rascunho')->get();
        //VERIFICANDO O ID USUARIO QUE FEZ UMA MODIFICAÇÃO
        $alter_reservation = DB::table('settings')->where('settings_reservation_active', '=' , 1)->get();
        $user_alter_reservation = User::find($alter_reservation[0]->settings_id_user);
        
        return view('setting.index' , compact('last_survey' , 'count_survey' , 'fininality' , 'draft' , 'user_alter_reservation', 'alter_reservation'));
    
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

     public function setting_aspect()
    {
         # //Created in 2016-08-06 13:12 by Junior Oliveira 
       $setting = DB::table('settings')->where('settings_aspect_general_active' , 1)->get(); 
       return view('survey.settingPdf.settings_aspect_general', compact('setting'));

    }

     public function setting_reservation()
    {
         # //Created in 2016-08-06 13:12 by Junior Oliveira 
       $setting = DB::table('settings')->where('settings_reservation_active' , 1)->get(); 
       return view('survey.settingPdf.settings_reservation', compact('setting'));
    }
    
    public function setting_provisions()
    {
         # //Created in 2016-08-06 13:12 by Junior Oliveira 
       $setting = DB::table('settings')->where('settings_provisions_active' , 1)->get(); 
       return view('survey.settingPdf.settings_provisions', compact('setting'));
    }

    public function setting_keys()
    {
         # //Created in 2016-12-12 15:49 by Junior Oliveira 
       $setting = DB::table('settings')->where('settings_keys_active' , 1)->get(); 
       return view('survey.settingPdf.settings_keys', compact('setting'));
    }

    /*PASSAR PARAMETRO NO TEMPLATE PARA ENCURTAR O SIDEBAR ( $sub_url )*/
    public function immobile()
    { 
        # create 2017-10-23 by Excellence Soft
        
        $setting = Settings::get();
        if($setting[0]->settings_id_user_sync == '')
        {
            $user = "";
        }else
        {
            $user = Helpers::getNameUser($setting[0]->settings_id_user_sync);
        }
        $carbon = Carbon::now();
        
        return view('setting.immobile',compact('setting' , 'carbon' , 'user'));        
    }


}
