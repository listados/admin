<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
     //Create 2016-11-28 by Junior Oliveira
    protected $table = 'business';

    protected $primaryKey = 'business_id';

    protected $fillable = 
    [
    	'business_name_corporation' , 'business_fantasy' , 'business_cnpj' , 'business_responsible', 'business_email_corporation', 'id_plans'
    ];
}
