<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;
use DB;
class LeaseGuarantee extends Model
{
	protected $table = 'lease_guarantees';
	protected $primaryKey = 'lease_guarantees_id';

	protected $fillable = ['lease_guarantees_name'];

	static public function createLeaseGuarantee($cod_immobile, $name_guarantee)
	{
		$guarantee_id = LeaseGuarantee::where('lease_guarantees_name' ,$name_guarantee)->get();

		DB::table('relation_guarantee_immobile')->insert(
		    ['relation_guarantee_immobile_code_immobile' 		=> $cod_immobile, 
		     'relation_guarantee_immobile_id_lease_guarantee'	 => $guarantee_id[0]->lease_guarantees_id]
		);
		//return "Cod imovel: ".$cod_immobile. " - Cod Guarantia: ".$guarantee_id[0]->lease_guarantees_id;
		//return "Cod imovel: ".$cod_immobile. " - Cod Guarantia: ".$name_guarantee;
	}
}
