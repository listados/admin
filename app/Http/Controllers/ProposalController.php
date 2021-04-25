<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use Auth , Session;
use Mail, Zipper, ZipArchive;
use DB, Response;
use Carbon\Carbon;
use AdminEspindola\User;
use AdminEspindola\Proposal;
use AdminEspindola\Legal;
use AdminEspindola\Guarantor;
use AdminEspindola\GuarantorLegal;
use AdminEspindola\RelPropFun;
use AdminEspindola\Helpers;
use Illuminate\Support\Facades\Input;
use AdminEspindola\Http\Middleware\VerifyCsrfToken;

class ProposalController extends Controller
{
 //CONSTRUTOR
	public function __construct()
    {
        $this->middleware('auth');
        global  $dominio_pdf_externo, $dominio_img_externo;
       

    }



	public function index()
	{
		# code...

		$propostas = DB::table('proposal')->orderBy('proposal_id', 'desc')->paginate(15);
		
		$dominio_pdf_externo = "http://".$_SERVER['SERVER_NAME'].'/ea/';
		
		return view('proposta.proposal_pf', compact('propostas' , 'dominio_pdf_externo'));
	}

	public function getProposal()
	{
		$term = Input::get('term');    

    
        $result = [];

        $queries = DB::table('proposal')
        ->where('proposal_name', 'LIKE', '%'.$term.'%')
        ->get();
       // dd($queries);
       foreach ($queries as $query)
            {
                $result[] = [ 'id' => $query->proposal_id, 'value' => $query->proposal_name];
            }
		return response()->json($result);
	}

	public function search_proposta($id)
	{	# code...
		
			
			$propostas = DB::table('proposal')->where('proposal_id' , $id)->get();	
			//return view('procurar-proposta', compact('propostas'));	
			return response()->json($propostas);
		
	}

	/**********PESSOA JURIDICA******************/
	public function all_pj()
	{
		# code...
		$propostas = DB::table('legal')->orderBy('legal_id', 'desc')->paginate(15);
		$dominio_pdf_externo = "http://espindolaimobiliaria.com.br/ea/";
		return view('proposta.proposal_pj', compact('propostas' , 'dominio_pdf_externo'));
	}

	public function getProposalPJ()
	{
		# code...
		$term = Input::get('term');    

    
        $result = [];

        $queries = DB::table('legal')
        ->where('legal_location_name_corporation', 'LIKE', '%'.$term.'%')
        ->get();
       // dd($queries);
       foreach ($queries as $query)
            {
                $result[] = [ 'id' => $query->legal_id, 'value' => $query->legal_location_name_corporation];
            }
		return response()->json($result);
	}

	public function search_proposta_pj($id)
	{
		# code...
		$propostas = DB::table('legal')->where('legal_id' , $id)->get();	
		//return view('procurar-proposta', compact('propostas'));	
		return response()->json($propostas);
	}

	public function delete_proposal_pj($id, Request $request)
	{
		# code...
		try {
			DB::table('legal')->where('legal_id', '=', $request['legal_id'])->delete();
			return redirect()->back()->with('mensagem' , 'Proposta PJ excluída com sucesso');
		} catch (Exception $e) {
			return redirect()->back()->with('error' , 'Ocorreu um erro: '.$e->getMessage());
			
		}

	}
	public function download($id, $tipo)
	{
		# code...
		/*
			variavel abr_profile é o segundo parametro definido como pf ou pj
		*/
		switch ($tipo) {
			case 'proposta-pf':
				$profile = 'Inquilino';
				$table = 'proposal';
				$campo = 'proposal_id';
				$abr_profile = 'pf';
				break;
			case 'proposta-pj':
				$profile = 'Juridico';
				$table = 'legal';
				$campo = 'legal_id';
				$abr_profile = 'pj';
				break;
			case 'cadastro-pf':
				$profile = 'Fiador';
				$table = 'guarantor';
				$campo = 'guarantor_id';
				$abr_profile = 'pf';
				break;
			case 'cadastro-pj':
				$profile = 'Fiador Juridico';
				$table = 'guarantor_legal';
				$campo = 'guarantor_legal_id';
				$abr_profile = 'pj';
				break;	
			default:
				$profile = 'Inquilino';
				$table = 'proposal';
				$campo = 'proposal_id';
				$abr_profile = 'pf';
				break;

		}

		$id_survey = $id;
		$files = DB::table('files')->where([
			['files_id_proposal' , $id],
			['files_profile', $profile]
			])->get();
		$title = "Arquivos para download Proposta pessoa física";
		
		$proposta = DB::table($table)->where($campo , $id)->get();

		//$dominio_pdf_externo = "http://espindolaimobiliaria.com.br/escolhaazul/";
		$dominio_pdf_externo = "https://".$_SERVER['SERVER_NAME']."/escolhaazul";
		//$dominio_pdf_externo = "http://localhost/escolhaazul/";
		if(empty($files)){

			//return redirect()->back()->with('mensagem' , 'Não existe arquivo para esse cadastro');
			$files = [];
			return view('download',compact('files' , 'title', 'proposta' , 'campo', 'tipo', 'dominio_pdf_externo' , 'id_survey'));
		
		}else{
			
			return view('download',compact('files' , 'title', 'proposta' , 'campo', 'tipo', 'dominio_pdf_externo' , 'id_survey'));
		}
		
	}

