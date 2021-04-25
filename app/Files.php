<?php

namespace AdminEspindola;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    //
    protected $primaryKey = 'files_id';
	protected $table = 'files';
	
	protected $fillable = [
		'files_name' , 'files_id_proposal', 'files_type'
	];
}
