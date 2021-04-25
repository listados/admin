<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;
use Auth , DB;
use AdminEspindola\Survey;
use AdminEspindola\Http\Requests;

class PortalClientController extends Controller
{
    //Criado em 05/08/2016 as 14:26 por Junior Oliveira
    public function index()
    {
    	# code...
    	return view('survey.auth.login');
    }

    public function authenticate(Request $request)
    {
    	//created in 2016-08-05 15:54 by Junior Oliveira
    	$email  = $request['email'];
    	$cpf	= $request['cpf'];
    	
    	$client =DB::table('survey')->where([
				    ['survey_occupant_email', '=',  $email  ],
				    ['survey_occupant_cpf', '=', $cpf] , ])->get();
    	
        if(!empty($client))
        {        	
        	$survey = Survey::where('survey_occupant_email' ,  '=', $email )->get();
        	return redirect('todas-vistoria/'.$client[0]->survey_occupant_email);
        }else{
        	return 'nao tem valor';
        }
    }
    
    public function list_survey($email)
    {
        //created in 2016-08-08 19:00 by Junior Oliveira
        $survey = Survey::where('survey_occupant_email' , $email)->get();
        return view('portal.list_survey' , compact($survey));

    }
}