	public function baixar($name_file)
	{
		
		if(file_exists(dirname(dirname(dirname(dirname(__DIR__)))).'/escolhaazul/public/img/upload/'.$name_file))
		{
			return response()->download(dirname(dirname(dirname(dirname(__DIR__)))).'/escolhaazul/public/img/upload/'.$name_file);
		}else{
			return redirect()->back()->with('success', 'Não Existe arquivo');
		}

	}

	public function download_all($id, $tipo)
	{
		# CREATED IN 2016-10-06  BY JUNIOR OLIVEIRA 
		
		switch ($tipo) {
			case 'proposta-pf':
				$profile = 'Inquilino';
				$table = 'proposal';
				$campo = 'proposal_id';
				
				break;
			case 'proposta-pj':
				$profile = 'Juridico';
				$table = 'legal';
				$campo = 'legal_id';
				
				break;
			case 'cadastro-pf':
				$profile = 'Fiador';
				$table = 'guarantor';
				$campo = 'guarantor_id';
				
				break;
			case 'cadastro-pj':
				$profile = 'Fiador Juridico';
				$table = 'guarantor_legal';
				$campo = 'guarantor_legal_id';
				$abr_profile = 'pj';
				break;	
			default:
				$profile = 'Inquilino';
				$table = 'proposal';
				$campo = 'proposal_id';
				
				break;

		}

		$files = DB::table('files')->where([
			['files_id_proposal' , $id],
			['files_profile', $profile]
			])->get();

		$title = "Arquivos para download Proposta pessoa física";
		
		/* dando erro na hora do download
		*/
		$reporitory = dirname(dirname(dirname(dirname(__DIR__)))).'/escolhaazul/public/img/upload/';
		
		
		//$zip = new ZipArchive(); // Load zip library   
        $zip_name = time().".zip";           // Zip name  
        // if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)  
        // {   
        //      // Opening zip file to load files  
        //     return redirect()->back()->with('error_message', 'Não Existe arquivo');
           
        // }
        $imgs = [];  
        foreach($files as $file)  
        {   
             //$zip->addFile($reporitory.$file->files_name); // Adding files into zip
            array_push($imgs, $reporitory.'/'.$file->files_name);  
        }  
        //$zip->close(); 
		//return response()->download($zip_name);
		\Zipper::make('download_'.$id.'.zip')->add($imgs)->close();



        return response()->download(public_path('download_'.$id.'.zip'));
	}

	public function home(){
	if(Auth::user()->status == 1){
		 $adm_survey = session('adm');
		 $status_survey = session('status');
	    // Store a piece of data in the session...
	    session(['adm' => Auth::user()->adm]);
	    
		$count_proposal_pf = DB::table('proposal')->count(); 

		$count_proposal_pj = DB::table('legal')->count();

		$count_guarantor_pf = DB::table('guarantor')->count(); 

		$count_guarantor_pj = DB::table('guarantor_legal')->count(); 
		
		//ANO DE 2016
		$tol_jan_16 = DB::table('proposal')->whereBetween('date_cadastre', ['2016-01-01' , '2016-01-31'])->count();
		$tot_fev_16 = DB::table('proposal')->whereBetween('date_cadastre', ['2016-02-01' , '2016-02-31'])->count();
		$tol_mar_16 = DB::table('proposal')->whereBetween('date_cadastre', ['2016-03-01' , '2016-03-31'])->count();
		$tol_abr_16 = DB::table('proposal')->whereBetween('date_cadastre', ['2016-04-01' , '2016-04-31'])->count();
		$tol_mai_16 = DB::table('proposal')->whereBetween('date_cadastre', ['2016-05-01' , '2016-05-31'])->count();
		$tol_jun_16 = DB::table('proposal')->whereBetween('date_cadastre', ['2016-06-01' , '2016-06-31'])->count();
		$tol_jul_16 = DB::table('proposal')->whereBetween('date_cadastre', ['2016-07-01' , '2016-07-31'])->count();
		//ANO DE 2015
		$tol_jan_15 = DB::table('legal')->whereBetween('legal_date_cadastre', ['2016-01-01' , '2016-01-31'])->count();
		$tot_fev_15 = DB::table('legal')->whereBetween('legal_date_cadastre', ['2016-02-01' , '2016-02-31'])->count();
		$tol_mar_15 = DB::table('legal')->whereBetween('legal_date_cadastre', ['2016-03-01' , '2016-03-31'])->count();
		$tol_abr_15 = DB::table('legal')->whereBetween('legal_date_cadastre', ['2016-04-01' , '2016-04-31'])->count();
		$tol_mai_15 = DB::table('legal')->whereBetween('legal_date_cadastre', ['2016-05-01' , '2016-05-31'])->count();
		$tol_jun_15 = DB::table('legal')->whereBetween('legal_date_cadastre', ['2016-06-01' , '2016-06-31'])->count();
		$tol_jul_15 = DB::table('legal')->whereBetween('legal_date_cadastre', ['2016-07-01' , '2016-07-31'])->count();
		
		return view('dashboard', compact('count_proposal_pf', 'count_proposal_pj' , 'count_guarantor_pf' , 'count_guarantor_pj' , 'tol_jan_16' , 'tot_fev_16','tol_mar_16', 'tol_abr_16' ,'tol_mai_16','tol_jun_16', 'tol_jul_16' , 'tol_jan_15' , 'tot_fev_15','tol_mar_15', 'tol_abr_15' ,'tol_mai_15','tol_jun_15', 'tol_jul_15'));
	}else{

		$data = array(
           'name' => 'Junior E-mail',
       	);
       
		return redirect('logout');
	}
	}

