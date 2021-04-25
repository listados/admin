<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class RelPropFun extends Model
{
    //Create 2016-10-18 by Junior Oliveira
    protected $table = 'rel_prop_fun';

    protected $primaryKey = 'rel_pro_fun_id';

   /*
		CAMPO rel_prop_fun_id_user RECEBE O ID DO USUARIO ATUAL DA PROPOSTA, rel_prop_fun_id_proposal RECEBE O ID DA PROPOSTA, rel_prop_fun_new_id_user RECEBE O ID DO NOVO USUARIO
	
   */
    protected $fillable = 
    [
    	'rel_prop_fun_id_user' , 'rel_prop_fun_id_proposal' , 'rel_prop_fun_new_id_user' 
    ];
}
