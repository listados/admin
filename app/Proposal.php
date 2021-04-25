<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;
use AdminEspindola\Files;
use DB;

class Proposal extends Model
{
    protected $primaryKey = 'proposal_id';
	protected $table = 'proposal';
	public $timestamps = false;

	protected $fillable = [
		'proposal_email' , 'proposal_name' , 'proposal_phone_cel1' , 'date_cadastre' , 'proposal_status'
	];

	static public function countFiles($id_proposal)
	{
		$count = DB::table('files')->where('files_id_proposal' , $id_proposal)->count();
		return $count;
	}
	
}
