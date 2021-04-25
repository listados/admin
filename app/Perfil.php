<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //CRIADO EM 05/07/2016 AS 16:19
    protected $table 		= 'profile';
    protected $primaryKey 	= 'profile_id';
    protected $fillable 	= ['profile_name' , 'profile_created_in'];


    public function messages()
	{
	    return [
	        'profile_name.required' => 'min:3',
	        
	    ];
	}


}
