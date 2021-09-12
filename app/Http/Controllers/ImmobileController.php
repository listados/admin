<?php

namespace AdminEspindola\Http\Controllers;

use AdminEspindola\Delivery;
use AdminEspindola\Helpers;
use AdminEspindola\Http\Controllers\Controller;
use AdminEspindola\Immobile;
use AdminEspindola\Key;
use AdminEspindola\PhotoImmobile;
use Carbon\Carbon;
use Datatables;
use DB;
use Exception;
use Illuminate\Http\Request;

class ImmobileController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//create 2017-08-18 by Excellence Soft
		$immobile = Immobile::where('immobiles_status', 'Ativo')->pluck('immobiles_code', 'immobiles_code');
		$delivery = Delivery::all()->pluck('deliveries_name', 'deliveries_id');
		$carbon = Carbon::now();

		return view('immobile.index', compact('immobile', 'delivery', 'carbon', 'setting'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//create 2017-08-11 by Excellence Soft
		$code_key['keys_code'] = $request['keys_code'];
		$code_key['keys_status'] = "Disponível";
		$code_key['keys_cod_immobile'] = $request['immobiles_code'];
		$code_key['keys_devolution'] = 1;

		$input = $request->except('keys_code');

		$immobile = Immobile::where('immobiles_code', $input['immobiles_code'])->get();

		if (count($immobile) == 0) {

			Key::create($code_key);
			Immobile::create($request->all());
			return redirect()->back()->with('mensagem', 'Imóvel cadastrado com sucesso');

		} else {

			return redirect()->back()->with('error_message', 'Imóvel já cadastrado.');

		}
		// dd($request->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show() {
		//create 2017-08-18 by Excellence Soft

		$immobile = Immobile::where('immobiles_status', '=', 'Ativo');

		return Datatables::of($immobile)->addColumn('action', function ($immobile) {

			$key = Key::where('keys_cod_immobile', '=', $immobile->immobiles_code)->get();
			if (count($key) == 0) {
				$key = '';
			} else {
				$key = $key[0]->keys_code;
			}
			return '<a href="#" onclick="modalReserveKey(' . "'" . $immobile->immobiles_code . "'" . ');" class="btn btn-xs btn-danger" title="Reservar Chaves"><i class="fa fa-key" aria-hidden="true"></i></a>
        <a href="#" onclick="alterStatusImmobile(' . $immobile->immobiles_id . ')" class="btn btn-xs btn-info" title="Mudar Status"><i class="glyphicon glyphicon-edit"></i></a>';
		})
			->editColumn('immobiles_address', function ($immobile) {
				return '<small>' . $immobile->immobiles_address . ', Nº ' . $immobile->immobiles_number . '</small>';

			})
			->editColumn('immobiles_code', function ($immobile) {

				return '<a href="#" onclick="getImmobile(' . "'" . $immobile->immobiles_code . "'" . ')"  title="Mais detalhes">' . $immobile->immobiles_code . '</a>';
			})
			->editColumn('immobiles_rental_price', function ($immobile) {
				return '<small class="label label-success">' . number_format($immobile->immobiles_rental_price, 2, ',', '.') . '</small>';

			})

			->make(true);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		return Immobile::where('immobiles_id', $id)->get();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
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

	public function getImmobile() {
		$immobile = Immobile::select('immobiles_code')->get();

		$resul = [];
		foreach ($immobile as $value) {
			$resul[] = ['code' => $value->immobiles_code];
		}

		return response()->json($resul);
	}

	public function xml() {
		$carbon = Carbon::now();
		$url = "http://www.valuegaia.com.br/integra/midia.ashx?midia=GaiaWebServiceImovel&p=5n9UCbUpZaPJa4ffzP%2bSZQdXvGH%2bBktSruRMsJ6O1aw%3d";

		// $data = file_get_contents($url);
		// $xml = simplexml_load_string($data);
		$br = "<br/>";

		//dd($xml->Imoveis->Imovel[0]->Fotos[0]->Foto);
		//  $list = $xml->xpath('//CodigoImovel');
		// foreach($list as $info) {
		//     if(strpos((string)$info, 'AP0103') !== false) {
		//       $immobile = $info->xpath('..');
		//     }
		// }
		//dd($immobile);
		// foreach ($immobile as $value) {
		//     echo $value->Fotos->Foto->NomeArquivo;
		//     $br = "<br/>";
		//     echo "<b>Titulo: </b>".$value->CodigoImovel;
		//     $br = "<br/>";
		//      echo $value->Fotos->Foto->URLArquivo;
		//      $br = "<br/>";

		// }
		$xml = simplexml_load_file($url);

		$br = "<br/>";
		//$xml->Imoveis->Imovel->pluck('CodigoImovel');
		//APAGANDO TODOS OS REGISTROS
		$del = DB::table('immobiles')->delete(); //limpando imoveis
		dump($del);
		$delP = DB::table('photo_immobiles')->delete(); //limpando fotos dos imoveis
		dump($delP);
		$delR = DB::table('relation_guarantee_immobile')->delete(); //limpando relação de imovel e garantias
		dump($delR);
		$imovel = [];
		//VARIÁVEL PARA SOMAR O TOTAL DE NÓS DO XML
		$totalImmobile = 0;
		echo "<p>Aguarde um momento...</p>";

		// foreach ($xml->Imoveis->Imovel as $value) {
		// 	echo "Cod: " . $value->CodigoImovel;
		// 	echo $br;
		// 	echo "Andares: " . $value->QtdAndar . ' - Andar:' . $value->NumeroAndar . 'º';
		// 	echo '-----';
		// 	echo $br;
		// }

		try {
			foreach ($xml->Imoveis->Imovel as $value) {
				$totalImmobile = ($totalImmobile + 1);

				//echo "Cod: " . $xml->Imoveis->Imovel->CodigoImovel;

				// foreach ($value->corretor as $dataCorretor) {
				// 	echo "NOme do corretor: " . $dataCorretor->nome;
				// 	echo $br;
				// 	echo "telefone do corretor: " . $dataCorretor->telefone;
				// 	echo $br;
				// 	echo "celular do corretor: " . $dataCorretor->celular;
				// 	echo $br;
				// 	echo "email do corretor: " . $dataCorretor->email;
				// 	echo $br;
				// 	echo "foto do corretor: " . $dataCorretor->foto;
				// 	echo $br;
				// }
				Immobile::insert(
					[
						'immobiles_cep' => $value->CEP,
						'immobiles_address' => $value->Endereco,
						'immobiles_number' => $value->Numero,
						'immobiles_complement' => $value->ComplementoEndereco,
						'immobiles_district' => $value->Bairro,
						'immobiles_city' => $value->Cidade,
						'immobiles_state' => $value->Estado,
						'immobiles_reference_point' => $value->PontoReferenciaEndereco,
						'immobiles_code' => $value->CodigoImovel,
						'immobiles_status' => "Ativo",
						'immobiles_date_register' => Helpers::DataBRtoMySQL($value->DataCadastro),
						'immobiles_date_update' => Helpers::DataBRtoMySQL($value->DataAtualizacao),
						'immobiles_property_title' => $value->TituloImovel,
						'immobiles_finality' => $value->Finalidade,
						'immobiles_publish' => $value->Publicar,
						'immobiles_type_publication' => $value->PublicaValores,
						'immobiles_name_condo' => $value->NomeCondominio,
						'immobiles_business_status' => $value->StatusComercial,
						'immobiles_type_offer' => $value->TipoOferta,
						'immobiles_selling_price' => $value->PrecoVenda,
						'immobiles_type_rental' => $value->TipoLocacao,
						'immobiles_rental_price' => $value->PrecoLocacao,
						'immobiles_rental_warranty' => $value->GarantiaLocacao,
						'immobiles_board_on_site' => $value->PlacaNoLocal,
						'immobiles_useful_area' => $value->AreaUtil,
						'immobiles_total_area' => $value->AreaTotal,
						'immobiles_metrica_unit' => $value->UnidadeMetrica,
						'immobiles_property_default' => $value->PadraoImovel,
						'immobiles_property_localization' => $value->PadraoLocalizacao,
						'immobiles_ocupacion' => $value->Ocupacao,
						'immobiles_accept_negotiation' => $value->AceitaNegociacao,
						'immobiles_face_immobile' => $value->FaceImovel,
						'immobiles_qtd_dormitory' => $value->QtdDormitorios,
						'immobiles_qtd_suite' => $value->QtdSuites,
						'immobiles_qtd_toilet' => $value->QtdBanheiros,
						'immobiles_qtd_uncovered_jobs' => $value->QtdVagas, 'immobiles_ps' => $value->Observacao,
						'immobiles_latitude' => $value->latitude,
						'immobiles_longitude' => $value->longitude, 'immobiles_iptu_price' => $value->PrecoIptu,
						'immobiles_condominium_price' => $value->PrecoCondominio,
						'immobiles_type_immobiles' => $value->TipoImovel,
						'immobiles_tour_virtual' => $value->TourVirtual,
						'created_at' => $carbon->now(), 'updated_at' => $carbon->now(),
						'immobiles_price_season' => $value->PrecoLocacaoTemporada,
						'immobiles_face' => $value->FaceImovel,
						'immobiles_electronic_door' => $value->PortaoEletronico,
						'immobiles_front_sea' => $value->FrenteMar,
						'immobiles_sea_shore' => $value->BeiraMar,
						'immobiles_wine_house' => $value->Adega,
						'immobiles_elevator' => $value->QtdAndar, //estou registrando o total de andar
						'immobiles_barbecue_grill' => $value->Churrasqueira,
						'immobiles_poll' => $value->Piscina,
						'immobiles_sports_court' => $value->QuadraPoliEsportiva,
						'immobiles_soccer_field' => $value->CampoFutebol,
						'immobiles_furnished' => $value->Mobiliado,
						'immobiles_floors' => $value->NumeroAndar,
					]
				);
				echo "Cod: " . $value->CodigoImovel;
				echo $br;
				// var_dump($value->TipoImovel);
				// $count_gaarantia = count($value->GarantiaLocacao->Garantia);
				// for ($i = 0; $i < $count_gaarantia; $i++) {
				// 	// echo ' Guarantia: '.$value->GarantiaLocacao->Garantia[$i].' - ';
				// 	LeaseGuarantee::createLeaseGuarantee($value->CodigoImovel, $value->GarantiaLocacao->Garantia[$i]);
				// }

				foreach ($value->Fotos->Foto as $photo) {
					//echo 'Foto: <img src="'.$photo->URLArquivo.'" style="height:128px; width:128px; "></img>';
					PhotoImmobile::insert([
						'photo_immobiles_name' => $photo->NomeArquivo,
						'photo_immobiles_type' => $photo->FotoTipo,
						'photo_immobiles_url' => $photo->URLArquivo,
						'photo_immobiles_principal' => $photo->Principal,
						'photo_immobiles_code_immobile' => $value->CodigoImovel,
					]);
				}
				//print_r(array_keys($immobile));
			}

			DB::table('settings')->update(['settings_date_last_sync' => $carbon->now(), 'settings_total_immobile_sync' => $totalImmobile, 'settings_id_user_sync' => Auth::user()->id]);

		} catch (Exception $e) {
			return redirect()->back()->with(['error', 'Ocorreu um erro de conexão, tente mais tarde']);
		}

	}

	public function showImmobile($code_immobile) {
		$immobile = Immobile::where('immobiles_code', $code_immobile)->get();
		return response()->json($immobile);

	}

	public function getPhotoImmobile($code) {
		$photoImmobile = PhotoImmobile::where('photo_immobiles_code_immobile', $code)->get();

		return response()->json($photoImmobile);
	}
}
