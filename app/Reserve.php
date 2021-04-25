<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
	protected $primaryKey = 'reserves_id';

	protected $table  = 'reserve';
	
    protected $fillable = [
    	'reserves_ref_immobile','reserves_id_user','reserves_id_client','reserves_id_key','reserves_id_delivery','reserves_date_exit','reserves_date_devolution','reserves_code_key','reserves_value_guarante','reserves_cpf','','reserves_date_return','reserves_visited','reserves_interested','reserves_value_immobile','reserves_conservation','reserves_location','reserves_feedback','reserves_status', 'reserve_finality', 'reserve_ps' , 'reserves_devolution'
    ];
}
