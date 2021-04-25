<?php

namespace AdminEspindola\Http\Controllers;

use Illuminate\Http\Request;

use AdminEspindola\Http\Requests;
use DB, Response;
use Illuminate\Support\Facades\Input;
use AdminEspindola\Http\Middleware\VerifyCsrfToken;


class CadastreController extends Controller
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
		$propostas = DB::table('guarantor')->orderBy('guarantor_id', 'desc')->paginate(15);
		$dominio_pdf_externo = "http://espindolaimobiliaria.com.br/ea/";
		return view('proposta.cadastre_pf', compact('propostas' , 'dominio_pdf_externo'));
	}

	public function search_cadastre($id)
	{	# code...		
		
		$propostas = DB::table('guarantor')->where('guarantor_id' , $id)->get();	
		// // //return view('procurar-proposta', compact('propostas'));	
		return response()->json($propostas);

		
	}

	public function getCadastrePF()
	{
		# code...
		$term = Input::get('term');    

    
        $result = [];

        $queries = DB::table('guarantor')
        ->where('guarantor_name', 'LIKE', '%'.$term.'%')
        ->get();
       // dd($queries);
       foreach ($queries as $query)
            {
                $result[] = [ 'id' => $query->guarantor_id, 'value' => $query->guarantor_name];
            }
		return response()->json($result);
	}

	public function all_pj()
	{
		# code...
		$propostas = DB::table('guarantor_legal')->orderBy('guarantor_legal_id', 'desc')->paginate(15);
		$dominio_pdf_externo = "http://espindolaimobiliaria.com.br/ea/";
		return view('proposta.cadastre_pj', compact('propostas', 'dominio_pdf_externo'));
	}

	public function search_cadastre_pj($id)
	{
		# code...
		$propostas = DB::table('guarantor_legal')->where('guarantor_legal_id' , $id)->get();	
		//return view('procurar-proposta', compact('propostas'));	
		return response()->json($propostas);
	}

	public function getCadastrePJ()
	{
		# code...
		$term = Input::get('term');    

    
        $result = [];

        $queries = DB::table('guarantor_legal')
        ->where('guarantor_legal_location_name_corporation', 'LIKE', '%'.$term.'%')
        ->get();
       // dd($queries);
       foreach ($queries as $query)
            {
                $result[] = [ 'id' => $query->guarantor_legal_id, 'value' => $query->guarantor_legal_location_name_corporation];
            }
		return response()->json($result);
	}
}
