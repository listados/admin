<?php
namespace AdminEspindola\Http\Controllers;

use AdminEspindola\ControlKey;
use AdminEspindola\Delivery;
use AdminEspindola\Helpers;
use AdminEspindola\Http\Controllers\Controller;
use AdminEspindola\Immobile;
use AdminEspindola\Key;
use AdminEspindola\ReportDelivery;
use AdminEspindola\Reserve;
use Carbon\Carbon;
use Datatables;
use DB;
use Exception;
use Illuminate\Http\Request;
use Redirect;

class ControlKeyController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}
	/**
	 *         //DB::enableQueryLog();
	 *  //return  DB::getQueryLog();
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$immobile = Immobile::where('immobiles_status', 'Ativo')->pluck('immobiles_code', 'immobiles_code');
		//$delivery = Delivery::select('deliveries_id', 'deliveries_name')->get();
		$delivery = Delivery::all()->pluck('deliveries_name', 'deliveries_id');
		$carbon = Carbon::now();
		return view('key.index', compact('immobile', 'delivery', 'carbon'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
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
	public function store(Request $request) {

		try
		{
			//UM FOR PARA CADASTRAR OS FONES.
			//for ($i=0; $i < count($request_phone); $i++) {
			Helpers::register_phone_client($request_phone, $client[0]->clients_id);
			//}

			Key::where('keys_code', $request['reserves_code_key'])->update(['keys_status' => 'Pendente', 'keys_type' => $keys_type, 'keys_ps' => $keys_ps, 'keys_devolution' => 0]);

			//RESERVA
			$key = Key::where('keys_code', $request['reserves_code_key'])->get();

			$request['reserves_id_client'] = $client[0]->clients_id; //ID DO CLIENTE
			$request['reserves_id_key'] = $key[0]->keys_id; // ID DA CHAVE
			// return "id cliente: ".$request['reserves_id_client'].' id key= '.$key[0]->keys_id.' id delivery= '.$request['reserves_id_delivery'];
			$request['reserves_devolution'] = 0;
			$request['reserves_status'] = "Pendente";
			$reserve = Reserve::create($request->all());

			//RECEBENDO O ID DO CONTROLER DE CHAVES
			$array_delivery['report_deliveries_id_control'] = $reserve->reserve_id;
			$report_delivery = ReportDelivery::create($array_delivery);

		} catch (Exception $e) {
			return dd($e->getMessage());

		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show() {
		date_default_timezone_set('America/Fortaleza');
		$carbon = Carbon::now();
		//FILTRANDO DATA NO CONTROLE
		// $keys = Key::where([
		//              ['keys_status' , '=', 'Disponível'],
		//              ['keys_status']
		//          ])
		//          ->orwhere('keys_status' , '=','Reservado')
		//          ->select(['keys_id', 'keys_code', 'keys_cod_immobile', 'keys_status']);
		//$keys= Key::where('keys_status','Reservado')->orWhere('keys_status' , 'Disponível');
		$keys = Key::all();
		
		return Datatables::of($keys)->setRowClass(function ($key) {
			if ($key->keys_status == 'Atrasado') {

				return 'delay';
			}
		})->addColumn('action', function ($keys) {
			if ($keys->keys_status == 'Atrasado' || $keys->keys_status == 'Pendente') {

				$disabled = 'disabled';
				return '<a href="#" onclick="modal_edit_key(' . $keys->keys_id . ')" class="btn btn-xs btn-primary"  title="Receber Chaves"><i class="fa fa-retweet" aria-hidden="true"></i></a>
                <a href="' . url('criar-reserva/' . $keys->keys_cod_immobile) . '" class="btn btn-xs btn-default' . $disabled . '"  title="Nova Reserva"><i class="fa fa-plus"></i></a>
                <a href="#" onclick="modal_update_key(' . $keys->keys_id . ')" class="btn btn-xs ' . $disabled . '"  title="Editar Código da chaves"><i class="fa fa-edit"></i></a>
				<a href="#" onclick="modal_delete_key(' . $keys->keys_id . ')" class="btn btn-xs btn-danger"  title="Excluir"><i class="fa fa-trash"></i></a>';

			} else {

				$disabled = '';
				return '<a href="#" onclick="modal_edit_key(' . $keys->keys_id . ')" class="btn btn-xs btn-default"  title="Receber Chavessssss"><i class="fa fa-retweet" aria-hidden="true"></i></a>
                <a href="' . url('criar-reserva/' . $keys->keys_cod_immobile) . '" class="btn btn-xs btn-default' . $disabled . '"  title="Nova Reserva"><i class="fa fa-plus"></i></a>
                <a href="#" onclick="modal_update_key(' . "'" . $keys->keys_id . "'" . ', ' . "'" . $keys->keys_cod_immobile . "'" . ')" class="btn btn-xs btn-default"  title="Editar Código da chaves"><i class="fa fa-edit"></i></a>
				<a href="#" onclick="modal_delete_key(' . $keys->keys_id . ')" class="btn btn-xs btn-danger"  title="Excluir"><i class="fa fa-trash"></i></a>';

			}
		})->make(true);
	}

/*<a href="' . url('criar-reserva/' . $keys->keys_cod_immobile) . '" class="btn btn-xs btn-default"  title="Nova Reserva"><i class="fa fa-plus"></i></a>*/
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		// dd($request->all());

		if (empty($request['control_keys_date_devolution'])) {
			$dt_dev = Reserve::where('reserves_id', $id)->get();
			$request['control_keys_date_devolution'] = $dt_dev[0]->control_keys_date_devolution;

		} else {
			$seg2 = substr($request['control_keys_date_devolution'], 11, 16);
			$request['control_keys_date_devolution'] = Helpers::DataBRtoMySQL($request['control_keys_date_devolution']);
			$request['control_keys_date_devolution'] .= " " . $seg2 . ":00";

		}

		$pdf_chave = 'false';
		$pdf_autor = '&auto=false';
		$pdf_deliv = '&delivery=false';
		//LOOP PARA SABER QUANTOS RECIBOS E QUAIS SERAO IMPRESSO
		foreach ($request['receipt'] as $key => $value) {
			if ($value == 'chave') {
				$pdf_chave = 'true';

			}
			if ($value == 'autorizacao') {
				$pdf_autor = '&auto=true';

			}
			if ($value == 'delivery') {
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
			->orWhere('keys_code', '=', $request['control_keys_key_number'])
			->update(['keys_status' => 'Pendente', 'keys_type' => 'Visita']);

		return redirect('chaves/receipt/' . $id . '?auto=true&key=true&delivery=true');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//

	}

	public function search($code) {
		//$code_key = Key::where('keys_code' , $code);

	}
}
