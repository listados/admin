<?php
namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Immobile extends Model
{
    protected $primaryKey = 'immobiles_id';

    protected $fillable = ['immobiles_cep', 'immobiles_address', 'immobiles_number', 'immobiles_complement', 'immobiles_district', 'immobiles_city', 'immobiles_state', 'immobiles_reference_point', 'immobiles_code', 'immobiles_status', 'immobiles_date_register', 'immobiles_date_update', 'immobiles_property_title', 'immobiles_publish', 'immobiles_name_condo', 'immobiles_business_status', 'immobiles_type_offer', 'immobiles_selling_price', 'immobiles_type_rental', 'immobiles_rental_price', 'immobiles_rental_warranty', 'immobiles_board_on_site', 'immobiles_useful_area', 'immobiles_total_area', 'immobiles_metrica_unit', 'immobiles_property_default', 'immobiles_property_localization', 'immobiles_ocupacion', 'immobiles_accept_negotiation', 'immobiles_face_immobile', 'immobiles_qtd_dormitory', 'immobiles_qtd_suite', 'immobiles_qtd_toilet', 'immobiles_qtd_uncovered_jobs', 'immobiles_ps', 'immobiles_finality', 'immobiles_latitude', 'immobiles_longitude', 'immobiles_iptu_price' , 'immobiles_condominium_price' , 'immobiles_type_immobiles'];
}

