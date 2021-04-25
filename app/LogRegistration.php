<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class LogRegistration extends Model
{
    //Update 2016-10-22 as 16:41 by Junior Oliveira
     protected $table = 'log_registration';
     protected $primaryKey = 'log_registration_id';

     protected $fillable = ['log_registration_id_user' , '	log_registration_action' ];
}