	public function alter_status(Request $request)
	{
		# CREATED IN 2016/09/26 21:23 BY JUNIOR OLIVEIRA
		
		$proposal = DB::table('proposal')->where('proposal_id', $request['proposal_id'])->update(['proposal_status' => $request['proposal_status']]);
		return redirect('proposta-pf')->with('mensagem' , 'Status alterado com sucesso' );

	}

	public function alter_functionary(Request $request)
	{
		# CREATED IN 2016/09/26 21:23 BY JUNIOR OLIVEIRA
		$table = $request['table'];
		
		switch ($table) {
			case 'proposal':
				$proposal_find = Proposal::find($request[$table.'_id']);
				//PARA PASSAR O ID DO USUARIO ENCONTRADO
				$id_user_proposal_find = $proposal_find->proposal_id;
				break;
			case 'guarantor':
				$proposal_find = Guarantor::find($request[$table.'_id']);
				$id_user_proposal_find = $proposal_find->guarantor_id;
				break;
			case 'legal':
				$proposal_find = Legal::find($request[$table.'_id']);
				$id_user_proposal_find = $proposal_find->legal_id;
				break;
			case 'guarantor_legal':
				$proposal_find = GuarantorLegal::find($request[$table.'_id']);
				$id_user_proposal_find = $proposal_find->guarantor_legal_id;
				break;		
			default:
				# code...
				break;
		}
		/*
			$table.'_id_user' => $request['proposal_id_user'] - ALTERA O ID NO REGISTRO DA PROPOSTA DO USUARIO RESPONSÁVEL
		*/
		$proposal = DB::table($table)->where($table.'_id', $request[$table.'_id'])->update([$table.'_id_user' => $request['proposal_id_user']]);
		//notificando a todos os usuarios
		Helpers::reg_not_all(null, Auth::user()->nick. " mudou o atendente da proposta ".$request[$table.'_id']);

		//PESQUISANDO O USUARIO QUE FOI ATRIBUIDO A PROPOSTA
		$user_new_proposal = User::find($request[$table.'_id_user']);
		if($user_new_proposal){
			//ENVIANDO O EMAIL SIMPLES PARA O NOVO ATENDENTE
			Mail::raw(Auth::user()->nick. " atribuiu a proposta ".$request[$table.'_id']. " para voce ser o atendente.", function ($message) use ($user_new_proposal) {
			    $message->to($user_new_proposal->email, 'Junior Oliveira')
			    		->subject('Mudança de atendente');
			});
		}
		//CASO NAO TENHA USUARIO RELACIONADO, A RELAÇÃO SE DARÁ PARA O PROPRIO USUARIO DO SISTEMA LOCADO
		if(empty($user_new_proposal)){
			$user_new_proposal = Auth::user();
		}
		

		//REGISTRANDO ALTERAÇÃO DO USUÁRIO
		
		RelPropFun::insert(
			 ['rel_prop_fun_id_user' =>  $user_new_proposal->id, 'rel_prop_fun_id_proposal' => $request[$table.'_id'] , 'rel_prop_fun_new_id_user' => $request['proposal_id_user'], 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
		);
		return redirect()->back()->with('mensagem' , 'Atendente alterado com sucesso' );

	}

	public function delete_proposal_pf(Request $request)
	{
		# CREATED IN 2016/10/06 15:51 BY JUNIOR OLIVEIRA
		 $proposal = Proposal::destroy($request['proposal_id']);

		 if($proposal){
		 	   
		 	return redirect('proposta-pf')->with('mensagem' , 'Proposasta Excluida com sucesso');
		 }else{
		 	return redirect()->back()->with('error' , 'Ocorreu um erro, tente novamente');
		 }
	}


}
