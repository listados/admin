<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class PhotoImmobile extends Model
{
    protected $table 		= 'photo_immobiles';
    protected $primaryKey 	= 'photo_immobiles_id';
    protected $fillable 	= ['photo_immobiles_name' , 'photo_immobiles_type', 'photo_immobiles_url', 'photo_immobiles_principal', 'photo_immobiles_code_immobile'];
}
