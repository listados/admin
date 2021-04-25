<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //CREATE 2017-11-07 12:04 BY EXCELLENCE SOFT
    protected $primaryKey = 'clients_id';

    protected $fillable = [
    	'clients_option', 'clients_status','clients_name','clients_email','clients_id_user','clients_ps','clients_media','clients_birth_date','clients_type','clients_rg','clients_cpf','clients_nationality','clients_naturalness','clients_marital_status','clients_rental_finance','clients_scholarity', 'clients_sex', 'clients_cep', 'clients_address', 'clients_address_number', 'clients_address_complement', 'clients_district', 'clients_city', 'clients_state',
    ];

}
