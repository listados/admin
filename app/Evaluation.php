<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $primaryKey = 'evaluations_id';
	
	protected $fillable = [
		'evaluations_visited' , 'evaluations_interested', 'evaluations_value_immobile' , 'evaluations_conservation' , 'evaluations_location' , 'evaluations_feedback' , 'evaluations_name_friend' , 'evaluations_phone_friend' , 'evaluations_email_friend' , 'evaluations_id_key' , 'evaluations_status' , 'user_id', 'evaluations_code_immobile'
	];
}
