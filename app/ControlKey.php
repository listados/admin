<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class ControlKey extends Model
{


	protected $primaryKey 	= 'control_keys_id';

	protected $fillable  		= [
	'control_keys_type_immobile', 'control_keys_ref_immobile','control_keys_cep','control_keys_address','control_keys_number','control_keys_complements','control_keys_district','control_keys_city','control_keys_state','control_keys_point_reference','control_keys_id_user','control_keys_finality','control_keys_delivery','control_keys_date_exit','control_keys_date_devolution','control_keys_value_guarantee','control_keys_key_number','control_keys_visitor_email','control_keys_visitor_phone_one','control_keys_visitor_phone_two','control_keys_visitor_cep','control_keys_visitor_address','control_keys_visitor_number','control_keys_visitor_complements','control_keys_visitor_district','control_keys_visitor_city','control_keys_visitor_state','control_keys_visitor_name','control_keys_cpf' , 'control_keys_code_key', 'control_keys_id_delivery' , 'control_keys_date_return'];

}
